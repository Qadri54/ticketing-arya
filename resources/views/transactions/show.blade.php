<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Invoice {{ $transaction->event->name }} | TICKS ID</title>

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
            --primary-bg-subdued-hover: #F8B55F;
            --brand-dark-900: #1c1e54;
            --ink: #0d253d;
            --ink-secondary: #273951;
            --ink-mute: #64748d;
            --on-primary: #ffffff;
            --canvas: #ffffff;
            --canvas-soft: #f6f9fc;
            --canvas-cream: #f5e9d4;
            --hairline: #e3e8ee;
            --hairline-input: #a8c3de;
            --ruby: #ea2261;
            --lemon: #9b6829;

            --spacing-xs: 4px;
            --spacing-sm: 8px;
            --spacing-md: 12px;
            --spacing-lg: 16px;
            --spacing-xl: 24px;
            --spacing-xxl: 32px;

            --rounded-xs: 4px;
            --rounded-sm: 6px;
            --rounded-md: 8px;
            --rounded-lg: 12px;
            --rounded-xl: 16px;
            --rounded-pill: 9999px;

            --shadow-level-1: 0 1px 3px rgba(0, 55, 112, 0.08);
            --shadow-level-2: 0 8px 24px rgba(0, 55, 112, 0.08), 0 2px 6px rgba(0, 55, 112, 0.04);

            --font-sans: 'Inter', 'SF Pro Display', system-ui, -apple-system, sans-serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: var(--font-sans); background: var(--canvas-soft); color: var(--ink);
            font-weight: 300; line-height: 1.4; font-feature-settings: "ss01"; -webkit-font-smoothing: antialiased;
            display: flex; flex-direction: column; min-height: 100vh;
        }

        .heading-lg { font-size: 22px; font-weight: 300; line-height: 1.1; letter-spacing: -0.22px; }
        .heading-md { font-size: 20px; font-weight: 300; line-height: 1.4; letter-spacing: -0.2px; }
        .heading-sm { font-size: 18px; font-weight: 300; line-height: 1.4; }
        .body-lg { font-size: 16px; font-weight: 300; line-height: 1.4; }
        .body-md { font-size: 15px; font-weight: 300; line-height: 1.4; }
        .button-sm { font-size: 14px; font-weight: 400; line-height: 1; }
        .micro-cap { font-size: 10px; font-weight: 500; line-height: 1.15; letter-spacing: 0.2px; text-transform: uppercase; }

        .btn-primary-pill {
            background: var(--primary); color: var(--on-primary); padding: 12px 24px; border-radius: var(--rounded-pill);
            font-weight: 600; font-size: 15px; border: none; transition: all 0.2s; display: inline-flex; align-items: center; justify-content: center; gap: 6px; text-decoration: none; width: 100%;
        }
        .btn-primary-pill:hover { background: var(--primary-press); transform: translateY(-2px); color: white; box-shadow: 0 8px 20px rgba(105,111,199,0.3); }
        .btn-secondary {
            background: var(--canvas); color: var(--primary); padding: 8px 16px; border-radius: var(--rounded-pill); border: 1px solid var(--primary);
            font-weight: 400; font-size: 16px; transition: all 0.2s; text-decoration: none; text-align: center; display: inline-block;
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

        /* KONTEN EVENT KHUSUS */
        .event-title { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 32px; color: var(--ink); line-height: 1.2; letter-spacing: -0.5px; }
        .card-stripi { background: var(--canvas); border-radius: var(--rounded-xl); border: 1px solid var(--hairline); box-shadow: var(--shadow-level-1); padding: 32px; }

        /* ===== CSS UNTUK FOOTER BARU ===== */
        .site-footer { background: var(--brand-dark-900); color: rgba(255,255,255,0.7); padding-top: 64px; padding-bottom: 24px; margin-top: auto; }
        .footer-brand-title { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 24px; letter-spacing: -0.5px; color: white; margin-bottom: 16px; }
        .footer-heading { font-weight: 600; font-size: 16px; color: white; margin-bottom: 20px; }
        .footer-links { list-style: none; padding: 0; margin: 0; }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a { color: rgba(255,255,255,0.7); text-decoration: none; transition: color 0.3s; font-size: 14px; }
        .footer-links a:hover { color: var(--primary-subdued); }
        .social-icons a { display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.1); color: white; font-size: 18px; margin-right: 8px; transition: all 0.3s; text-decoration: none; }
        .social-icons a:hover { background: var(--primary); transform: translateY(-3px); }
        .newsletter-form { display: flex; margin-top: 16px; width: 100%; }
        .newsletter-form input { flex: 1; padding: 12px 16px; border-radius: 50px 0 0 50px; border: none; outline: none; font-size: 14px; }
        .newsletter-form button { padding: 12px 24px; border-radius: 0 50px 50px 0; background: linear-gradient(90deg, var(--ruby), #ff6b6b); color: white; border: none; font-weight: 600; font-size: 14px; transition: opacity 0.3s; }
        .newsletter-form button:hover { opacity: 0.9; }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,0.1); padding-top: 24px; margin-top: 48px; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 10px; font-size: 14px; }
    </style>
</head>
<body>

    <div class="gradient-mesh" style="padding-bottom: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <div class="container pt-3">
            <div class="nav-stripi d-flex align-items-center justify-content-between flex-wrap gap-3">
                <a href="{{ url('/') }}" class="nav-brand-stripi d-flex align-items-center gap-2">
                    <span>🎫 TICKS ID</span>
                </a>

                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <div class="nav-links-stripi d-flex gap-2">
                        <a href="{{ url('/') }}" class="active">Beranda</a>
                        <a href="{{ url('/#packages') }}">Paket Sponsor</a>
                        <a href="{{ url('/#event-list') }}">Daftar Event</a>
                    </div>

                    @auth
                        <div class="dropdown">
                            <button class="btn-primary-pill button-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" style="padding:6px 20px; width: auto;">
                                👤 Halo, {{ explode(' ', Auth::user()->name)[0] }}
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2" style="border-radius: 12px; font-size: 14px; min-width: 200px;">
                                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'eo')
                                    <li><a class="dropdown-item py-2 fw-medium" href="{{ url('/admin/dashboard') }}">🎛️ Dashboard Event</a></li>
                                @endif

                                @if(Auth::user()->role === 'panitia' || Auth::user()->role === 'admin' || Auth::user()->role === 'eo')
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
                    @else
                        <a href="{{ route('login') }}" class="btn-secondary button-sm" style="padding:6px 18px; background: rgba(255,255,255,0.5);">Masuk</a>
                        <a href="{{ route('register') }}" class="btn-primary-pill button-sm" style="padding:6px 20px; width: auto;">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <main class="flex-grow-1 py-5">
        <div class="container" style="max-width: 1100px;">

            {{-- PESAN ERROR/SUKSES --}}
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

            <div class="mb-4">
                <a href="{{ url('/') }}" class="btn btn-sm bg-white border shadow-sm rounded-pill fw-medium text-secondary px-4 py-2" style="font-size: 13px;">
                    &larr; Kembali ke Daftar Event
                </a>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: var(--rounded-xl); overflow: hidden; height: 380px; border: 1px solid var(--hairline);">
                        <img src="{{ $transaction->event->image ? asset('storage/' . $transaction->event->image) : 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&w=1200&q=80' }}" class="w-100 h-100 object-fit-cover" alt="{{ $transaction->event->name }}" style="object-fit: cover;">
                    </div>

                    <div class="card-stripi mb-4">
                        <span class="badge mb-3 text-uppercase fw-bold px-3 py-2" style="background-color: rgba(105,111,199,0.1); color: var(--primary); border-radius: 8px; font-size: 11px; letter-spacing: 0.5px;">
                            🎫 {{ $transaction->event->category }}
                        </span>

                        <h1 class="event-title mb-4">
                            {{ $transaction->event->name }}
                        </h1>

                        <div class="row g-3 p-3" style="background-color: var(--canvas-soft); border-radius: 12px; border: 1px solid var(--hairline);">
                            <div class="col-md-6 d-flex align-items-center gap-3 border-end-md">
                                <div style="width: 48px; height: 48px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">📅</div>
                                <div>
                                    <small class="text-muted d-block fw-medium mb-1">Tanggal & Waktu</small>
                                    <span class="fw-bold" style="color: var(--ink); font-size: 14px;">
                                        {{ date('d M Y - H:i', strtotime($transaction->event->event_date)) }} WIB
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-center gap-3">
                                <div style="width: 48px; height: 48px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">📍</div>
                                <div>
                                    <small class="text-muted d-block fw-medium mb-1">Lokasi Acara</small>
                                    <span class="fw-bold" style="color: var(--ink); font-size: 14px;">
                                        {{ $transaction->event->location }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="position-sticky" style="top: 24px;">
                        <div class="card border-0 shadow-sm" style="border-radius: var(--rounded-xl); overflow: hidden; background: var(--canvas); border: 1px solid var(--hairline);">

                            <div class="p-3 text-center fw-bold text-white" style="background: linear-gradient(135deg, var(--brand-dark-900), var(--primary-deep)); font-size: 14px; letter-spacing: 0.5px;">
                                🛒 INVOICE PEMBAYARAN
                            </div>

                            <div class="card-body p-4">

                                <div class="d-flex justify-content-between align-items-center mb-4 p-3 rounded-3" style="background-color: var(--canvas-soft); border: 1px solid var(--hairline);">
                                    <span class="small fw-bold text-secondary">Status:</span>
                                    @if($transaction->payment_status == 'pending')
                                        <span class="badge" style="background-color: #f59e0b; color: #fff; padding: 6px 12px; border-radius: 8px; font-size: 12px; letter-spacing: 0.5px;">MENUNGGU BAYAR</span>
                                    @elseif($transaction->payment_status == 'paid')
                                        <span class="badge" style="background-color: #10b981; color: #fff; padding: 6px 12px; border-radius: 8px; font-size: 12px; letter-spacing: 0.5px;">LUNAS</span>
                                    @else
                                        <span class="badge" style="background-color: #ef4444; color: #fff; padding: 6px 12px; border-radius: 8px; font-size: 12px; letter-spacing: 0.5px;">GAGAL</span>
                                    @endif
                                </div>

                                <div class="p-3 mb-4 d-flex justify-content-between align-items-center" style="background-color: rgba(105,111,199,0.05); border-radius: 12px; border: 1px dashed var(--primary);">
                                    <span class="small fw-bold text-secondary">Total Tagihan:</span>
                                    <span class="fw-bold fs-5" style="color: var(--ink);">
                                        Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                                    </span>
                                </div>

                                {{-- TOMBOL PEMBAYARAN / DOWNLOAD --}}
                                @if($transaction->payment_status == 'pending' && !empty($snapToken))

                                    <button id="pay-button" class="btn w-100 fw-bold py-3 shadow-sm" style="background-color: var(--primary); color: white; border-radius: 50px; font-size: 15px; transition: 0.2s;" onmouseover="this.style.backgroundColor='var(--primary-press)'; this.style.transform='translateY(-2px)';" onmouseout="this.style.backgroundColor='var(--primary)'; this.style.transform='translateY(0)';">
                                        💳 Bayar Sekarang
                                    </button>
                                    <p class="text-center text-muted mt-3 mb-0" style="font-size: 11px;">Transaksi aman didukung oleh Midtrans</p>

                                @elseif($transaction->payment_status == 'paid')

                                    <div class="alert alert-success text-center border-0 fw-bold m-0 mb-3" style="background-color: #ecfdf5; color: #065f46; border-radius: 12px;">
                                        ✅ Pembayaran Selesai!
                                    </div>
                                    <a href="{{ route('ticket.download', $transaction->id) }}" class="btn w-100 fw-bold py-3 shadow-sm" style="background-color: #10b981; color: white; border-radius: 50px; font-size: 15px; transition: 0.2s;" onmouseover="this.style.backgroundColor='#059669'; this.style.transform='translateY(-2px)';" onmouseout="this.style.backgroundColor='#10b981'; this.style.transform='translateY(0)';">
                                        ⬇️ Download Tiket (PDF)
                                    </a>

                                @else

                                    <div class="alert alert-secondary text-center border-0 fw-bold m-0" style="background-color: #f3f4f6; color: #6b7280; border-radius: 12px;">
                                        🔒 Transaksi Tutup
                                    </div>

                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

   @if($transaction->payment_status == 'pending' && !empty($snapToken))
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
        <script type="text/javascript">
            var payButton = document.getElementById('pay-button');
            payButton.addEventListener('click', function () {
                window.snap.pay('{{ $snapToken }}', {
                    // UBAH BAGIAN INI: Arahkan langsung ke fungsi finish setelah sukses
                    onSuccess: function(result){
                        window.location.href = "{{ url('/midtrans/finish') }}?order_id={{ $transaction->order_id }}";
                    },
                    onPending: function(result){
                        window.location.href = "{{ url('/midtrans/finish') }}?order_id={{ $transaction->order_id }}";
                    },
                    onError: function(result){
                        alert("Pembayaran gagal.");
                    },
                    onClose: function(){
                        alert('Kamu menutup jendela pembayaran sebelum menyelesaikannya.');
                    }
                });
            });
        </script>
    @endif
</body>
</html>
