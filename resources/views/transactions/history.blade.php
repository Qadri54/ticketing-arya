<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Tiket Saya | TICKS ID</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Syne:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
            --canvas-soft: #f6f9fc;
            --hairline: #e3e8ee;
            --ruby: #ea2261;

            --rounded-xl: 16px;
            --rounded-pill: 9999px;
            --shadow-level-1: 0 1px 3px rgba(0, 55, 112, 0.08);

            --font-sans: 'Inter', 'SF Pro Display', system-ui, -apple-system, sans-serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: var(--font-sans); background: var(--canvas-soft); color: var(--ink);
            font-weight: 300; line-height: 1.4; -webkit-font-smoothing: antialiased;
            display: flex; flex-direction: column; min-height: 100vh;
        }

        .btn-primary-pill {
            background: var(--primary); color: var(--on-primary); padding: 10px 24px; border-radius: var(--rounded-pill);
            font-weight: 600; font-size: 14px; border: none; transition: all 0.2s; display: inline-flex; align-items: center; justify-content: center; text-decoration: none;
        }
        .btn-primary-pill:hover { background: var(--primary-press); transform: translateY(-2px); color: white; box-shadow: 0 8px 20px rgba(105,111,199,0.3); }

        .btn-secondary {
            background: var(--canvas); color: var(--primary); padding: 8px 20px; border-radius: var(--rounded-pill); border: 1px solid var(--primary);
            font-weight: 600; font-size: 14px; transition: all 0.2s; text-decoration: none; text-align: center; display: inline-block;
        }
        .btn-secondary:hover { background: rgba(105,111,199,0.05); border-color: var(--primary-deep); }

        .gradient-mesh {
            position: relative;
            background: radial-gradient(ellipse at 20% 30%, rgba(253, 244, 227, 0.8) 0%, rgba(255, 209, 165, 0.6) 25%, rgba(197, 163, 255, 0.5) 55%, rgba(105, 111, 199, 0.55) 75%, rgba(234, 34, 97, 0.35) 100%);
            overflow: visible; 
            z-index: 50;       
        }
        .gradient-mesh::before {
            content: ""; position: absolute; inset: 0; background: radial-gradient(circle at 70% 40%, rgba(249, 107, 238, 0.2) 0%, rgba(105, 111, 199, 0.1) 60%, transparent 90%); pointer-events: none;
        }

        .nav-stripi { background: transparent; padding: 16px 0; }
        .nav-brand-stripi {
            font-family: 'Syne', sans-serif; font-weight: 800; font-size: 24px; letter-spacing: -0.5px;
            background: linear-gradient(135deg, var(--brand-dark-900), var(--primary-deep)); -webkit-background-clip: text; background-clip: text; color: transparent; text-decoration: none;
        }
        .nav-links-stripi a { font-weight: 500; font-size: 15px; color: var(--brand-dark-900); text-decoration: none; transition: color 0.2s; padding: 6px 12px; }
        .nav-links-stripi a:hover, .nav-links-stripi a.active { color: var(--ruby); }

        .card-stripi { background: var(--canvas); border-radius: var(--rounded-xl); border: 1px solid var(--hairline); box-shadow: var(--shadow-level-1); transition: transform 0.2s ease; }
        .card-stripi:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0, 55, 112, 0.08); }

        .page-title { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 28px; color: var(--ink); letter-spacing: -0.5px; }

        .status-badge { padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase; }
        .status-pending { background-color: #fef3c7; color: #d97706; }
        .status-paid { background-color: #ecfdf5; color: #059669; }
        .status-failed { background-color: #fef2f2; color: #dc2626; }

        /* ===== CSS UNTUK FOOTER BARU ===== */
        .site-footer { background: var(--brand-dark-900); color: rgba(255,255,255,0.7); padding-top: 64px; padding-bottom: 24px; margin-top: auto; }
        .footer-brand-title { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 24px; letter-spacing: -0.5px; color: white; margin-bottom: 16px; }
        .footer-heading { font-weight: 600; font-size: 16px; color: white; margin-bottom: 20px; }
        .footer-links { list-style: none; padding: 0; margin: 0; }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a { color: rgba(255,255,255,0.7); text-decoration: none; transition: color 0.3s; font-size: 14px; }
        .footer-links a:hover { color: white; }
        .social-icons a { display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.1); color: white; font-size: 18px; margin-right: 8px; transition: all 0.3s; text-decoration: none; }
        .social-icons a:hover { background: var(--primary); transform: translateY(-3px); }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,0.1); padding-top: 24px; margin-top: 48px; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 10px; font-size: 14px; }
    </style>
</head>
<body>

    <!-- NAVBAR (Header) -->
    <div class="gradient-mesh" style="padding-bottom: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <div class="container pt-3">
            <div class="nav-stripi d-flex align-items-center justify-content-between flex-wrap gap-3">
                <a href="{{ url('/') }}" class="nav-brand-stripi d-flex align-items-center gap-2">
                    <span>🎫 TICKS ID</span>
                </a>

                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <div class="nav-links-stripi d-flex gap-2">
                        <a href="{{ url('/') }}">Beranda</a>
                        <a href="{{ url('/#packages') }}">Paket Sponsor</a>
                        <a href="{{ url('/#event-list') }}">Daftar Event</a>
                    </div>

                    @auth
                        <div class="dropdown">
                            <button class="btn-primary-pill dropdown-toggle" type="button" data-bs-toggle="dropdown" style="padding:6px 20px; width: auto; font-size: 14px;">
                                👤 Halo, {{ explode(' ', Auth::user()->name)[0] }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2" style="border-radius: 12px; font-size: 14px; min-width: 200px;">
                                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'eo')
                                    <li><a class="dropdown-item py-2 fw-medium" href="{{ url('/admin/dashboard') }}">🎛️ Dashboard Event</a></li>
                                    <li><a class="dropdown-item py-2 fw-medium" href="{{ url('/scanner') }}">📷 Scanner Tiket</a></li>
                                @endif
                                <li><a class="dropdown-item py-2 fw-medium" href="{{ url('/history') }}">🎟️ Tiket Saya</a></li>
                                <li><a class="dropdown-item py-2 fw-medium" href="{{ url('/profile') }}">⚙️ Pengaturan Akun</a></li>
                                <li><hr class="dropdown-divider opacity-25"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 fw-bold text-danger">🚪 Keluar (Log Out)</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT (History Tiket) -->
    <main class="flex-grow-1 py-5">
        <div class="container" style="max-width: 900px;">

            <div class="mb-5 border-bottom pb-4" style="border-color: var(--hairline) !important;">
                <h2 class="page-title m-0 d-flex align-items-center gap-2">
                    🎟️ Tiket Saya
                </h2>
                <p class="text-muted mt-2 mb-0" style="font-size: 15px;">Kelola riwayat pembelian dan e-ticket event kamu di sini.</p>
            </div>

            <!-- Notifikasi Berhasil/Gagal -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm" style="background-color: #ecfdf5; color: #065f46; border-radius: 12px;" role="alert">
                    ✅ {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4 border-0 shadow-sm" style="background-color: #fef2f2; color: #991b1b; border-radius: 12px;" role="alert">
                    ❌ {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Daftar Transaksi -->
            @if($transactions->isEmpty())
                <div class="card-stripi p-5 text-center d-flex flex-column align-items-center justify-content-center" style="min-height: 350px;">
                    <div style="font-size: 64px; margin-bottom: 16px; opacity: 0.8;">🎫</div>
                    <h4 class="fw-bold mb-2" style="color: var(--ink-secondary); font-family: 'Syne', sans-serif;">Belum Ada Transaksi</h4>
                    <p class="text-muted mb-4" style="max-width: 400px; font-size: 15px;">Kamu belum pernah memesan tiket event manapun. Yuk, cari event seru dan pesan tiketmu sekarang!</p>
                    <a href="{{ url('/') }}" class="btn-primary-pill" style="padding: 12px 28px;">
                        Jelajahi Event Sekarang
                    </a>
                </div>
            @else
                <div class="d-flex flex-column gap-4">
                    @foreach($transactions as $trx)
                        <div class="card-stripi overflow-hidden">
                            <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between gap-4">

                                <!-- Info Kiri: Status & Detail Event -->
                                <div class="d-flex flex-column justify-content-center flex-grow-1">
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        @if($trx->payment_status == 'pending')
                                            <span class="status-badge status-pending">Menunggu Bayar</span>
                                        @elseif($trx->payment_status == 'paid')
                                            <span class="status-badge status-paid">Lunas</span>
                                        @else
                                            <span class="status-badge status-failed">Gagal / Expired</span>
                                        @endif
                                        <span class="text-muted" style="font-size: 12px; font-weight: 500;">
                                            ID: {{ $trx->order_id }}
                                        </span>
                                    </div>

                                    <h5 class="fw-bold mb-1" style="font-family: 'Syne', sans-serif; font-size: 22px; color: var(--ink);">
                                        {{ $trx->event->name }}
                                    </h5>

                                    <div class="text-muted d-flex align-items-center gap-2 mb-3" style="font-size: 14px;">
                                        <span>📅 {{ date('d M Y - H:i', strtotime($trx->event->event_date)) }} WIB</span>
                                    </div>

                                    <div class="d-flex flex-wrap align-items-center gap-3 p-2 px-3" style="background: var(--canvas-soft); border-radius: 8px; width: fit-content; border: 1px solid var(--hairline);">
                                        <div style="font-size: 13px;">
                                            <span class="text-muted">Jumlah:</span>
                                            <strong style="color: var(--ink);">{{ $trx->quantity }} Tiket</strong>
                                        </div>
                                        <div style="width: 1px; height: 14px; background: var(--hairline);"></div>
                                        <div style="font-size: 13px;">
                                            <span class="text-muted">Total:</span>
                                            <strong style="color: var(--primary);">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</strong>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tombol Kanan: Aksi Lanjutan -->
                                <div class="d-flex flex-column justify-content-center align-items-md-end mt-2 mt-md-0 pt-3 pt-md-0 border-top border-md-0" style="border-color: var(--hairline) !important;">

                                    @if($trx->payment_status == 'paid')
                                        <p class="text-success fw-bold mb-3 text-md-end" style="font-size: 12px;">✅ Pembayaran Berhasil</p>

                                        <div class="d-flex flex-column gap-2 w-100">
                                            <!-- FITUR BARU: Tombol YouTube khusus Event Hybrid -->
                                           @if(!empty($trx->event->youtube_link) && $trx->ticket_type == 'online')
                                            <a href="{{ $trx->event->youtube_link }}" target="_blank" class="btn-primary-pill text-center w-100 d-flex justify-content-center gap-2" style="background-color: #dc2626; min-width: 160px; box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2);">
                                                <i class="bi bi-youtube"></i> Tonton Livestream
                                            </a>
                                        @endif

                                        <a href="/transaction/{{ $trx->id }}" class="btn-primary-pill text-center w-100" style="min-width: 160px; @if(!empty($trx->event->youtube_link) && $trx->ticket_type == 'online') background-color: var(--canvas-soft); color: var(--primary-deep); border: 1px solid var(--hairline); box-shadow: none; @endif">
                                            Lihat E-Ticket
                                        </a>
                                        </div>

                                    @elseif($trx->payment_status == 'pending')
                                        <p class="text-warning fw-bold mb-2 text-md-end" style="font-size: 12px;">⚠️ Selesaikan Pembayaran</p>
                                        <a href="/transaction/{{ $trx->id }}" class="btn-primary-pill text-center w-100" style="min-width: 160px;">
                                            Bayar Sekarang
                                        </a>
                                    @else
                                        <p class="text-danger fw-bold mb-2 text-md-end" style="font-size: 12px;">❌ Transaksi Ditutup</p>
                                        <a href="/transaction/{{ $trx->id }}" class="btn-secondary text-center w-100" style="min-width: 160px; padding-top: 10px; padding-bottom: 10px;">
                                            Lihat Detail
                                        </a>
                                    @endif

                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </main>

    <!-- FOOTER -->
    <footer class="site-footer">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand-title">🎟️ TICKS ID</div>
                    <p style="font-size: 14px; line-height: 1.6; margin-bottom: 24px;">
                        Integrated Event Ecosystem Platform. Solusi terbaik untuk manajemen tiket event, check-in QR Code, hingga pencarian sponsor dalam satu sistem modern.
                    </p>
                    <div class="social-icons" style="margin-left: -4px;">
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
                    <p style="font-size: 14px; line-height: 1.6; margin-bottom: 16px;">
                        Dapatkan informasi event terbaru, promo tiket, dan tips mengelola event dari kami.
                    </p>
                </div>
            </div>

            <div class="footer-bottom">
                <div>&copy; {{ date('Y') }} <strong>TICKS ID</strong>. Seluruh Hak Cipta Dilindungi.</div>
                <div>Dirancang dengan ❤️ untuk Ekosistem Event Indonesia</div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
