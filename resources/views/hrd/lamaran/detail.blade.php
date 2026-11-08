@extends('layouts.hrd')

@section('title', 'Detail Lamaran')
@section('page-title', 'Detail Lamaran')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('hrd.lamaran.index') }}" class="text-decoration-none">Lamaran</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="row g-4">
    <!-- Info Lamaran -->
    <div class="col-lg-8">
        <!-- Data Pelamar -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius:12px;">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <h6 class="fw-bold mb-0"><i class="bi bi-person-circle me-2 text-primary"></i>Data Pelamar</h6>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="text-muted" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em;">Nama Lengkap</label>
                        <div class="fw-semibold">{{ $lamaran->pelamar->nama }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em;">Email</label>
                        <div>{{ $lamaran->pelamar->email }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em;">No. HP</label>
                        <div>{{ $lamaran->pelamar->no_hp ?? '-' }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em;">Pendidikan</label>
                        <div>{{ $lamaran->pelamar->pendidikan ?? '-' }}</div>
                    </div>
                    <div class="col-12">
                        <label class="text-muted" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em;">Alamat</label>
                        <div>{{ $lamaran->pelamar->alamat ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dokumen -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius:12px;">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <h6 class="fw-bold mb-0"><i class="bi bi-file-earmark-text me-2 text-warning"></i>Dokumen Lamaran</h6>
            </div>
            <div class="card-body p-4">
                @forelse($lamaran->dokumens as $dok)
                <div class="d-flex align-items-center justify-content-between p-3 rounded mb-2" style="background:#f8fafc;border:1px solid #e2e8f0;">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:36px;height:36px;background:#fee2e2;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                        </div>
                        <div>
                            <div class="fw-semibold" style="font-size:.875rem;">{{ $dok->nama_file }}</div>
                            <div class="text-muted" style="font-size:.75rem;">{{ $dok->jenis_dokumen }}</div>
                        </div>
                    </div>
                    <a href="{{ Storage::url($dok->path_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-download me-1"></i>Unduh
                    </a>
                </div>
                @empty
                <p class="text-muted mb-0" style="font-size:.875rem;">Tidak ada dokumen diunggah.</p>
                @endforelse
            </div>
        </div>

        <!-- Jadwal Wawancara -->
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-header bg-white border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0"><i class="bi bi-calendar-check me-2" style="color:#7c3aed;"></i>Jadwal Wawancara</h6>
                <a href="{{ route('hrd.wawancara.create', $lamaran->id_lamaran) }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-plus-lg me-1"></i>Tambah Jadwal
                </a>
            </div>
            <div class="card-body p-4">
                @forelse($lamaran->wawancaras as $w)
                <div class="border rounded p-3 mb-3" style="border-color:#e2e8f0!important;">
                    <div class="row g-2 mb-2">
                        <div class="col-sm-4">
                            <div class="text-muted" style="font-size:.73rem;text-transform:uppercase;">Tanggal</div>
                            <div class="fw-semibold" style="font-size:.875rem;">{{ $w->tgl_wawancara->format('d F Y') }}</div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-muted" style="font-size:.73rem;text-transform:uppercase;">Jam</div>
                            <div class="fw-semibold" style="font-size:.875rem;">{{ \Carbon\Carbon::parse($w->jam)->format('H:i') }} WIB</div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-muted" style="font-size:.73rem;text-transform:uppercase;">Tempat</div>
                            <div style="font-size:.875rem;">{{ $w->tempat }}</div>
                        </div>
                    </div>
                    <!-- Form Isi Hasil -->
                    <form action="{{ route('hrd.wawancara.hasil', $w->id_wawancara) }}" method="POST" class="mt-2">
                        @csrf @method('PUT')
                        <div class="mb-2">
                            <label class="form-label fw-semibold" style="font-size:.8rem;">Hasil Wawancara</label>
                            <textarea name="hasil" class="form-control form-control-sm" rows="2"
                                placeholder="Isi hasil wawancara setelah selesai...">{{ $w->hasil }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-sm btn-outline-success">
                            <i class="bi bi-save me-1"></i>Simpan Hasil
                        </button>
                    </form>
                </div>
                @empty
                <p class="text-muted mb-0" style="font-size:.875rem;">Belum ada jadwal wawancara.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Sidebar Update Status -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm sticky-top" style="border-radius:12px;top:80px;">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <h6 class="fw-bold mb-0">Info Lamaran</h6>
            </div>
            <div class="card-body p-4">
                <div class="d-flex flex-column gap-3 mb-4">
                    <div>
                        <div class="text-muted" style="font-size:.73rem;text-transform:uppercase;">Posisi</div>
                        <div class="fw-semibold">{{ $lamaran->lowongan->judul }}</div>
                    </div>
                    <div>
                        <div class="text-muted" style="font-size:.73rem;text-transform:uppercase;">Tgl Lamar</div>
                        <div>{{ $lamaran->tgl_lamar->format('d F Y') }}</div>
                    </div>
                    <div>
                        <div class="text-muted" style="font-size:.73rem;text-transform:uppercase;">Status Saat Ini</div>
                        @include('partials.badge-status', ['status' => $lamaran->status_lamaran])
                    </div>
                </div>

                <!-- Update Status Form -->
                <form action="{{ route('hrd.lamaran.update-status', $lamaran->id_lamaran) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:.8rem;">Ubah Status <span class="text-danger">*</span></label>
                        <select name="status_lamaran" class="form-select form-select-sm @error('status_lamaran') is-invalid @enderror" required>
                            @foreach(['Menunggu','Diterima Berkas','Seleksi','Wawancara','Diterima','Ditolak'] as $s)
                            <option value="{{ $s }}" {{ $lamaran->status_lamaran == $s ? 'selected' : '' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                        @error('status_lamaran')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:.8rem;">Catatan HRD</label>
                        <textarea name="catatan_hrd" class="form-control form-control-sm"
                            rows="4" placeholder="Catatan untuk pelamar...">{{ old('catatan_hrd', $lamaran->catatan_hrd) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-sm fw-semibold w-100 text-white" style="background:#059669;border-color:#059669;">
                        <i class="bi bi-check2-circle me-1"></i>Perbarui Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
