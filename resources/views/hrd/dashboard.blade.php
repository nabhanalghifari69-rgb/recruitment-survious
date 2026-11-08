@extends('layouts.hrd')

@section('title', 'Dashboard HRD')
@section('page-title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background:#d1fae5;"><i class="bi bi-briefcase-fill" style="color:#059669;"></i></div>
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
                    <div class="stat-icon" style="background:#dcfce7;"><i class="bi bi-check-circle-fill" style="color:#16a34a;"></i></div>
                    <div>
                        <div style="font-size:1.75rem;font-weight:700;color:#1e293b;line-height:1;">{{ $totalLowonganAktif }}</div>
                        <div class="text-muted" style="font-size:.8rem;">Lowongan Aktif</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background:#dbeafe;"><i class="bi bi-file-earmark-person-fill text-primary"></i></div>
                    <div>
                        <div style="font-size:1.75rem;font-weight:700;color:#1e293b;line-height:1;">{{ $totalLamaran }}</div>
                        <div class="text-muted" style="font-size:.8rem;">Total Lamaran</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background:#ede9fe;"><i class="bi bi-calendar-check-fill" style="color:#7c3aed;"></i></div>
                    <div>
                        <div style="font-size:1.75rem;font-weight:700;color:#1e293b;line-height:1;">{{ $totalWawancara }}</div>
                        <div class="text-muted" style="font-size:.8rem;">Jadwal Wawancara</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Lamaran Terbaru -->
<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3 px-4">
        <h6 class="fw-bold mb-0">Lamaran Terbaru</h6>
        <a href="{{ route('hrd.lamaran.index') }}" class="btn btn-outline-success btn-sm">Lihat Semua</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Pelamar</th>
                        <th>Posisi</th>
                        <th>Tgl Lamar</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lamaranTerbaru as $lam)
                    <tr>
                        <td class="ps-4">
                            <div class="fw-semibold" style="font-size:.875rem;">{{ $lam->pelamar->nama }}</div>
                            <div class="text-muted" style="font-size:.75rem;">{{ $lam->pelamar->email }}</div>
                        </td>
                        <td style="font-size:.875rem;">{{ $lam->lowongan->judul }}</td>
                        <td style="font-size:.8rem;color:#64748b;">{{ $lam->tgl_lamar->format('d M Y') }}</td>
                        <td>@include('partials.badge-status', ['status' => $lam->status_lamaran])</td>
                        <td class="text-center">
                            <a href="{{ route('hrd.lamaran.detail', $lam->id_lamaran) }}" class="btn btn-sm btn-outline-success">
                                Detail <i class="bi bi-arrow-right"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada lamaran masuk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
