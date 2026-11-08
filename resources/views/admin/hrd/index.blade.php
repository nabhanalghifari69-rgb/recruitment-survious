@extends('layouts.admin')

@section('title', 'Manajemen HRD')
@section('page-title', 'Manajemen HRD')
@section('breadcrumb')
    <li class="breadcrumb-item active">Manajemen HRD</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-0">Daftar Akun HRD</h5>
        <p class="text-muted mb-0" style="font-size:.8rem;">{{ $hrds->total() }} akun HRD terdaftar</p>
    </div>
    <a href="{{ route('admin.hrd.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Tambah HRD
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4" style="width:40px;">#</th>
                        <th>Nama HRD</th>
                        <th>Email</th>
                        <th>Jabatan</th>
                        <th>No. HP</th>
                        <th>Tgl Dibuat</th>
                        <th class="text-center" style="width:120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($hrds as $hrd)
                    <tr>
                        <td class="ps-4 text-muted" style="font-size:.8rem;">{{ $hrds->firstItem() + $loop->index }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:34px;height:34px;background:#d1fae5;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <i class="bi bi-person-badge-fill" style="color:#059669;font-size:.9rem;"></i>
                                </div>
                                <span class="fw-semibold" style="font-size:.875rem;">{{ $hrd->nama_hrd }}</span>
                            </div>
                        </td>
                        <td style="font-size:.85rem;">{{ $hrd->email }}</td>
                        <td><span class="badge text-bg-light text-muted">{{ $hrd->jabatan ?? '-' }}</span></td>
                        <td style="font-size:.85rem;">{{ $hrd->no_hp ?? '-' }}</td>
                        <td style="font-size:.8rem;color:#64748b;">{{ $hrd->created_at->format('d M Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.hrd.edit', $hrd->id_hrd) }}" class="btn btn-sm btn-outline-warning me-1" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.hrd.destroy', $hrd->id_hrd) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Hapus akun HRD ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-people" style="font-size:2rem;opacity:.3;"></i>
                            <div class="mt-2">Belum ada data HRD</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($hrds->hasPages())
    <div class="card-footer bg-white border-top d-flex justify-content-end p-3">
        {{ $hrds->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
