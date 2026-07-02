<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Akun | TICKS ID</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet">

    <style>
        /* ===== STRIPI-INSPIRED DESIGN SYSTEM ===== */
        :root {
            --primary: #696FC7;
            --primary-deep: #3D365C;
            --primary-press: #7C4585;
            --primary-soft: #C95792;
            --brand-dark-900: #1c1e54;
            --ink: #0d253d;
            --ink-secondary: #273951;
            --ink-mute: #64748d;
            --on-primary: #ffffff;
            --canvas: #ffffff;
            --hairline: #e3e8ee;
            --hairline-input: #a8c3de;
            --rounded-xl: 16px;
            --rounded-pill: 9999px;
            --shadow-level-2: 0 8px 24px rgba(0, 55, 112, 0.08), 0 2px 6px rgba(0, 55, 112, 0.04);
            --font-sans: 'Inter', 'SF Pro Display', system-ui, -apple-system, sans-serif;
        }

        body { font-family: var(--font-sans); }

        .gradient-mesh {
            background: radial-gradient(ellipse at 20% 30%, rgba(253, 244, 227, 0.8) 0%, rgba(255, 209, 165, 0.6) 25%, rgba(197, 163, 255, 0.5) 55%, rgba(105, 111, 199, 0.55) 75%, rgba(234, 34, 97, 0.35) 100%);
        }

        .card-stripi {
            background: var(--canvas);
            border-radius: var(--rounded-xl);
            border: 1px solid var(--hairline);
            box-shadow: var(--shadow-level-2);
        }

        .btn-primary-pill {
            background: var(--primary);
            color: var(--on-primary);
            padding: 12px 24px;
            border-radius: var(--rounded-pill);
            font-weight: 600;
            transition: all 0.2s;
            border: none;
        }

        .btn-primary-pill:hover {
            background: var(--primary-press);
            transform: translateY(-2px);
            color: white;
        }

        .form-control {
            border: 1px solid var(--hairline-input) !important;
            border-radius: 8px !important;
            padding: 12px 16px !important;
        }

        .form-control:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 3px rgba(105, 111, 199, 0.1) !important;
        }
    </style>
</head>
<body>

<div class="gradient-mesh min-vh-100 d-flex align-items-center justify-content-center p-3">
    <div class="card-stripi p-4 p-md-5" style="max-width: 450px; width: 100%;">

        <div class="text-center mb-4">
            <span class="fs-1 d-block mb-2">🎫</span>
            <h3 class="fw-bold m-0" style="color: var(--brand-dark-900); font-size: 24px;">Selamat Datang Kembali!</h3>
            <p class="text-muted small mt-2">Silakan masuk untuk melanjutkan pemesanan tiket event Medan.</p>
        </div>

        @if (session('status'))
            <div class="alert alert-info border-0 rounded-3 small shadow-sm mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label small fw-bold" style="color: var(--ink-secondary);">Alamat Email</label>
                <input id="email" type="email" name="email" class="form-control shadow-sm @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" required autofocus placeholder="contoh: anakmedan@gmail.com">
                @error('email')
                    <div class="invalid-feedback small fw-semibold">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label for="password" class="form-label small fw-bold m-0" style="color: var(--ink-secondary);">Kata Sandi</label>
                    @if (Route::has('password.request'))
                        <a class="small text-decoration-none fw-semibold" href="{{ route('password.request') }}" style="color: var(--primary); font-size: 12px;">
                            Lupa Kata Sandi?
                        </a>
                    @endif
                </div>
                <input id="password" type="password" name="password" class="form-control shadow-sm @error('password') is-invalid @enderror"
                       required placeholder="••••••••">
                @error('password')
                    <div class="invalid-feedback small fw-semibold">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4 form-check d-flex align-items-center gap-2">
                <input id="remember_me" type="checkbox" name="remember" class="form-check-input rounded border-gray-300" style="cursor: pointer;">
                <label for="remember_me" class="form-check-label small text-secondary select-none" style="cursor: pointer; font-size: 13px;">
                    Ingat akun saya di perangkat ini
                </label>
            </div>

            <button type="submit" class="btn-primary-pill w-100 mb-3 shadow-sm">
                Masuk Ke Akun Saya
            </button>

            <div class="text-center mt-4">
                <span class="text-secondary small">Belum punya akun? </span>
                <a href="{{ route('register') }}" class="small fw-bold text-decoration-none" style="color: var(--primary-soft);">
                    Daftar Sekarang
                </a>
            </div>
        </form>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
