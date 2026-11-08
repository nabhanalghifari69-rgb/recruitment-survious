@extends('layouts.admin')

@section('title', 'Profil Perusahaan')
@section('page-title', 'Profil Perusahaan')
@section('breadcrumb')
    <li class="breadcrumb-item active">Profil Perusahaan</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <h6 class="fw-bold mb-0"><i class="bi bi-building me-2 text-primary"></i>Edit Profil Perusahaan</h6>
            </div>
            <div class="card-body p-4">
                @if($errors->any())
                <div class="alert alert-danger py-2 mb-4">
                    <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li style="font-size:.875rem;">{{ $e }}</li>@endforeach</ul>
                </div>
                @endif

                <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <!-- Logo Preview -->
                    <div class="mb-4 text-center">
                        <div class="d-inline-block position-relative">
                            @if($profil->logo)
                            <img src="{{ Storage::url($profil->logo) }}" alt="Logo" class="rounded" style="height:80px;width:auto;object-fit:contain;border:2px solid #e2e8f0;padding:8px;">
                            @else
                            <div style="width:100px;height:80px;background:#dbeafe;border-radius:12px;display:flex;align-items:center;justify-content:center;border:2px dashed #93c5fd;">
                                <i class="bi bi-building text-primary fs-3"></i>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:.875rem;">Nama Perusahaan <span class="text-danger">*</span></label>
                            <input type="text" name="nama_perusahaan" class="form-control @error('nama_perusahaan') is-invalid @enderror"
                                value="{{ old('nama_perusahaan', $profil->nama_perusahaan) }}" required>
                            @error('nama_perusahaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:.875rem;">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $profil->email) }}" placeholder="info@perusahaan.co.id">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:.875rem;">Telepon</label>
                            <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror"
                                value="{{ old('telepon', $profil->telepon) }}" placeholder="(021) xxxx-xxxx">
                            @error('telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:.875rem;">Website</label>
                            <input type="url" name="website" class="form-control @error('website') is-invalid @enderror"
                                value="{{ old('website', $profil->website) }}" placeholder="https://www.perusahaan.co.id">
                            @error('website')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:.875rem;">Logo Perusahaan</label>
                            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">
                            <div class="form-text">Format: JPG/PNG/GIF, maks. 2 MB</div>
                            @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:.875rem;">Alamat</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                rows="2" placeholder="Alamat lengkap perusahaan">{{ old('alamat', $profil->alamat) }}</textarea>
                            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:.875rem;">Deskripsi Perusahaan</label>
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                rows="5" placeholder="Deskripsi singkat tentang perusahaan...">{{ old('deskripsi', $profil->deskripsi) }}</textarea>
                            @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan Perubahan</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
