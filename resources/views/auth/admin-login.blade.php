<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — Recruitment PT. SURVIOUS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%); min-height: 100vh; display: flex; align-items: center; font-family: 'Segoe UI', system-ui, sans-serif; }
        .login-card { border: none; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,.4); }
        .login-header { background: linear-gradient(135deg, #1e3a8a, #1e40af); border-radius: 16px 16px 0 0; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card login-card">
                <div class="login-header text-white text-center p-4">
                    <div style="width:60px;height:60px;background:rgba(255,255,255,.15);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto .75rem;">
                        <i class="bi bi-shield-lock-fill fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-0">Login Admin</h5>
                    <p class="mb-0 opacity-75" style="font-size:.8rem;">Recruitment PT. SURVIOUS</p>
                </div>
                <div class="card-body p-4">
                    @if($errors->has('login'))
                    <div class="alert alert-danger d-flex align-items-center gap-2 py-2">
                        <i class="bi bi-exclamation-circle-fill"></i> {{ $errors->first('login') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size:.875rem;">Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person-fill text-muted"></i></span>
                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                                    placeholder="Masukkan username" value="{{ old('username') }}" required autofocus>
                                @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                        <button type="submit" class="btn btn-primary w-100 fw-semibold" style="background:#1e40af;border-color:#1e40af;">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk sebagai Admin
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="{{ route('beranda') }}" class="text-decoration-none text-muted" style="font-size:.8rem;">
                            <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
            <p class="text-center text-white-50 mt-3" style="font-size:.75rem;">
                Login HRD? <a href="{{ route('hrd.login') }}" class="text-white">Klik di sini</a>
            </p>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
