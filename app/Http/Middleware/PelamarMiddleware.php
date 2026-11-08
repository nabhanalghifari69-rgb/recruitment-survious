<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Middleware untuk memastikan pengguna sudah login sebagai Pelamar.
 */
class PelamarMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('pelamar_logged_in') || !session('pelamar')) {
            return redirect()->route('pelamar.login')->with('error', 'Silakan login sebagai Pelamar terlebih dahulu.');
        }

        return $next($request);
    }
}
