<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Middleware untuk memastikan pengguna sudah login sebagai HRD.
 */
class HrdMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('hrd_logged_in') || !session('hrd')) {
            return redirect()->route('hrd.login')->with('error', 'Silakan login sebagai HRD terlebih dahulu.');
        }

        return $next($request);
    }
}
