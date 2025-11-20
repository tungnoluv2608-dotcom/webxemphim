<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPackage;
use App\Models\Package;
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
    \Log::info('🎯🎯🎯 UPDATE PROFILE CALLED 🎯🎯🎯');
    
    $user = Auth::user();
    if (!$user) {
        \Log::error('❌ No authenticated user!');
        return back()->with('error', 'User not authenticated');
    }
    
    \Log::info('📋 User BEFORE update:', [
        'id' => $user->id,
        'name' => $user->name,
        'avatar' => $user->avatar ?? 'NULL'
    ]);

    \Log::info('📦 Request ALL data:', $request->all());
    \Log::info('📁 Request FILES:', $request->allFiles());
    \Log::info('🖼️ Request hasFile(avatar):', ['result' => $request->hasFile('avatar')]);
    \Log::info('🔘 Request selected_avatar:', ['value' => $request->selected_avatar]);

    // Validate
    try {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        \Log::info('✅ Validation passed:', $validated);
    } catch (\Illuminate\Validation\ValidationException $e) {
        \Log::error('❌ Validation failed:', $e->errors());
        return back()->withErrors($e->errors());
    }

    // Cập nhật tên
    $user->name = $request->name;
    \Log::info('✏️ Name updated to: ' . $request->name);

    $avatarUpdated = false;

    // Xử lý upload ảnh từ file - ƯU TIÊN FILE UPLOAD
    if ($request->hasFile('avatar')) {
        \Log::info('🔄 Processing FILE upload');
        $this->handleAvatarUpload($user, $request->file('avatar'));
        $avatarUpdated = true;
    }
    // Xử lý chọn avatar mặc định
    else if ($request->selected_avatar && $request->selected_avatar != '') {
        \Log::info('🔄 Processing DEFAULT avatar: ' . $request->selected_avatar);
        $user->avatar = $request->selected_avatar;
        $avatarUpdated = true;
    }

    \Log::info('🔄 Avatar updated: ' . ($avatarUpdated ? 'YES' : 'NO'));
    \Log::info('🔄 User avatar before save: ' . ($user->avatar ?? 'NULL'));

    // LƯU USER
    try {
        $result = $user->save();
        \Log::info('💾 Save result: ' . ($result ? 'SUCCESS' : 'FAILED'));
        
        // Kiểm tra lại từ database
        $freshUser = User::find($user->id);
        \Log::info('🔍 User from database AFTER save:', [
            'name' => $freshUser->name,
            'avatar' => $freshUser->avatar ?? 'NULL'
        ]);
        
    } catch (\Exception $e) {
        \Log::error('❌ Error saving user: ' . $e->getMessage());
        \Log::error('❌ Error trace: ' . $e->getTraceAsString());
    }

    \Log::info('🎯🎯🎯 UPDATE PROFILE COMPLETED 🎯🎯🎯');
    
    return back()->with('success', 'Cập nhật thông tin thành công!');
}
    
    private function handleAvatarUpload($user, $avatarFile)
    {
        \Log::info('=== HANDLE AVATAR UPLOAD START ===');
        \Log::info('Original filename: ' . $avatarFile->getClientOriginalName());
        \Log::info('File size: ' . $avatarFile->getSize());
        \Log::info('File extension: ' . $avatarFile->getClientOriginalExtension());
        
        // Xóa ảnh cũ nếu tồn tại (chỉ xóa ảnh upload, không xóa ảnh mặc định)
        if ($user->avatar && !$this->isDefaultAvatar($user->avatar)) {
            $oldAvatarPath = public_path('images/avatars/' . $user->avatar);
            if (file_exists($oldAvatarPath)) {
                \Log::info('Deleting old uploaded avatar: ' . $user->avatar);
                unlink($oldAvatarPath);
            }
        }
        
        // Tạo tên file mới
        $avatarName = 'upload_' . time() . '_' . $user->id . '.' . $avatarFile->getClientOriginalExtension();
        \Log::info('New avatar name: ' . $avatarName);
        
        // Đảm bảo thư mục tồn tại
        $uploadPath = public_path('images/avatars');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
            \Log::info('Created avatars directory');
        }
        
        // Lưu ảnh mới
        try {
            $avatarFile->move($uploadPath, $avatarName);
            \Log::info('✅ File moved successfully to: ' . $uploadPath . '/' . $avatarName);
            
            // Kiểm tra file có tồn tại không
            if (file_exists($uploadPath . '/' . $avatarName)) {
                \Log::info('✅ File exists after move: YES, size: ' . filesize($uploadPath . '/' . $avatarName));
            } else {
                \Log::info('❌ File exists after move: NO');
            }
        } catch (\Exception $e) {
            \Log::error('❌ Error moving file: ' . $e->getMessage());
            return;
        }
        
        // Cập nhật tên file trong database
        $user->avatar = $avatarName;
        \Log::info('✅ Avatar set to: ' . $avatarName);
        \Log::info('=== HANDLE AVATAR UPLOAD END ===');
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