<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra đã đăng nhập và là admin
        if (!auth()->check() || !auth()->user()->is_admin) {
            // Nếu không phải admin, redirect về trang chủ
            return redirect('/')->with('error', 'Bạn không có quyền truy cập trang này!');
        }
        
        return $next($request);
    }
}