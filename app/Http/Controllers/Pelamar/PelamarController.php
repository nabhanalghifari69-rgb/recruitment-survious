<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\Pelamar;
use App\Models\Lowongan;
use App\Models\Lamaran;
use App\Models\DokumenLamaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PelamarController extends Controller
{
    // ─────────────────────────────────────────────────────────────────────────
    // DASHBOARD
    // ─────────────────────────────────────────────────────────────────────────

    public function dashboard()
    {
        $pelamarId = session('pelamar')['id_pelamar'];

        $totalLamaran    = Lamaran::where('id_pelamar', $pelamarId)->count();
        $totalDiterima   = Lamaran::where('id_pelamar', $pelamarId)->where('status_lamaran', 'Diterima')->count();
        $totalWawancara  = Lamaran::where('id_pelamar', $pelamarId)->where('status_lamaran', 'Wawancara')->count();
        $totalProses     = Lamaran::where('id_pelamar', $pelamarId)->whereNotIn('status_lamaran', ['Diterima', 'Ditolak'])->count();

        $lamaranTerbaru = Lamaran::with(['lowongan.departemen'])
            ->where('id_pelamar', $pelamarId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('pelamar.dashboard', compact(
            'totalLamaran', 'totalDiterima', 'totalWawancara', 'totalProses', 'lamaranTerbaru'
        ));
    }

    // ─────────────────────────────────────────────────────────────────────────
    // PROFIL
    // ─────────────────────────────────────────────────────────────────────────

    public function editProfil()
    {
        $pelamarId = session('pelamar')['id_pelamar'];
        $pelamar   = Pelamar::findOrFail($pelamarId);
        return view('pelamar.profil', compact('pelamar'));
    }

    public function updateProfil(Request $request)
    {
        $pelamarId = session('pelamar')['id_pelamar'];
        $pelamar   = Pelamar::findOrFail($pelamarId);

        $request->validate([
            'nama'       => 'required|string|max:255',
            'email'      => 'required|email|unique:pelamar,email,' . $pelamarId . ',id_pelamar',
            'no_hp'      => 'nullable|string|max:20',
            'alamat'     => 'nullable|string',
            'pendidikan' => 'nullable|string|max:50',
            'password'   => 'nullable|string|min:6|confirmed',
            'cv'         => 'nullable|file|mimes:pdf|max:2048',
        ], [
            'nama.required'      => 'Nama lengkap wajib diisi.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email sudah digunakan oleh akun lain.',
            'password.min'       => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'cv.mimes'           => 'CV harus dalam format PDF.',
            'cv.max'             => 'Ukuran CV maksimal 2 MB.',
        ]);

        $data = [
            'nama'       => $request->nama,
            'email'      => $request->email,
            'no_hp'      => $request->no_hp,
            'alamat'     => $request->alamat,
            'pendidikan' => $request->pendidikan,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Upload CV baru
        if ($request->hasFile('cv')) {
            if ($pelamar->cv && Storage::disk('public')->exists($pelamar->cv)) {
                Storage::disk('public')->delete($pelamar->cv);
            }
            $data['cv'] = $request->file('cv')->store('cv', 'public');
        }

        $pelamar->update($data);

        // Perbarui session
        session(['pelamar' => $pelamar->fresh()->toArray()]);

        return redirect()->route('pelamar.profil')->with('success', 'Profil berhasil diperbarui.');
    }

    // ─────────────────────────────────────────────────────────────────────────
    // LAMARAN
    // ─────────────────────────────────────────────────────────────────────────

    /** Form melamar lowongan */
    public function formLamar($lowonganId)
    {
        $pelamarId = session('pelamar')['id_pelamar'];
        $lowongan  = Lowongan::with('departemen')->where('status', 'aktif')->findOrFail($lowonganId);

        // Cek lamaran ganda
        $sudahLamar = Lamaran::where('id_pelamar', $pelamarId)
            ->where('id_lowongan', $lowonganId)
            ->exists();

        if ($sudahLamar) {
            return redirect()->route('pelamar.riwayat')->with('error', 'Anda sudah pernah melamar pada lowongan ini.');
        }

        return view('pelamar.lamar', compact('lowongan'));
    }

    /** Kirim lamaran */
    public function kirimLamar(Request $request, $lowonganId)
    {
        $pelamarId = session('pelamar')['id_pelamar'];
        $lowongan  = Lowongan::where('status', 'aktif')->findOrFail($lowonganId);

        // Cek lamaran ganda
        $sudahLamar = Lamaran::where('id_pelamar', $pelamarId)
            ->where('id_lowongan', $lowonganId)
            ->exists();

        if ($sudahLamar) {
            return redirect()->route('pelamar.riwayat')->with('error', 'Anda sudah pernah melamar pada lowongan ini.');
        }

        $request->validate([
            'dokumen'         => 'required|array|min:1',
            'dokumen.*.jenis' => 'required|string|max:100',
            'dokumen.*.file'  => 'required|file|mimes:pdf|max:2048',
        ], [
            'dokumen.required'         => 'Minimal satu dokumen wajib diunggah.',
            'dokumen.*.jenis.required' => 'Jenis dokumen wajib dipilih.',
            'dokumen.*.file.required'  => 'File dokumen wajib diunggah.',
            'dokumen.*.file.mimes'     => 'Dokumen harus dalam format PDF.',
            'dokumen.*.file.max'       => 'Ukuran dokumen maksimal 2 MB.',
        ]);

        // Buat data lamaran
        $lamaran = Lamaran::create([
            'id_pelamar'     => $pelamarId,
            'id_lowongan'    => $lowonganId,
            'tgl_lamar'      => now()->toDateString(),
            'status_lamaran' => 'Menunggu',
        ]);

        // Simpan dokumen-dokumen
        foreach ($request->dokumen as $dok) {
            $path = $dok['file']->store('dokumen', 'public');
            DokumenLamaran::create([
                'id_lamaran'    => $lamaran->id_lamaran,
                'jenis_dokumen' => $dok['jenis'],
                'nama_file'     => $dok['file']->getClientOriginalName(),
                'path_file'     => $path,
            ]);
        }

        return redirect()->route('pelamar.riwayat')->with('success', 'Lamaran berhasil dikirim! Silakan pantau status lamaran Anda.');
    }

    // ─────────────────────────────────────────────────────────────────────────
    // RIWAYAT LAMARAN
    // ─────────────────────────────────────────────────────────────────────────

    public function riwayat()
    {
        $pelamarId = session('pelamar')['id_pelamar'];

        $lamarans = Lamaran::with(['lowongan.departemen', 'wawancaras'])
            ->where('id_pelamar', $pelamarId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pelamar.riwayat', compact('lamarans'));
    }

    /** Detail lamaran pelamar */
    public function detailLamaran($id)
    {
        $pelamarId = session('pelamar')['id_pelamar'];
        $lamaran   = Lamaran::with(['lowongan.departemen', 'dokumens', 'wawancaras'])
            ->where('id_pelamar', $pelamarId)
            ->findOrFail($id);

        return view('pelamar.detail-lamaran', compact('lamaran'));
    }
}
