<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun — Recruitment PT. SURVIOUS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #4c1d95 0%, #7c3aed 100%); min-height: 100vh; display: flex; align-items: center; padding: 2rem 0; font-family: 'Segoe UI', system-ui, sans-serif; }
        .register-card { border: none; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,.4); }
        .register-header { background: linear-gradient(135deg, #5b21b6, #7c3aed); border-radius: 16px 16px 0 0; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card register-card">
                <div class="register-header text-white text-center p-4">
                    <div style="width:56px;height:56px;background:rgba(255,255,255,.15);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto .75rem;">
                        <i class="bi bi-person-plus-fill fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-0">Daftar Akun Pelamar</h5>
                    <p class="mb-0 opacity-75" style="font-size:.8rem;">Recruitment PT. SURVIOUS</p>
                </div>
                <div class="card-body p-4">
                    @if($errors->any())
                    <div class="alert alert-danger py-2">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                            <li style="font-size:.875rem;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('pelamar.register') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold" style="font-size:.875rem;">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="Nama lengkap Anda" value="{{ old('nama') }}" required>
                                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="font-size:.875rem;">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="email@contoh.com" value="{{ old('email') }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="font-size:.875rem;">No. HP</label>
                                <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                                    placeholder="08xxxxxxxxxx" value="{{ old('no_hp') }}">
                                @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="font-size:.875rem;">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Minimal 6 karakter" required>
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="font-size:.875rem;">Konfirmasi Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Ulangi password" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold" style="font-size:.875rem;">Pendidikan Terakhir</label>
                                <select name="pendidikan" class="form-select @error('pendidikan') is-invalid @enderror">
                                    <option value="">-- Pilih Pendidikan --</option>
                                    <option value="SMA/SMK" {{ old('pendidikan') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                    <option value="D3" {{ old('pendidikan') == 'D3' ? 'selected' : '' }}>D3</option>
                                    <option value="S1" {{ old('pendidikan') == 'S1' ? 'selected' : '' }}>S1</option>
                                    <option value="S2" {{ old('pendidikan') == 'S2' ? 'selected' : '' }}>S2</option>
                                    <option value="S3" {{ old('pendidikan') == 'S3' ? 'selected' : '' }}>S3</option>
                                </select>
                                @error('pendidikan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold" style="font-size:.875rem;">Alamat</label>
                                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                    rows="2" placeholder="Alamat lengkap Anda">{{ old('alamat') }}</textarea>
                                @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn w-100 fw-semibold text-white" style="background:#7c3aed;border-color:#7c3aed;">
                                <i class="bi bi-person-check-fill me-2"></i>Daftar Sekarang
                            </button>
                        </div>
                    </form>

                    <hr class="my-3">
                    <p class="text-center mb-0" style="font-size:.875rem;">
                        Sudah punya akun?
                        <a href="{{ route('pelamar.login') }}" class="fw-semibold text-decoration-none" style="color:#7c3aed;">Masuk di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
