<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VipOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class RevenueController extends Controller
{
    public function index(Request $request)
    {
        // Xác định khoảng thời gian
        list($startDate, $endDate, $filter) = $this->getDateRange($request);
        
        // THỐNG KÊ TỔNG QUAN - CHỈ TÍNH ĐƠN THÀNH CÔNG (success)
        $stats = $this->getStats($startDate, $endDate);
        
        // DANH SÁCH ĐƠN HÀNG VIP - CHỈ HIỂN THỊ ĐƠN THÀNH CÔNG (success)
        $vipOrders = VipOrder::with('user')
                            ->where('status', 'success') // SỬA THÀNH 'success' THAY VÌ 'completed'
                            ->whereBetween('created_at', [$startDate, $endDate])
                            ->orderBy('created_at', 'desc')
                            ->paginate(10)
                            ->appends($request->query());
        
        return view('admincp.revenue.index', compact(
            'stats',
            'vipOrders',
            'filter',
            'startDate',
            'endDate'
        ));
    }
    
    private function getDateRange(Request $request)
    {
        $filter = $request->get('filter', 'today');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        
        switch ($filter) {
            case 'today':
                $start = Carbon::today();
                $end = Carbon::today()->endOfDay();
                break;
            case 'yesterday':
                $start = Carbon::yesterday();
                $end = Carbon::yesterday()->endOfDay();
                break;
            case 'week':
                $start = Carbon::now()->startOfWeek();
                $end = Carbon::now()->endOfWeek();
                break;
            case 'month':
                $start = Carbon::now()->startOfMonth();
                $end = Carbon::now()->endOfMonth();
                break;
            case 'year':
                $start = Carbon::now()->startOfYear();
                $end = Carbon::now()->endOfYear();
                break;
            case 'custom':
                $start = $startDate ? Carbon::parse($startDate) : Carbon::now()->subDays(30);
                $end = $endDate ? Carbon::parse($endDate)->endOfDay() : Carbon::now();
                break;
            default:
                $start = Carbon::today();
                $end = Carbon::today()->endOfDay();
        }
        
        return [$start, $end, $filter];
    }
    
    private function getStats($startDate, $endDate)
    {
        // TỔNG TẤT CẢ ĐƠN THÀNH CÔNG (success) TRONG LỊCH SỬ
        $totalSuccessOrders = VipOrder::where('status', 'success')->get();
        
        // ĐƠN THÀNH CÔNG (success) TRONG KHOẢNG THỜI GIAN ĐƯỢC CHỌN
        $periodSuccessOrders = VipOrder::where('status', 'success')
                                      ->whereBetween('created_at', [$startDate, $endDate])
                                      ->get();
        
        return [
            // TỔNG DOANH THU - CHỈ TÍNH ĐƠN THÀNH CÔNG (success)
            'total_revenue' => $totalSuccessOrders->sum('amount'),
            'total_orders' => $totalSuccessOrders->count(),
            'total_users' => User::count(),
            
            // THEO KỲ ĐƯỢC CHỌN - CHỈ TÍNH ĐƠN THÀNH CÔNG (success)
            'period_revenue' => $periodSuccessOrders->sum('amount'),
            'period_orders' => $periodSuccessOrders->count(),
            'period_new_users' => User::whereBetween('created_at', [$startDate, $endDate])->count(),
            
            // VIP
            'total_vip_users' => User::where('is_vip', true)->count(),
            'active_vip_users' => User::where('is_vip', true)
                                     ->where('vip_expired_at', '>', now())
                                     ->count(),
        ];
    }
}