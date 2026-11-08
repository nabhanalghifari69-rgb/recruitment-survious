@extends('layouts.admin')

@section('title', 'Manajemen Departemen')
@section('page-title', 'Manajemen Departemen')
@section('breadcrumb')
    <li class="breadcrumb-item active">Departemen</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-0">Daftar Departemen</h5>
        <p class="text-muted mb-0" style="font-size:.8rem;">{{ $departemens->total() }} departemen terdaftar</p>
    </div>
    <a href="{{ route('admin.departemen.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Tambah Departemen
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4" style="width:40px;">#</th>
                        <th>Nama Departemen</th>
                        <th>Deskripsi</th>
                        <th class="text-center">Lowongan</th>
                        <th class="text-center" style="width:120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($departemens as $dept)
                    <tr>
                        <td class="ps-4 text-muted" style="font-size:.8rem;">{{ $departemens->firstItem() + $loop->index }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:32px;height:32px;background:#dbeafe;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                    <i class="bi bi-diagram-3-fill text-primary" style="font-size:.85rem;"></i>
                                </div>
                                <span class="fw-semibold" style="font-size:.875rem;">{{ $dept->nama_departemen }}</span>
                            </div>
                        </td>
                        <td style="font-size:.8rem;color:#64748b;">{{ Str::limit($dept->deskripsi, 80) ?? '-' }}</td>
                        <td class="text-center">
                            <span class="badge text-bg-primary rounded-pill">{{ $dept->lowongans_count }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.departemen.edit', $dept->id_departemen) }}" class="btn btn-sm btn-outline-warning me-1">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.departemen.destroy', $dept->id_departemen) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Hapus departemen ini? Semua lowongan terkait akan ikut terhapus.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-diagram-3" style="font-size:2rem;opacity:.3;"></i>
                            <div class="mt-2">Belum ada departemen</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($departemens->hasPages())
    <div class="card-footer bg-white border-top d-flex justify-content-end p-3">
        {{ $departemens->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
