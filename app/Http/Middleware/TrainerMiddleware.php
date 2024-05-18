<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TrainerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::id() == null) {
            return redirect()->route('auth.trainer')->with('error', 'Bạn phải đăng nhập để sử dụng chức năng này!');
        }

        return $next($request);
    }
}
