@extends('layouts.hrd')

@section('title', 'Tambah Lowongan')
@section('page-title', 'Tambah Lowongan Baru')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('hrd.lowongan.index') }}" class="text-decoration-none">Lowongan</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <h6 class="fw-bold mb-0"><i class="bi bi-briefcase-fill me-2" style="color:#059669;"></i>Form Tambah Lowongan</h6>
            </div>
            <div class="card-body p-4">
                @if($errors->any())
                <div class="alert alert-danger py-2 mb-4">
                    <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li style="font-size:.875rem;">{{ $e }}</li>@endforeach</ul>
                </div>
                @endif

                <form action="{{ route('hrd.lowongan.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:.875rem;">Judul Lowongan <span class="text-danger">*</span></label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                                value="{{ old('judul') }}" placeholder="Contoh: Frontend Developer" required>
                            @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:.875rem;">Departemen <span class="text-danger">*</span></label>
                            <select name="id_departemen" class="form-select @error('id_departemen') is-invalid @enderror" required>
                                <option value="">-- Pilih Departemen --</option>
                                @foreach($departemens as $dept)
                                <option value="{{ $dept->id_departemen }}" {{ old('id_departemen') == $dept->id_departemen ? 'selected' : '' }}>
                                    {{ $dept->nama_departemen }}
                                </option>
                                @endforeach
                            </select>
                            @error('id_departemen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:.875rem;">Kategori <span class="text-danger">*</span></label>
                            <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach(['Full Time', 'Part Time', 'Kontrak', 'Magang'] as $kat)
                                <option value="{{ $kat }}" {{ old('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                                @endforeach
                            </select>
                            @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:.875rem;">Lokasi <span class="text-danger">*</span></label>
                            <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
                                value="{{ old('lokasi') }}" placeholder="Contoh: Jakarta, Remote" required>
                            @error('lokasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:.875rem;">Rentang Gaji</label>
                            <input type="text" name="gaji" class="form-control @error('gaji') is-invalid @enderror"
                                value="{{ old('gaji') }}" placeholder="Contoh: Rp 8.000.000 - Rp 15.000.000">
                            @error('gaji')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:.875rem;">Tanggal Tutup <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_tutup" class="form-control @error('tgl_tutup') is-invalid @enderror"
                                value="{{ old('tgl_tutup') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                            @error('tgl_tutup')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:.875rem;">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="aktif" {{ old('status', 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:.875rem;">Deskripsi Lengkap <span class="text-danger">*</span></label>
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                rows="10" placeholder="Tuliskan deskripsi pekerjaan, tanggung jawab, dan kualifikasi..." required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn fw-semibold text-white" style="background:#059669;border-color:#059669;">
                            <i class="bi bi-check-lg me-1"></i>Simpan Lowongan
                        </button>
                        <a href="{{ route('hrd.lowongan.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
