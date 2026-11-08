<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Hrd;
use App\Models\Lowongan;
use App\Models\Lamaran;
use App\Models\DokumenLamaran;
use App\Models\Wawancara;
use App\Models\Departemen;
use Illuminate\Http\Request;

class HrdController extends Controller
{
    // ─────────────────────────────────────────────────────────────────────────
    // DASHBOARD
    // ─────────────────────────────────────────────────────────────────────────

    public function dashboard()
    {
        $hrdData = session('hrd');
        $hrdId   = $hrdData['id_hrd'];

        $totalLowongan    = Lowongan::where('id_hrd', $hrdId)->count();
        $totalLowonganAktif = Lowongan::where('id_hrd', $hrdId)->where('status', 'aktif')->count();
        $totalLamaran     = Lamaran::whereHas('lowongan', fn($q) => $q->where('id_hrd', $hrdId))->count();
        $totalWawancara   = Wawancara::whereHas('lamaran.lowongan', fn($q) => $q->where('id_hrd', $hrdId))->count();

        // Lamaran terbaru
        $lamaranTerbaru = Lamaran::with(['pelamar', 'lowongan'])
            ->whereHas('lowongan', fn($q) => $q->where('id_hrd', $hrdId))
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('hrd.dashboard', compact(
            'totalLowongan', 'totalLowonganAktif', 'totalLamaran', 'totalWawancara', 'lamaranTerbaru'
        ));
    }

    // ─────────────────────────────────────────────────────────────────────────
    // MANAJEMEN LOWONGAN
    // ─────────────────────────────────────────────────────────────────────────

    public function indexLowongan()
    {
        $hrdId     = session('hrd')['id_hrd'];
        $lowongans = Lowongan::with('departemen')
            ->where('id_hrd', $hrdId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('hrd.lowongan.index', compact('lowongans'));
    }

    public function createLowongan()
    {
        $departemens = Departemen::orderBy('nama_departemen')->get();
        return view('hrd.lowongan.create', compact('departemens'));
    }

    public function storeLowongan(Request $request)
    {
        $request->validate([
            'id_departemen' => 'required|exists:departemen,id_departemen',
            'judul'         => 'required|string|max:255',
            'deskripsi'     => 'required|string',
            'lokasi'        => 'required|string|max:100',
            'kategori'      => 'required|in:Full Time,Part Time,Kontrak,Magang',
            'gaji'          => 'nullable|string|max:100',
            'tgl_tutup'     => 'required|date|after:today',
            'status'        => 'required|in:aktif,nonaktif',
        ], [
            'id_departemen.required' => 'Departemen wajib dipilih.',
            'id_departemen.exists'   => 'Departemen tidak valid.',
            'judul.required'         => 'Judul lowongan wajib diisi.',
            'deskripsi.required'     => 'Deskripsi wajib diisi.',
            'lokasi.required'        => 'Lokasi wajib diisi.',
            'kategori.required'      => 'Kategori wajib dipilih.',
            'tgl_tutup.required'     => 'Tanggal tutup wajib diisi.',
            'tgl_tutup.after'        => 'Tanggal tutup harus setelah hari ini.',
        ]);

        $hrdId = session('hrd')['id_hrd'];

        Lowongan::create([
            'id_hrd'        => $hrdId,
            'id_departemen' => $request->id_departemen,
            'judul'         => $request->judul,
            'deskripsi'     => $request->deskripsi,
            'lokasi'        => $request->lokasi,
            'kategori'      => $request->kategori,
            'gaji'          => $request->gaji,
            'tgl_tutup'     => $request->tgl_tutup,
            'status'        => $request->status,
        ]);

        return redirect()->route('hrd.lowongan.index')->with('success', 'Lowongan berhasil ditambahkan.');
    }

    public function editLowongan($id)
    {
        $hrdId    = session('hrd')['id_hrd'];
        $lowongan = Lowongan::where('id_hrd', $hrdId)->findOrFail($id);
        $departemens = Departemen::orderBy('nama_departemen')->get();
        return view('hrd.lowongan.edit', compact('lowongan', 'departemens'));
    }

    public function updateLowongan(Request $request, $id)
    {
        $hrdId    = session('hrd')['id_hrd'];
        $lowongan = Lowongan::where('id_hrd', $hrdId)->findOrFail($id);

        $request->validate([
            'id_departemen' => 'required|exists:departemen,id_departemen',
            'judul'         => 'required|string|max:255',
            'deskripsi'     => 'required|string',
            'lokasi'        => 'required|string|max:100',
            'kategori'      => 'required|in:Full Time,Part Time,Kontrak,Magang',
            'gaji'          => 'nullable|string|max:100',
            'tgl_tutup'     => 'required|date',
            'status'        => 'required|in:aktif,nonaktif',
        ], [
            'id_departemen.required' => 'Departemen wajib dipilih.',
            'judul.required'         => 'Judul lowongan wajib diisi.',
            'deskripsi.required'     => 'Deskripsi wajib diisi.',
            'lokasi.required'        => 'Lokasi wajib diisi.',
            'kategori.required'      => 'Kategori wajib dipilih.',
            'tgl_tutup.required'     => 'Tanggal tutup wajib diisi.',
        ]);

        $lowongan->update($request->only(
            'id_departemen', 'judul', 'deskripsi', 'lokasi', 'kategori', 'gaji', 'tgl_tutup', 'status'
        ));

        return redirect()->route('hrd.lowongan.index')->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroyLowongan($id)
    {
        $hrdId    = session('hrd')['id_hrd'];
        $lowongan = Lowongan::where('id_hrd', $hrdId)->findOrFail($id);
        $lowongan->delete();
        return redirect()->route('hrd.lowongan.index')->with('success', 'Lowongan berhasil dihapus.');
    }

    // ─────────────────────────────────────────────────────────────────────────
    // MANAJEMEN LAMARAN
    // ─────────────────────────────────────────────────────────────────────────

    /** Daftar lamaran per lowongan milik HRD ini */
    public function indexLamaran(Request $request)
    {
        $hrdId     = session('hrd')['id_hrd'];
        $lowongans = Lowongan::where('id_hrd', $hrdId)->get();

        $query = Lamaran::with(['pelamar', 'lowongan.departemen'])
            ->whereHas('lowongan', fn($q) => $q->where('id_hrd', $hrdId));

        if ($request->lowongan_id) {
            $query->where('id_lowongan', $request->lowongan_id);
        }

        if ($request->status) {
            $query->where('status_lamaran', $request->status);
        }

        $lamarans = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('hrd.lamaran.index', compact('lamarans', 'lowongans'));
    }

    /** Detail lamaran & dokumen */
    public function detailLamaran($id)
    {
        $hrdId   = session('hrd')['id_hrd'];
        $lamaran = Lamaran::with(['pelamar', 'lowongan', 'dokumens', 'wawancaras'])
            ->whereHas('lowongan', fn($q) => $q->where('id_hrd', $hrdId))
            ->findOrFail($id);

        return view('hrd.lamaran.detail', compact('lamaran'));
    }

    /** Update status lamaran dan catatan HRD */
    public function updateStatusLamaran(Request $request, $id)
    {
        $hrdId   = session('hrd')['id_hrd'];
        $lamaran = Lamaran::whereHas('lowongan', fn($q) => $q->where('id_hrd', $hrdId))->findOrFail($id);

        $request->validate([
            'status_lamaran' => 'required|in:Menunggu,Diterima Berkas,Seleksi,Wawancara,Diterima,Ditolak',
            'catatan_hrd'    => 'nullable|string',
        ], [
            'status_lamaran.required' => 'Status lamaran wajib dipilih.',
            'status_lamaran.in'       => 'Status lamaran tidak valid.',
        ]);

        $lamaran->update([
            'status_lamaran' => $request->status_lamaran,
            'catatan_hrd'    => $request->catatan_hrd,
        ]);

        return redirect()->route('hrd.lamaran.detail', $id)->with('success', 'Status lamaran berhasil diperbarui.');
    }

    // ─────────────────────────────────────────────────────────────────────────
    // JADWAL WAWANCARA
    // ─────────────────────────────────────────────────────────────────────────

    /** Form tambah jadwal wawancara */
    public function createWawancara($lamaranId)
    {
        $hrdId   = session('hrd')['id_hrd'];
        $lamaran = Lamaran::with(['pelamar', 'lowongan'])
            ->whereHas('lowongan', fn($q) => $q->where('id_hrd', $hrdId))
            ->findOrFail($lamaranId);

        return view('hrd.wawancara.create', compact('lamaran'));
    }

    /** Simpan jadwal wawancara */
    public function storeWawancara(Request $request, $lamaranId)
    {
        $hrdId   = session('hrd')['id_hrd'];
        $lamaran = Lamaran::whereHas('lowongan', fn($q) => $q->where('id_hrd', $hrdId))->findOrFail($lamaranId);

        $request->validate([
            'tgl_wawancara' => 'required|date',
            'jam'           => 'required',
            'tempat'        => 'required|string|max:255',
        ], [
            'tgl_wawancara.required' => 'Tanggal wawancara wajib diisi.',
            'jam.required'           => 'Jam wawancara wajib diisi.',
            'tempat.required'        => 'Tempat wawancara wajib diisi.',
        ]);

        Wawancara::create([
            'id_lamaran'    => $lamaranId,
            'tgl_wawancara' => $request->tgl_wawancara,
            'jam'           => $request->jam,
            'tempat'        => $request->tempat,
            'hasil'         => null,
        ]);

        // Otomatis update status lamaran menjadi Wawancara
        $lamaran->update(['status_lamaran' => 'Wawancara']);

        return redirect()->route('hrd.lamaran.detail', $lamaranId)->with('success', 'Jadwal wawancara berhasil ditambahkan.');
    }

    /** Isi hasil wawancara */
    public function updateHasilWawancara(Request $request, $id)
    {
        $hrdId = session('hrd')['id_hrd'];
        $wawancara = Wawancara::whereHas('lamaran.lowongan', fn($q) => $q->where('id_hrd', $hrdId))->findOrFail($id);

        $request->validate([
            'hasil' => 'required|string',
        ], [
            'hasil.required' => 'Hasil wawancara wajib diisi.',
        ]);

        $wawancara->update(['hasil' => $request->hasil]);

        return redirect()->route('hrd.lamaran.detail', $wawancara->id_lamaran)->with('success', 'Hasil wawancara berhasil disimpan.');
    }
}
