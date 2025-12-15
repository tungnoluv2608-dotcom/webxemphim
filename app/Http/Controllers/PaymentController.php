<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VipOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    private $vnp_TmnCode = "PVW7E4QU"; 
    private $vnp_HashSecret = "BQBW6IY8TQVJHVN7VDQO57X8CA1ION24"; 
    private $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    private $vnp_Returnurl = "http://127.0.0.1:8000/vnpay_return"; 

    // Các gói VIP hợp lệ
    private $validAmounts = [
        20000 => 7,
        70000 => 30,
        150000 => 90,
        500000 => 180
    ];

    // Tạo đơn hàng và redirect sang VNPAY
    public function vnpay_payment(Request $request)
    {
        $amount = (int) $request->amount;

        if (!isset($this->validAmounts[$amount])) {
            Log::warning('VNPAY: Số tiền không hợp lệ', ['amount' => $amount]);
            return redirect('/')->with('error', 'Số tiền không hợp lệ!');
        }

        // Xóa các đơn pending cũ của user
        VipOrder::where('user_id', Auth::id())
                ->where('status', 'pending')
                ->delete();

        // Tạo order_code duy nhất
        $orderCode = time() . substr(microtime(), 2, 6) . Auth::id() . rand(1000, 9999);

        // Lưu đơn hàng pending
        $order = VipOrder::create([
            'user_id'    => Auth::id(),
            'order_code' => $orderCode,
            'amount'     => $amount,
            'status'     => 'pending'
        ]);

        // Dữ liệu gửi VNPAY
        $inputData = [
            "vnp_Version"    => "2.1.0",
            "vnp_TmnCode"    => $this->vnp_TmnCode,
            "vnp_Amount"     => $amount * 100, // VNPAY tính bằng đồng *100
            "vnp_Command"    => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode"   => "VND",
            "vnp_IpAddr"     => $request->ip(),
            "vnp_Locale"     => 'vn',
            "vnp_OrderInfo"  => "Thanh toán VIP gói xem phim",
            "vnp_OrderType"  => "billpayment",
            "vnp_ReturnUrl"  => $this->vnp_Returnurl,
            "vnp_TxnRef"     => $orderCode
        ];

        ksort($inputData);

        // Tạo chữ ký
        $hashData = http_build_query($inputData, '', '&');
        $vnpSecureHash = hash_hmac('sha512', $hashData, $this->vnp_HashSecret);
        $inputData['vnp_SecureHash'] = $vnpSecureHash;

        Log::info('VNPAY Payment Data', [
            'inputData'   => $inputData,
            'hashData'    => $hashData,
            'SecureHash'  => $vnpSecureHash,
            'redirectUrl' => $this->vnp_Url . '?' . http_build_query($inputData)
        ]);

        return redirect($this->vnp_Url . '?' . http_build_query($inputData));
    }

    public function vnpay_return(Request $request)
{
    $inputData = $request->all();

    if (!isset($inputData['vnp_SecureHash'])) {
        Log::warning('VNPAY callback thiếu chữ ký', ['inputData' => $inputData]);
        return redirect('/?payment=error&message=Thiếu chữ ký VNPAY');
    }

    $vnp_SecureHash = $inputData['vnp_SecureHash'];
    unset($inputData['vnp_SecureHash'], $inputData['vnp_SecureHashType']);
    ksort($inputData);

    $hashData = http_build_query($inputData, '', '&');
    $secureHash = hash_hmac('sha512', $hashData, $this->vnp_HashSecret);

    if ($secureHash !== $vnp_SecureHash) {
        Log::warning('VNPAY sai chữ ký', [
            'hashData' => $hashData,
            'secureHash' => $secureHash,
            'vnp_SecureHash' => $vnp_SecureHash
        ]);
        return redirect('/?payment=error&message=Sai chữ ký VNPAY');
    }

    $order = VipOrder::where('order_code', $request->vnp_TxnRef)->first();
    if (!$order) {
        Log::warning('VNPAY callback không tìm thấy đơn hàng', ['vnp_TxnRef' => $request->vnp_TxnRef]);
        return redirect('/?payment=error&message=Không tìm thấy đơn hàng');
    }

    if ($request->vnp_ResponseCode === "00") {
        // Cập nhật đơn hàng thành công
        $order->update([
            'status'         => 'success',
            'transaction_no' => $request->vnp_TransactionNo ?? null,
            'bank_code'      => $request->vnp_BankCode ?? null
        ]);

        // Cập nhật user VIP - FIX: CỘNG DỒN THỜI GIAN
        $days = $this->validAmounts[$order->amount];
        $user = $order->user;
        
        if ($user->is_vip && $user->vip_expired_at && $user->vip_expired_at > now()) {
            // Nếu đang có VIP chưa hết hạn: CỘNG DỒN thêm ngày
            $newExpiryDate = \Carbon\Carbon::parse($user->vip_expired_at)->addDays($days);
        } else {
            // Nếu chưa có VIP hoặc đã hết hạn: Tạo mới từ ngày hiện tại
            $newExpiryDate = now()->addDays($days);
        }
        
        $user->update([
            'is_vip' => true,
            'vip_expired_at' => $newExpiryDate
        ]);
        
        if (Auth::check() && Auth::id() == $user->id) {
            Auth::user()->refresh(); 
        }

        Log::info('VNPAY thanh toán thành công', [
            'order' => $order,
            'old_vip_expired' => $user->getOriginal('vip_expired_at'),
            'new_vip_expired' => $newExpiryDate,
            'days_added' => $days
        ]);
        
        // Redirect về trang chủ với thông tin thành công
        return redirect('/?payment=success&amount=' . $order->amount . '&days=' . $days . 
                        '&total_days=' . $days . '&message=Nâng cấp VIP thành công' .
                        '&expiry_date=' . $newExpiryDate->format('d/m/Y'));
    }

    // Thanh toán thất bại
    $order->update(['status' => 'failed']);
    Log::warning('VNPAY thanh toán thất bại', ['order' => $order]);
    
    return redirect('/?payment=error&message=Thanh toán thất bại&code=' . $request->vnp_ResponseCode);
}
}
