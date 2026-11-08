@extends('layouts.hrd')

@section('title', 'Manajemen Lamaran')
@section('page-title', 'Manajemen Lamaran')
@section('breadcrumb')
    <li class="breadcrumb-item active">Lamaran</li>
@endsection

@section('content')
<!-- Filter -->
<div class="card border-0 shadow-sm mb-4" style="border-radius:12px;">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('hrd.lamaran.index') }}" class="row g-2">
            <div class="col-md-5">
                <select name="lowongan_id" class="form-select form-select-sm">
                    <option value="">Semua Lowongan</option>
                    @foreach($lowongans as $low)
                    <option value="{{ $low->id_lowongan }}" {{ request('lowongan_id') == $low->id_lowongan ? 'selected' : '' }}>
                        {{ $low->judul }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    @foreach(['Menunggu','Diterima Berkas','Seleksi','Wawancara','Diterima','Ditolak'] as $s)
                    <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-sm btn-success w-100"><i class="bi bi-filter me-1"></i>Filter</button>
                    @if(request()->anyFilled(['lowongan_id','status']))
                    <a href="{{ route('hrd.lamaran.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-x"></i></a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-header bg-white border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0">Daftar Lamaran</h6>
        <span class="badge text-bg-secondary">{{ $lamarans->total() }} lamaran</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Pelamar</th>
                        <th>Posisi</th>
                        <th>Tgl Lamar</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lamarans as $lam)
                    <tr>
                        <td class="ps-4 text-muted" style="font-size:.8rem;">{{ $lamarans->firstItem() + $loop->index }}</td>
                        <td>
                            <div class="fw-semibold" style="font-size:.875rem;">{{ $lam->pelamar->nama }}</div>
                            <div class="text-muted" style="font-size:.75rem;">{{ $lam->pelamar->email }}</div>
                        </td>
                        <td>
                            <div style="font-size:.875rem;">{{ $lam->lowongan->judul }}</div>
                            <div class="text-muted" style="font-size:.75rem;">{{ $lam->lowongan->departemen->nama_departemen ?? '' }}</div>
                        </td>
                        <td style="font-size:.8rem;color:#64748b;">{{ $lam->tgl_lamar->format('d M Y') }}</td>
                        <td>@include('partials.badge-status', ['status' => $lam->status_lamaran])</td>
                        <td class="text-center">
                            <a href="{{ route('hrd.lamaran.detail', $lam->id_lamaran) }}" class="btn btn-sm btn-outline-success">
                                <i class="bi bi-eye me-1"></i>Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-5 text-muted">Belum ada lamaran masuk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($lamarans->hasPages())
    <div class="card-footer bg-white border-top d-flex justify-content-end p-3">
        {{ $lamarans->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
