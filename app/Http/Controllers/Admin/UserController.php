<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Lấy users có phân trang, sắp xếp theo ngày tạo mới nhất
        $users = User::orderBy('created_at', 'desc')->paginate(15);
        
        // Lấy tất cả users để tính thống kê (không phân trang)
        $allUsers = User::all();
        
        // Tính thống kê VIP
        $total_users = $allUsers->count();
        $vip_active_count = $allUsers->where('is_vip', true)
                                  ->filter(function($user) {
                                      return $user->isVipActive();
                                  })->count();
        $vip_expired_count = $allUsers->where('is_vip', true)
                                   ->filter(function($user) {
                                       return !$user->isVipActive();
                                   })->count();
        $non_vip_count = $allUsers->where('is_vip', false)->count();
        
        return view('admincp.user.index', compact(
            'users', 
            'total_users',
            'vip_active_count',
            'vip_expired_count',
            'non_vip_count'
        ));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        
        return view('admincp.user.show', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admincp.users.index')
                        ->with('success', 'Xóa tài khoản thành công');
    }
}