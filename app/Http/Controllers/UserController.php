<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VipOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('admincp.user.index', compact('users'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        
        // Không cho phép xóa chính mình
        if ($user->id === auth()->id()) {
            return redirect()->route('user.index')->with('error', 'Bạn không thể xóa chính mình!');
        }

        $user->delete();

        return redirect()->route('user.index')->with('status', 'Xóa người dùng thành công!');
    }

    public function profile()
    {
        $user = Auth::user();
        
        // Kiểm tra nếu user không tồn tại
        if (!$user) {
            return redirect('/login');
        }
        
        // Lấy thông tin gói dịch vụ hiện tại
        $currentPackage = null;
        $packageHistory = collect();
        $todayUsage = [
            'used' => 0,
            'limit' => 3,
            'remaining' => 3
        ];
        
        return view('pages.profile', compact('user', 'currentPackage', 'packageHistory', 'todayUsage'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return back()->with('error', 'User not authenticated');
        }

        // Validate
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Cập nhật tên
        $user->name = $request->name;

        // Xử lý upload ảnh từ file - ƯU TIÊN FILE UPLOAD
        if ($request->hasFile('avatar')) {
            $this->handleAvatarUpload($user, $request->file('avatar'));
        }
        // Xử lý chọn avatar mặc định
        else if ($request->selected_avatar && $request->selected_avatar != '') {
            $user->avatar = $request->selected_avatar;
        }

        // LƯU USER
        $user->save();
        
        return back()->with('success', 'Cập nhật thông tin thành công!');
    }
    
    private function handleAvatarUpload($user, $avatarFile)
    {
        // Xóa ảnh cũ nếu tồn tại (chỉ xóa ảnh upload, không xóa ảnh mặc định)
        if ($user->avatar && !$this->isDefaultAvatar($user->avatar)) {
            $oldAvatarPath = public_path('images/avatars/' . $user->avatar);
            if (file_exists($oldAvatarPath)) {
                unlink($oldAvatarPath);
            }
        }
        
        // Tạo tên file mới
        $avatarName = 'upload_' . time() . '_' . $user->id . '.' . $avatarFile->getClientOriginalExtension();
        
        // Đảm bảo thư mục tồn tại
        $uploadPath = public_path('images/avatars');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
        
        // Lưu ảnh mới
        $avatarFile->move($uploadPath, $avatarName);
        
        // Cập nhật tên file trong database
        $user->avatar = $avatarName;
    }
    
    private function isDefaultAvatar($avatarName)
    {
        $defaultAvatars = [
            'casau.png', 'gautruc.png', 'cabypara.png', 
            'dragon.png', 'snake.png', 'cho.png'
        ];
        
        return in_array($avatarName, $defaultAvatars);
    }
}