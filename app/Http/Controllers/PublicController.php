<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use App\Models\ProfilPerusahaan;
use App\Models\Departemen;

class PublicController extends Controller
{
    /** Halaman Beranda / Landing Page */
    public function beranda()
    {
        $profil   = ProfilPerusahaan::first();
        $lowongans = Lowongan::with('departemen')
            ->where('status', 'aktif')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('public.beranda', compact('profil', 'lowongans'));
    }

    /** Halaman Daftar Lowongan dengan pencarian & filter */
    public function lowongan()
    {
        $query       = Lowongan::with(['departemen', 'hrd'])->where('status', 'aktif');
        $departemens = Departemen::all();

        // Filter pencarian
        if (request('cari')) {
            $query->where('judul', 'like', '%' . request('cari') . '%');
        }

        // Filter departemen
        if (request('departemen')) {
            $query->where('id_departemen', request('departemen'));
        }

        // Filter kategori
        if (request('kategori')) {
            $query->where('kategori', request('kategori'));
        }

        // Filter lokasi
        if (request('lokasi')) {
            $query->where('lokasi', 'like', '%' . request('lokasi') . '%');
        }

        $lowongans = $query->orderBy('created_at', 'desc')->paginate(9)->withQueryString();

        return view('public.lowongan', compact('lowongans', 'departemens'));
    }

    /** Halaman Detail Lowongan */
    public function detailLowongan($id)
    {
        $lowongan = Lowongan::with(['departemen', 'hrd'])->findOrFail($id);

        // Cek apakah lowongan masih aktif
        if ($lowongan->status !== 'aktif') {
            abort(404, 'Lowongan tidak ditemukan atau sudah ditutup.');
        }

        return view('public.detail-lowongan', compact('lowongan'));
    }
}
