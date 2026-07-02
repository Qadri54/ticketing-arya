<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>TICKS ID | Ekosistem Event Terpadu</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Syne:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* ===== STRIPI-INSPIRED DESIGN SYSTEM (TICKS ID) ===== */
        :root {
            --primary: #696FC7;
            --primary-deep: #3D365C;
            --primary-press: #7C4585;
            --primary-soft: #C95792;
            --primary-subdued: #F8B55F;
            --brand-dark: #1c1e54;
            --ink: #0d253d;
            --ink-secondary: #273951;
            --ink-mute: #64748d;
            --canvas: #ffffff;
            --canvas-soft: #f6f9fc;
            --canvas-cream: #f5e9d4;
            --hairline: #e3e8ee;
            --ruby: #ea2261;

            --font-sans: 'Inter', system-ui, sans-serif;
            --rounded-pill: 9999px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: var(--font-sans);
            background: var(--canvas-soft);
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ─── GLOBAL NAVBAR (Bersih & Menyatu) ─── */
        .site-nav {
            background: transparent;
            padding: 20px 0;
            position: absolute; /* Agar background di bawahnya bisa naik ke atas */
            top: 0; left: 0; right: 0;
            z-index: 1030;
        }
        .nav-brand {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 24px;
            letter-spacing: -0.5px;
            color: #ffffff !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 20px;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .nav-links a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            transition: color 0.2s;
        }
        .nav-links a:hover, .nav-links a.active {
            color: var(--primary-subdued);
        }

        /* Tombol Navbar */
        .btn-nav-login {
            background: rgba(255,255,255,0.15);
            color: #ffffff;
            border: 1px solid rgba(255,255,255,0.2);
            padding: 8px 20px;
            border-radius: var(--rounded-pill);
            font-weight: 500;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.2s;
            backdrop-filter: blur(4px);
        }
        .btn-nav-login:hover { background: rgba(255,255,255,0.25); color: #fff; }

        .btn-nav-register {
            background: var(--primary);
            color: #ffffff;
            border: none;
            padding: 8px 24px;
            border-radius: var(--rounded-pill);
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(105,111,199,0.3);
        }
        .btn-nav-register:hover { background: var(--primary-press); color: #fff; transform: translateY(-1px); }

        /* ─── GLOBAL FOOTER (Premium & Padat) ─── */
        .site-footer {
            background: var(--brand-dark);
            color: rgba(255,255,255,0.7);
            padding: 64px 0 24px;
            margin-top: auto; /* Mendorong footer ke bawah jika konten sedikit */
            border-top: 4px solid var(--primary);
        }
        .footer-brand-title {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 24px;
            color: #ffffff;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .footer-heading {
            font-family: var(--font-sans);
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--primary-subdued);
            margin-bottom: 20px;
        }
        .footer-links { list-style: none; padding: 0; margin: 0; }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a {
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
        }
        .footer-links a:hover { color: #ffffff; }

        /* Form Subscribe */
        .newsletter-form { display: flex; margin-top: 16px; }
        .newsletter-form input {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            color: white;
            padding: 10px 16px;
            border-radius: 50px 0 0 50px;
            outline: none;
            width: 100%;
            font-size: 14px;
        }
        .newsletter-form input::placeholder { color: rgba(255,255,255,0.3); }
        .newsletter-form button {
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 0 50px 50px 0;
            font-weight: 600;
            font-size: 13px;
            transition: background 0.2s;
        }
        .newsletter-form button:hover { background: var(--primary-press); }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: 48px;
            padding-top: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            font-size: 13px;
            color: rgba(255,255,255,0.4);
        }
        .social-icons a {
            color: rgba(255,255,255,0.6);
            font-size: 18px;
            margin-left: 16px;
            transition: color 0.2s;
        }
        .social-icons a:hover { color: var(--primary-subdued); }
    </style>
</head>
<body>
    

    <nav class="site-nav">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="{{ url('/') }}" class="nav-brand">
                🎫 TICKS ID
            </a>

            <button class="navbar-toggler d-lg-none border-0 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <i class="bi bi-list fs-1"></i>
            </button>

            <div class="collapse navbar-collapse d-lg-flex justify-content-end align-items-center gap-4" id="navMain">
                <ul class="nav-links mt-3 mt-lg-0">
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li><a href="{{ url('/#packages') }}">Sponsorship</a></li>
                    <li><a href="{{ url('/#event-list') }}">Daftar Event</a></li>
                </ul>

                <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-nav-register">📁 Buka Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-nav-login">Masuk</a>
                        <a href="{{ route('register') }}" class="btn-nav-register">Daftar EO</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1">
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="row g-5">

                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand-title">
                        🎟️ TICKS ID
                    </div>
                    <p style="font-size: 14px; line-height: 1.6; margin-bottom: 24px;">
                        Integrated Event Ecosystem Platform. Solusi terbaik untuk manajemen tiket event, check-in QR Code, hingga pencarian sponsor dalam satu sistem modern.
                    </p>
                    <div class="social-icons" style="margin-left: -16px;">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-6">
                    <div class="footer-heading">Jelajahi</div>
                    <ul class="footer-links">
                        <li><a href="#">Semua Event</a></li>
                        <li><a href="#">Live Concert</a></li>
                        <li><a href="#">Tournament Sport</a></li>
                        <li><a href="#">Sponsorship Marketplace</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 col-6">
                    <div class="footer-heading">Perusahaan</div>
                    <ul class="footer-links">
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Hubungi Kami</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="footer-heading">Stay In The Loop</div>
                    <p style="font-size: 14px; line-height: 1.6; margin-bottom: 0;">
                        Dapatkan informasi event terbaru, promo tiket, dan tips mengelola event dari kami.
                    </p>
                    <form action="#" class="newsletter-form">
                        <input type="email" placeholder="Alamat email kamu..." required>
                        <button type="submit">Subscribe</button>
                    </form>
                </div>

            </div>

            <div class="footer-bottom">
                <div>&copy; {{ date('Y') }} <strong>TICKS ID</strong>. Seluruh Hak Cipta Dilindungi.</div>
                <div>Dirancang dengan ❤️ untuk Ekosistem Event Indonesia</div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
