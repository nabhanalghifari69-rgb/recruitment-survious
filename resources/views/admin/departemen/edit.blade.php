@extends('layouts.admin')

@section('title', 'Edit Departemen')
@section('page-title', 'Edit Departemen')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.departemen.index') }}" class="text-decoration-none">Departemen</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <h6 class="fw-bold mb-0"><i class="bi bi-pencil-square me-2 text-warning"></i>Edit Departemen: {{ $departemen->nama_departemen }}</h6>
            </div>
            <div class="card-body p-4">
                @if($errors->any())
                <div class="alert alert-danger py-2 mb-4">
                    <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li style="font-size:.875rem;">{{ $e }}</li>@endforeach</ul>
                </div>
                @endif

                <form action="{{ route('admin.departemen.update', $departemen->id_departemen) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:.875rem;">Nama Departemen <span class="text-danger">*</span></label>
                        <input type="text" name="nama_departemen" class="form-control @error('nama_departemen') is-invalid @enderror"
                            value="{{ old('nama_departemen', $departemen->nama_departemen) }}" required>
                        @error('nama_departemen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:.875rem;">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4">{{ old('deskripsi', $departemen->deskripsi) }}</textarea>
                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-warning"><i class="bi bi-check-lg me-1"></i>Perbarui</button>
                        <a href="{{ route('admin.departemen.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
