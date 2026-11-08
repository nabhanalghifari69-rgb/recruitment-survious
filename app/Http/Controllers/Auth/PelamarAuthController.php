<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PelamarAuthController extends Controller
{
    /** Tampilkan halaman login Pelamar */
    public function showLogin()
    {
        if (session('pelamar_logged_in')) {
            return redirect()->route('pelamar.dashboard');
        }
        return view('auth.pelamar-login');
    }

    /** Proses login Pelamar */
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

        $pelamar = Pelamar::where('email', $request->email)->first();

        if (!$pelamar || !Hash::check($request->password, $pelamar->password)) {
            return back()->withErrors(['login' => 'Email atau password salah.'])->withInput($request->only('email'));
        }

        session([
            'pelamar_logged_in' => true,
            'pelamar'           => $pelamar->toArray(),
        ]);

        return redirect()->route('pelamar.dashboard')->with('success', 'Selamat datang, ' . $pelamar->nama . '!');
    }

    /** Tampilkan form registrasi */
    public function showRegister()
    {
        if (session('pelamar_logged_in')) {
            return redirect()->route('pelamar.dashboard');
        }
        return view('auth.pelamar-register');
    }

    /** Proses registrasi Pelamar baru */
    public function register(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:pelamar,email',
            'password' => 'required|string|min:6|confirmed',
            'no_hp'    => 'nullable|string|max:20',
            'alamat'   => 'nullable|string',
            'pendidikan' => 'nullable|string|max:50',
        ], [
            'nama.required'           => 'Nama lengkap wajib diisi.',
            'email.required'          => 'Email wajib diisi.',
            'email.email'             => 'Format email tidak valid.',
            'email.unique'            => 'Email sudah terdaftar.',
            'password.required'       => 'Password wajib diisi.',
            'password.min'            => 'Password minimal 6 karakter.',
            'password.confirmed'      => 'Konfirmasi password tidak cocok.',
        ]);

        $pelamar = Pelamar::create([
            'nama'       => $request->nama,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'no_hp'      => $request->no_hp,
            'alamat'     => $request->alamat,
            'pendidikan' => $request->pendidikan,
        ]);

        session([
            'pelamar_logged_in' => true,
            'pelamar'           => $pelamar->toArray(),
        ]);

        return redirect()->route('pelamar.dashboard')->with('success', 'Registrasi berhasil! Selamat datang, ' . $pelamar->nama . '!');
    }

    /** Logout Pelamar */
    public function logout(Request $request)
    {
        $request->session()->forget(['pelamar_logged_in', 'pelamar']);
        return redirect()->route('pelamar.login')->with('success', 'Anda telah berhasil logout.');
    }
}
