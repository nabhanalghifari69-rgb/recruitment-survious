<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pelamar — Recruitment PT. SURVIOUS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #4c1d95 0%, #7c3aed 100%); min-height: 100vh; display: flex; align-items: center; font-family: 'Segoe UI', system-ui, sans-serif; }
        .login-card { border: none; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,.4); }
        .login-header { background: linear-gradient(135deg, #5b21b6, #7c3aed); border-radius: 16px 16px 0 0; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card login-card">
                <div class="login-header text-white text-center p-4">
                    <div style="width:60px;height:60px;background:rgba(255,255,255,.15);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto .75rem;">
                        <i class="bi bi-person-circle fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-0">Login Pelamar</h5>
                    <p class="mb-0 opacity-75" style="font-size:.8rem;">Recruitment PT. SURVIOUS</p>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                    <div class="alert alert-success d-flex align-items-center gap-2 py-2">
                        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                    </div>
                    @endif
                    @if($errors->has('login'))
                    <div class="alert alert-danger d-flex align-items-center gap-2 py-2">
                        <i class="bi bi-exclamation-circle-fill"></i> {{ $errors->first('login') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('pelamar.login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size:.875rem;">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope-fill text-muted"></i></span>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Email terdaftar" value="{{ old('email') }}" required autofocus>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold" style="font-size:.875rem;">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill text-muted"></i></span>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Masukkan password" required>
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <button type="submit" class="btn w-100 fw-semibold text-white" style="background:#7c3aed;border-color:#7c3aed;">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                        </button>
                    </form>

                    <hr class="my-3">
                    <p class="text-center mb-0" style="font-size:.875rem;">
                        Belum punya akun?
                        <a href="{{ route('pelamar.register') }}" class="fw-semibold text-decoration-none" style="color:#7c3aed;">Daftar Sekarang</a>
                    </p>
                    <div class="text-center mt-2">
                        <a href="{{ route('beranda') }}" class="text-decoration-none text-muted" style="font-size:.8rem;">
                            <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
