<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Hrd;
use App\Models\Lowongan;
use App\Models\Pelamar;
use App\Models\Lamaran;
use App\Models\ProfilPerusahaan;
use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // ─────────────────────────────────────────────────────────────────────────
    // DASHBOARD
    // ─────────────────────────────────────────────────────────────────────────

    public function dashboard()
    {
        $totalHrd      = Hrd::count();
        $totalLowongan = Lowongan::count();
        $totalPelamar  = Pelamar::count();
        $totalLamaran  = Lamaran::count();

        return view('admin.dashboard', compact(
            'totalHrd', 'totalLowongan', 'totalPelamar', 'totalLamaran'
        ));
    }

    // ─────────────────────────────────────────────────────────────────────────
    // MANAJEMEN HRD
    // ─────────────────────────────────────────────────────────────────────────

    public function indexHrd()
    {
        $hrds = Hrd::with('admin')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.hrd.index', compact('hrds'));
    }

    public function createHrd()
    {
        return view('admin.hrd.create');
    }

    public function storeHrd(Request $request)
    {
        $request->validate([
            'nama_hrd' => 'required|string|max:255',
            'email'    => 'required|email|unique:hrd,email',
            'password' => 'required|string|min:6',
            'no_hp'    => 'nullable|string|max:20',
            'jabatan'  => 'nullable|string|max:100',
        ], [
            'nama_hrd.required' => 'Nama HRD wajib diisi.',
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'email.unique'      => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);

        $adminData = session('admin');

        Hrd::create([
            'id_admin' => $adminData['id_admin'],
            'nama_hrd' => $request->nama_hrd,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'no_hp'    => $request->no_hp,
            'jabatan'  => $request->jabatan,
        ]);

        return redirect()->route('admin.hrd.index')->with('success', 'Akun HRD berhasil ditambahkan.');
    }

    public function editHrd($id)
    {
        $hrd = Hrd::findOrFail($id);
        return view('admin.hrd.edit', compact('hrd'));
    }

    public function updateHrd(Request $request, $id)
    {
        $hrd = Hrd::findOrFail($id);

        $request->validate([
            'nama_hrd' => 'required|string|max:255',
            'email'    => 'required|email|unique:hrd,email,' . $id . ',id_hrd',
            'no_hp'    => 'nullable|string|max:20',
            'jabatan'  => 'nullable|string|max:100',
            'password' => 'nullable|string|min:6',
        ], [
            'nama_hrd.required' => 'Nama HRD wajib diisi.',
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'email.unique'      => 'Email sudah digunakan oleh akun lain.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);

        $data = [
            'nama_hrd' => $request->nama_hrd,
            'email'    => $request->email,
            'no_hp'    => $request->no_hp,
            'jabatan'  => $request->jabatan,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $hrd->update($data);

        return redirect()->route('admin.hrd.index')->with('success', 'Data HRD berhasil diperbarui.');
    }

    public function destroyHrd($id)
    {
        $hrd = Hrd::findOrFail($id);
        $hrd->delete();
        return redirect()->route('admin.hrd.index')->with('success', 'Akun HRD berhasil dihapus.');
    }

    // ─────────────────────────────────────────────────────────────────────────
    // MANAJEMEN DEPARTEMEN
    // ─────────────────────────────────────────────────────────────────────────

    public function indexDepartemen()
    {
        $departemens = Departemen::withCount('lowongans')->orderBy('nama_departemen')->paginate(10);
        return view('admin.departemen.index', compact('departemens'));
    }

    public function createDepartemen()
    {
        return view('admin.departemen.create');
    }

    public function storeDepartemen(Request $request)
    {
        $request->validate([
            'nama_departemen' => 'required|string|max:100|unique:departemen,nama_departemen',
            'deskripsi'       => 'nullable|string',
        ], [
            'nama_departemen.required' => 'Nama departemen wajib diisi.',
            'nama_departemen.unique'   => 'Nama departemen sudah ada.',
        ]);

        Departemen::create($request->only('nama_departemen', 'deskripsi'));

        return redirect()->route('admin.departemen.index')->with('success', 'Departemen berhasil ditambahkan.');
    }

    public function editDepartemen($id)
    {
        $departemen = Departemen::findOrFail($id);
        return view('admin.departemen.edit', compact('departemen'));
    }

    public function updateDepartemen(Request $request, $id)
    {
        $departemen = Departemen::findOrFail($id);

        $request->validate([
            'nama_departemen' => 'required|string|max:100|unique:departemen,nama_departemen,' . $id . ',id_departemen',
            'deskripsi'       => 'nullable|string',
        ], [
            'nama_departemen.required' => 'Nama departemen wajib diisi.',
            'nama_departemen.unique'   => 'Nama departemen sudah digunakan.',
        ]);

        $departemen->update($request->only('nama_departemen', 'deskripsi'));

        return redirect()->route('admin.departemen.index')->with('success', 'Departemen berhasil diperbarui.');
    }

    public function destroyDepartemen($id)
    {
        $departemen = Departemen::findOrFail($id);
        $departemen->delete();
        return redirect()->route('admin.departemen.index')->with('success', 'Departemen berhasil dihapus.');
    }

    // ─────────────────────────────────────────────────────────────────────────
    // PROFIL PERUSAHAAN
    // ─────────────────────────────────────────────────────────────────────────

    public function editProfil()
    {
        $profil = ProfilPerusahaan::firstOrCreate([], [
            'nama_perusahaan' => 'PT. SURVIOUS',
        ]);
        return view('admin.profil.edit', compact('profil'));
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat'          => 'nullable|string',
            'deskripsi'       => 'nullable|string',
            'email'           => 'nullable|email|max:255',
            'telepon'         => 'nullable|string|max:50',
            'website'         => 'nullable|url|max:255',
            'logo'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_perusahaan.required' => 'Nama perusahaan wajib diisi.',
            'email.email'              => 'Format email tidak valid.',
            'website.url'              => 'Format URL website tidak valid.',
            'logo.image'               => 'File logo harus berupa gambar.',
            'logo.max'                 => 'Ukuran logo maksimal 2 MB.',
        ]);

        $profil = ProfilPerusahaan::first();

        $data = $request->only('nama_perusahaan', 'alamat', 'deskripsi', 'email', 'telepon', 'website');

        // Handle upload logo
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($profil->logo && Storage::disk('public')->exists($profil->logo)) {
                Storage::disk('public')->delete($profil->logo);
            }
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $profil->update($data);

        return redirect()->route('admin.profil.edit')->with('success', 'Profil perusahaan berhasil diperbarui.');
    }
}
