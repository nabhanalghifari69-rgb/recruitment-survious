<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\HrdAuthController;
use App\Http\Controllers\Auth\PelamarAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Hrd\HrdController;
use App\Http\Controllers\Pelamar\PelamarController;

// ═══════════════════════════════════════════════════════════════════════════
// HALAMAN PUBLIK
// ═══════════════════════════════════════════════════════════════════════════

Route::get('/', [PublicController::class, 'beranda'])->name('beranda');
Route::get('/lowongan', [PublicController::class, 'lowongan'])->name('lowongan.index');
Route::get('/lowongan/{id}', [PublicController::class, 'detailLowongan'])->name('lowongan.detail');

// ═══════════════════════════════════════════════════════════════════════════
// ADMIN AUTH
// ═══════════════════════════════════════════════════════════════════════════

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Panel Admin (dilindungi middleware)
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Manajemen HRD
        Route::get('/hrd', [AdminController::class, 'indexHrd'])->name('hrd.index');
        Route::get('/hrd/tambah', [AdminController::class, 'createHrd'])->name('hrd.create');
        Route::post('/hrd', [AdminController::class, 'storeHrd'])->name('hrd.store');
        Route::get('/hrd/{id}/edit', [AdminController::class, 'editHrd'])->name('hrd.edit');
        Route::put('/hrd/{id}', [AdminController::class, 'updateHrd'])->name('hrd.update');
        Route::delete('/hrd/{id}', [AdminController::class, 'destroyHrd'])->name('hrd.destroy');

        // Manajemen Departemen
        Route::get('/departemen', [AdminController::class, 'indexDepartemen'])->name('departemen.index');
        Route::get('/departemen/tambah', [AdminController::class, 'createDepartemen'])->name('departemen.create');
        Route::post('/departemen', [AdminController::class, 'storeDepartemen'])->name('departemen.store');
        Route::get('/departemen/{id}/edit', [AdminController::class, 'editDepartemen'])->name('departemen.edit');
        Route::put('/departemen/{id}', [AdminController::class, 'updateDepartemen'])->name('departemen.update');
        Route::delete('/departemen/{id}', [AdminController::class, 'destroyDepartemen'])->name('departemen.destroy');

        // Profil Perusahaan
        Route::get('/profil', [AdminController::class, 'editProfil'])->name('profil.edit');
        Route::put('/profil', [AdminController::class, 'updateProfil'])->name('profil.update');
    });
});

// ═══════════════════════════════════════════════════════════════════════════
// HRD AUTH
// ═══════════════════════════════════════════════════════════════════════════

Route::prefix('hrd')->name('hrd.')->group(function () {
    Route::get('/login', [HrdAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [HrdAuthController::class, 'login']);
    Route::post('/logout', [HrdAuthController::class, 'logout'])->name('logout');

    // Panel HRD (dilindungi middleware)
    Route::middleware('hrd')->group(function () {
        Route::get('/dashboard', [HrdController::class, 'dashboard'])->name('dashboard');

        // Manajemen Lowongan
        Route::get('/lowongan', [HrdController::class, 'indexLowongan'])->name('lowongan.index');
        Route::get('/lowongan/tambah', [HrdController::class, 'createLowongan'])->name('lowongan.create');
        Route::post('/lowongan', [HrdController::class, 'storeLowongan'])->name('lowongan.store');
        Route::get('/lowongan/{id}/edit', [HrdController::class, 'editLowongan'])->name('lowongan.edit');
        Route::put('/lowongan/{id}', [HrdController::class, 'updateLowongan'])->name('lowongan.update');
        Route::delete('/lowongan/{id}', [HrdController::class, 'destroyLowongan'])->name('lowongan.destroy');

        // Manajemen Lamaran
        Route::get('/lamaran', [HrdController::class, 'indexLamaran'])->name('lamaran.index');
        Route::get('/lamaran/{id}', [HrdController::class, 'detailLamaran'])->name('lamaran.detail');
        Route::put('/lamaran/{id}/status', [HrdController::class, 'updateStatusLamaran'])->name('lamaran.update-status');

        // Wawancara
        Route::get('/lamaran/{lamaranId}/wawancara/tambah', [HrdController::class, 'createWawancara'])->name('wawancara.create');
        Route::post('/lamaran/{lamaranId}/wawancara', [HrdController::class, 'storeWawancara'])->name('wawancara.store');
        Route::put('/wawancara/{id}/hasil', [HrdController::class, 'updateHasilWawancara'])->name('wawancara.hasil');
    });
});

// ═══════════════════════════════════════════════════════════════════════════
// PELAMAR AUTH
// ═══════════════════════════════════════════════════════════════════════════

Route::prefix('pelamar')->name('pelamar.')->group(function () {
    Route::get('/login', [PelamarAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [PelamarAuthController::class, 'login']);
    Route::get('/daftar', [PelamarAuthController::class, 'showRegister'])->name('register');
    Route::post('/daftar', [PelamarAuthController::class, 'register']);
    Route::post('/logout', [PelamarAuthController::class, 'logout'])->name('logout');

    // Panel Pelamar (dilindungi middleware)
    Route::middleware('pelamar')->group(function () {
        Route::get('/dashboard', [PelamarController::class, 'dashboard'])->name('dashboard');

        // Profil
        Route::get('/profil', [PelamarController::class, 'editProfil'])->name('profil');
        Route::put('/profil', [PelamarController::class, 'updateProfil'])->name('profil.update');

        // Lamaran
        Route::get('/lamar/{lowonganId}', [PelamarController::class, 'formLamar'])->name('lamar');
        Route::post('/lamar/{lowonganId}', [PelamarController::class, 'kirimLamar'])->name('lamar.kirim');

        // Riwayat
        Route::get('/riwayat', [PelamarController::class, 'riwayat'])->name('riwayat');
        Route::get('/riwayat/{id}', [PelamarController::class, 'detailLamaran'])->name('riwayat.detail');
    });
});
