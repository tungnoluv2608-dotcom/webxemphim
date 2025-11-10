<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}