<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    /** Tampilkan halaman login Admin */
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.admin-login');
    }

    /** Proses login Admin */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->withErrors(['login' => 'Username atau password salah.'])->withInput($request->only('username'));
        }

        // Simpan data admin ke session
        session([
            'admin_logged_in' => true,
            'admin'           => $admin->toArray(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, ' . $admin->nama_admin . '!');
    }

    /** Logout Admin */
    public function logout(Request $request)
    {
        $request->session()->forget(['admin_logged_in', 'admin']);
        return redirect()->route('admin.login')->with('success', 'Anda telah berhasil logout.');
    }
}
