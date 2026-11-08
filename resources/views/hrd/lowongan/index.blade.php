@extends('layouts.hrd')

@section('title', 'Kelola Lowongan')
@section('page-title', 'Kelola Lowongan')
@section('breadcrumb')
    <li class="breadcrumb-item active">Lowongan</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-0">Daftar Lowongan Saya</h5>
        <p class="text-muted mb-0" style="font-size:.8rem;">{{ $lowongans->total() }} lowongan</p>
    </div>
    <a href="{{ route('hrd.lowongan.create') }}" class="btn btn-sm" style="background:#059669;color:#fff;border-color:#059669;">
        <i class="bi bi-plus-lg me-1"></i>Tambah Lowongan
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Judul Lowongan</th>
                        <th>Departemen</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Tgl Tutup</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Pelamar</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lowongans as $low)
                    <tr>
                        <td class="ps-4 text-muted" style="font-size:.8rem;">{{ $lowongans->firstItem() + $loop->index }}</td>
                        <td>
                            <span class="fw-semibold" style="font-size:.875rem;">{{ $low->judul }}</span>
                        </td>
                        <td style="font-size:.8rem;">{{ $low->departemen->nama_departemen ?? '-' }}</td>
                        <td><span class="badge" style="background:#dbeafe;color:#1e40af;font-size:.72rem;">{{ $low->kategori }}</span></td>
                        <td style="font-size:.8rem;"><i class="bi bi-geo-alt text-muted me-1"></i>{{ $low->lokasi }}</td>
                        <td style="font-size:.8rem;color:{{ $low->tgl_tutup->isPast() ? '#dc2626' : '#64748b' }};">
                            {{ $low->tgl_tutup->format('d M Y') }}
                        </td>
                        <td class="text-center">
                            <span class="badge {{ $low->status == 'aktif' ? 'badge-diterima' : 'badge-ditolak' }}">{{ ucfirst($low->status) }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge text-bg-primary rounded-pill">{{ $low->lamarans->count() }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('hrd.lowongan.edit', $low->id_lowongan) }}" class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('hrd.lowongan.destroy', $low->id_lowongan) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Hapus lowongan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center py-5 text-muted">Belum ada lowongan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($lowongans->hasPages())
    <div class="card-footer bg-white border-top d-flex justify-content-end p-3">
        {{ $lowongans->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
