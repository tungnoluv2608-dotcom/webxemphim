<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckVip
{
    public function handle(Request $request, Closure $next)
{
    if(Auth::check()) {
        $user = Auth::user();
        if($user->is_vip && $user->vip_expired_at && now()->greaterThan($user->vip_expired_at)) {
            $user->update(['is_vip' => false, 'vip_expired_at' => null]);
             Auth::user()->refresh();
        }
    }
    return $next($request);
}
}
