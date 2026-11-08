<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Hrd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HrdAuthController extends Controller
{
    /** Tampilkan halaman login HRD */
    public function showLogin()
    {
        if (session('hrd_logged_in')) {
            return redirect()->route('hrd.dashboard');
        }
        return view('auth.hrd-login');
    }

    /** Proses login HRD */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $hrd = Hrd::where('email', $request->email)->first();

        if (!$hrd || !Hash::check($request->password, $hrd->password)) {
            return back()->withErrors(['login' => 'Email atau password salah.'])->withInput($request->only('email'));
        }

        session([
            'hrd_logged_in' => true,
            'hrd'           => $hrd->toArray(),
        ]);

        return redirect()->route('hrd.dashboard')->with('success', 'Selamat datang, ' . $hrd->nama_hrd . '!');
    }

    /** Logout HRD */
    public function logout(Request $request)
    {
        $request->session()->forget(['hrd_logged_in', 'hrd']);
        return redirect()->route('hrd.login')->with('success', 'Anda telah berhasil logout.');
    }
}
