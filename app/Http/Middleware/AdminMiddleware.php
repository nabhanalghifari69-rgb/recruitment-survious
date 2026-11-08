<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Middleware untuk memastikan pengguna sudah login sebagai Admin.
 */
class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('admin_logged_in') || !session('admin')) {
            return redirect()->route('admin.login')->with('error', 'Silakan login sebagai Admin terlebih dahulu.');
        }

        return $next($request);
    }
}
