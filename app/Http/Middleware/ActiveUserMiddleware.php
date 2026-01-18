<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActiveUserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // GUEST → biarin
        if (!auth()->check()) {
            return $next($request);
        }

        // ADMIN → JANGAN DIBLOK
        if (auth()->user()->role === 'admin') {
            return $next($request);
        }

        // MEMBER tapi belum aktif
        if (!auth()->user()->is_active) {
            auth()->logout();

            return redirect('/login')
                ->withErrors(['Akun kamu belum di-approve admin']);
        }

        return $next($request);
    }
}
