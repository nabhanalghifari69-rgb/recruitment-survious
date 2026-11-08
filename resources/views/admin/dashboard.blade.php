@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <!-- Kartu Statistik -->
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background:#dbeafe;">
                        <i class="bi bi-people-fill text-primary"></i>
                    </div>
                    <div>
                        <div style="font-size:1.75rem;font-weight:700;color:#1e293b;line-height:1;">{{ $totalHrd }}</div>
                        <div class="text-muted" style="font-size:.8rem;">Total HRD</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background:#d1fae5;">
                        <i class="bi bi-briefcase-fill" style="color:#059669;"></i>
                    </div>
                    <div>
                        <div style="font-size:1.75rem;font-weight:700;color:#1e293b;line-height:1;">{{ $totalLowongan }}</div>
                        <div class="text-muted" style="font-size:.8rem;">Total Lowongan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background:#ede9fe;">
                        <i class="bi bi-person-lines-fill" style="color:#7c3aed;"></i>
                    </div>
                    <div>
                        <div style="font-size:1.75rem;font-weight:700;color:#1e293b;line-height:1;">{{ $totalPelamar }}</div>
                        <div class="text-muted" style="font-size:.8rem;">Total Pelamar</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background:#fef3c7;">
                        <i class="bi bi-file-earmark-text-fill" style="color:#d97706;"></i>
                    </div>
                    <div>
                        <div style="font-size:1.75rem;font-weight:700;color:#1e293b;line-height:1;">{{ $totalLamaran }}</div>
                        <div class="text-muted" style="font-size:.8rem;">Total Lamaran</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Aksi Cepat -->
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <h6 class="fw-bold mb-0">Aksi Cepat</h6>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <a href="{{ route('admin.hrd.create') }}" class="btn btn-outline-primary w-100 d-flex align-items-center gap-2 p-3">
                            <i class="bi bi-person-plus-fill fs-5"></i>
                            <div class="text-start">
                                <div class="fw-semibold">Tambah HRD</div>
                                <div style="font-size:.75rem;opacity:.7;">Buat akun HRD baru</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('admin.departemen.create') }}" class="btn btn-outline-success w-100 d-flex align-items-center gap-2 p-3">
                            <i class="bi bi-diagram-3-fill fs-5"></i>
                            <div class="text-start">
                                <div class="fw-semibold">Tambah Departemen</div>
                                <div style="font-size:.75rem;opacity:.7;">Buat departemen baru</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('admin.profil.edit') }}" class="btn btn-outline-warning w-100 d-flex align-items-center gap-2 p-3">
                            <i class="bi bi-building fs-5"></i>
                            <div class="text-start">
                                <div class="fw-semibold">Edit Profil</div>
                                <div style="font-size:.75rem;opacity:.7;">Perbarui profil perusahaan</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('lowongan.index') }}" target="_blank" class="btn btn-outline-secondary w-100 d-flex align-items-center gap-2 p-3">
                            <i class="bi bi-globe fs-5"></i>
                            <div class="text-start">
                                <div class="fw-semibold">Lihat Website</div>
                                <div style="font-size:.75rem;opacity:.7;">Tampilan publik</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius:12px;">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <h6 class="fw-bold mb-0">Info Sistem</h6>
            </div>
            <div class="card-body p-4">
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted" style="font-size:.85rem;">Versi Laravel</span>
                        <span class="badge text-bg-primary">v{{ app()->version() }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted" style="font-size:.85rem;">Environment</span>
                        <span class="badge text-bg-{{ app()->isProduction() ? 'danger' : 'success' }}">{{ app()->environment() }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted" style="font-size:.85rem;">Tanggal Hari Ini</span>
                        <span style="font-size:.85rem;font-weight:600;">{{ now()->translatedFormat('d M Y') }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted" style="font-size:.85rem;">Admin Login</span>
                        <span style="font-size:.85rem;font-weight:600;">{{ session('admin')['nama_admin'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
