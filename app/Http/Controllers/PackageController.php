<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    /**
     * Hiển thị danh sách gói dịch vụ cho user
     */
    public function index()
    {
        $packages = Package::active()->get();
        $currentPackage = Auth::user()->currentPackage;
        
        return view('pages.packages', compact('packages', 'currentPackage'));
    }

    /**
     * Hiển thị trang thanh toán
     */
    public function checkout($id)
    {
        $package = Package::findOrFail($id);
        $user = Auth::user();
        
        return view('pages.checkout', compact('package', 'user'));
    }

    /**
     * Xử lý đăng ký gói dịch vụ
     */
    public function subscribe(Request $request, $id)
    {
        // Logic xử lý thanh toán sẽ thêm sau
        return redirect()->route('user.profile')->with('success', 'Đăng ký gói dịch vụ thành công!');
    }

    /**
     * Quản lý gói dịch vụ (Admin)
     */
    public function adminIndex()
    {
        $packages = Package::all();
        return view('admincp.package.index', compact('packages'));
    }
}