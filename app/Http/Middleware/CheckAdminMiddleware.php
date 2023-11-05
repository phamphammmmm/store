<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'moderator')) {
            return $next($request);
        }
        return redirect('/login');
    }
}