<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckBanned
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            Log::info('CheckBanned middleware: User ID ' . Auth::id() . ' is_banned: ' . (Auth::user()->is_banned ? 'true' : 'false'));
            if (Auth::user()->is_banned) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('/login')->with('error', 'Akun Anda telah dibanned.');
            }
        } else {
            Log::info('CheckBanned middleware: No user authenticated');
        }
        return $next($request);
    }
}