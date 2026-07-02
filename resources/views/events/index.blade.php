<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>TICKS ID | Integrated Event Ecosystem</title>
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
            font-family: var(--font-sans); background: var(--canvas); color: var(--ink);
            font-weight: 300; line-height: 1.4; font-feature-settings: "ss01"; -webkit-font-smoothing: antialiased;
        }

        .display-xxl { font-size: 56px; font-weight: 300; line-height: 1.03; letter-spacing: -1.4px; }
        .display-lg { font-size: 32px; font-weight: 300; line-height: 1.1; letter-spacing: -0.64px; }
        .display-md { font-size: 26px; font-weight: 300; line-height: 1.12; letter-spacing: -0.26px; }
        .heading-lg { font-size: 22px; font-weight: 300; line-height: 1.1; letter-spacing: -0.22px; }
        .heading-md { font-size: 20px; font-weight: 300; line-height: 1.4; letter-spacing: -0.2px; }
        .heading-sm { font-size: 18px; font-weight: 300; line-height: 1.4; }
        .body-lg { font-size: 16px; font-weight: 300; line-height: 1.4; }
        .body-md { font-size: 15px; font-weight: 300; line-height: 1.4; }
        .price-tabular { font-feature-settings: "tnum"; letter-spacing: -0.42px; font-weight: 500; font-size: 18px; color: var(--ink); }
        .button-sm { font-size: 14px; font-weight: 400; line-height: 1; }
        .caption { font-size: 13px; font-weight: 400; line-height: 1.4; letter-spacing: -0.39px; color: var(--ink-mute); }
        .micro-cap { font-size: 10px; font-weight: 500; line-height: 1.15; letter-spacing: 0.2px; text-transform: uppercase; }

        .btn-primary-pill {
            background: var(--primary); color: var(--on-primary); padding: 8px 16px; border-radius: var(--rounded-pill);
            font-weight: 400; font-size: 16px; border: none; transition: all 0.2s; display: inline-flex; align-items: center; justify-content: center; gap: 6px; text-decoration: none;
        }
        .btn-primary-pill:hover { background: var(--primary-press); transform: translateY(-1px); color: white; }
        .btn-secondary {
            background: var(--canvas); color: var(--primary); padding: 8px 16px; border-radius: var(--rounded-pill); border: 1px solid var(--primary);
            font-weight: 400; font-size: 16px; transition: all 0.2s; text-decoration: none; text-align: center; display: inline-block;
        }
        .btn-secondary:hover { background: rgba(105,111,199,0.05); border-color: var(--primary-deep); }

        .gradient-mesh {
            position: relative;
            background: radial-gradient(ellipse at 20% 30%, rgba(253, 244, 227, 0.8) 0%, rgba(255, 209, 165, 0.6) 25%, rgba(197, 163, 255, 0.5) 55%, rgba(105, 111, 199, 0.55) 75%, rgba(234, 34, 97, 0.35) 100%);
            overflow: hidden;
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

        .event-card-stripi {
            background: var(--canvas); border-radius: var(--rounded-lg); border: 1px solid var(--hairline); overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s; height: 100%; box-shadow: var(--shadow-level-1); color: var(--ink);
            display: flex; flex-direction: column; position: relative;
        }
        .event-card-stripi:hover { transform: translateY(-4px); box-shadow: var(--shadow-level-2); }

        .card-pricing-stripi {
            background: var(--canvas); padding: var(--spacing-xxl); border-radius: var(--rounded-lg); border: 1px solid var(--hairline);
            transition: transform 0.2s; height: 100%; display: flex; flex-direction: column;
        }
        .card-pricing-featured { background: var(--brand-dark-900); color: var(--on-primary); border: none; box-shadow: var(--shadow-level-2); }
        .card-pricing-featured .price, .card-pricing-featured .plan-name { color: white; }
        .card-pricing-featured .caption { color: #cdd9ff; }

        .cream-band-stripi { background: var(--canvas-cream); border-radius: var(--rounded-lg); padding: var(--spacing-xxl); }
        .sponsor-grid-stripi { display: flex; flex-wrap: wrap; justify-content: center; gap: var(--spacing-xxl); padding: var(--spacing-xl) 0; }
        .sponsor-logo { filter: grayscale(1) opacity(0.6); transition: all 0.2s; font-weight: 500; font-size: 18px; color: var(--ink-mute); letter-spacing: -0.2px; }
        .sponsor-logo:hover { filter: grayscale(0) opacity(1); color: var(--primary); }

        /* ===== FOOTER ===== */
        .site-footer { background: var(--brand-dark-900); color: rgba(255,255,255,0.7); padding-top: 64px; padding-bottom: 24px; margin-top: 64px; }
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

        @media (max-width: 768px) { .display-xxl { font-size: 36px; letter-spacing: -0.8px; } .footer-bottom { flex-direction: column; text-align: center; } }
    </style>
</head>
<body>

    <div class="gradient-mesh" style="padding-bottom: 40px;">
        <div class="container pt-3">
            <div class="nav-stripi d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                <a href="{{ url('/') }}" class="nav-brand-stripi d-flex align-items-center gap-2">
                    <span>🎫 TICKS ID</span>
                </a>

                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <div class="nav-links-stripi d-flex gap-2">
                        <a href="#" class="active">Beranda</a>
                        <a href="#packages">Paket Sponsor</a>
                        <a href="#event-list">Daftar Event</a>
                    </div>

                    @auth
                        <div class="dropdown">
                            <button class="btn-primary-pill button-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" style="padding:6px 20px;">
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
                                        <button type="submit" class="dropdown-item py-2 fw-bold text-danger">Log Out</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn-secondary button-sm" style="padding:6px 18px; background: rgba(255,255,255,0.5);">Masuk</a>
                        <a href="{{ route('register') }}" class="btn-primary-pill button-sm" style="padding:6px 20px;">Daftar</a>
                    @endauth
                </div>
            </div>

            <div class="py-4" style="max-width: 700px;">
                <span class="micro-cap" style="background: rgba(255,255,240,0.7); padding: 4px 14px; border-radius: var(--rounded-pill); color: var(--primary-deep);">🔥 Platform Event & Sponsorship Terintegrasi</span>
                <h1 class="display-xxl mt-3" style="color: var(--ink);">Temukan & <span style="color: var(--primary-press);">Buat</span><br>Event Terbesar Anda</h1>
                <p class="body-lg mt-3" style="color: var(--brand-dark-900);">Dari konser hingga workshop, kelola tiket dan sponsorship dengan satu dashboard elegan.</p>
                <div class="d-flex gap-3 mt-4 flex-wrap">
                    <div class="d-flex gap-3 mt-4 flex-wrap">
                        <a href="#event-list" class="btn-primary-pill">Lihat Event →</a>
                        <a href="#packages" class="btn-secondary" style="background: rgba(255,255,255,0.5);">Jadi Sponsor</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="flex-grow-1">
        <div class="container" style="margin-top: -20px; position: relative; z-index: 2;">

            <form action="{{ url('/') }}" method="GET" class="card-feature-light p-4 mb-5" style="background: var(--canvas); border-radius: var(--rounded-lg); box-shadow: var(--shadow-level-1); border: 1px solid var(--hairline);">
                <div class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <div class="micro-cap mb-1 text-muted">Cari event atau kategori</div>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" style="border-color: var(--hairline-input); border-radius: var(--rounded-sm); font-family: var(--font-sans);" placeholder="Konser, workshop, olahraga...">
                    </div>
                    <div class="col-md-4">
                        <div class="micro-cap mb-1 text-muted">Lokasi</div>
                        <select name="location" class="form-select" style="border-color: var(--hairline-input); border-radius: var(--rounded-sm);">
                            <option value="">Semua Lokasi</option>
                            <option value="Medan" {{ request('location') == 'Medan' ? 'selected' : '' }}>Medan</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn-primary-pill w-100 h-100 py-2">Cari Event</button>
                    </div>
                </div>
            </form>

            <div id="event-list" class="mb-5">
                <div class="d-flex justify-content-between align-items-end flex-wrap mb-4">
                    <div>
                        <div class="heading-md" style="font-weight: 500;">⚡ Event Mendatang</div>
                        <div class="caption text-muted">
                            {{ request('search') ? 'Hasil pencarian: "'.request('search').'"' : 'Rekomendasi event terbaik di ekosistem kami' }}
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    @forelse($events as $event)
                    <div class="col-md-4">
                        <a href="{{ url('/event/' . $event->id) }}" class="text-decoration-none">
                            <div class="event-card-stripi">
                                <img src="{{ $event->image ? asset('storage/' . $event->image) : 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?w=600&q=80' }}"
                                     class="w-100" style="height: 180px; object-fit: cover;" alt="{{ $event->name }}">

                                <div class="p-3 d-flex flex-column flex-grow-1">

                                    
                                    <div class="d-flex justify-content-between align-items-start">
                                        <span class="micro-cap" style="color: var(--primary);">🎟️ {{ strtoupper($event->category) }}</span>

                                        @if($event->youtube_link)
                                            <span class="badge bg-danger border-0 d-flex align-items-center gap-1" style="font-size: 10px; padding: 4px 8px;">
                                                <i class="bi bi-broadcast"></i> HYBRID / LIVE
                                            </span>
                                        @endif
                                    </div>
                            

                                    <h3 class="heading-sm mt-1" style="color: var(--ink);">{{ $event->name }}</h3>

                                    <p class="caption mt-2 mb-3 flex-grow-1" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ strip_tags($event->description) }}
                                    </p>

                                    <div class="d-flex justify-content-between mb-3 border-top pt-2" style="border-color: var(--hairline) !important;">
                                        <span class="caption">📍 {{ $event->location }}</span>
                                        <span class="caption">📅 {{ date('d M Y', strtotime($event->event_date)) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        <div><span class="price-tabular">{{ $event->price == 0 ? 'Gratis' : 'Rp ' . number_format($event->price, 0, ',', '.') }}</span></div>
                                        <button class="btn-primary-pill button-sm" style="padding: 5px 14px;">Beli Tiket</button>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5 bg-white rounded-3 border">
                        <span style="font-size: 40px;">📭</span>
                        <h4 class="mt-3 heading-sm">Tidak ada event ditemukan</h4>
                        <p class="text-muted">Coba gunakan kata kunci pencarian yang lain.</p>
                        <a href="{{ url('/') }}" class="btn-secondary mt-2">Reset Pencarian</a>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Bagian Sponsor -->
            <div id="packages" class="cream-band-stripi mb-5" style="padding: 24px 20px;">
                <div class="text-center mb-5">
                    <div class="micro-cap" style="color: var(--primary); letter-spacing: 1px;">Sponsorship Marketplace</div>
                    <h2 class="display-lg">Pilih Paket Sponsor</h2>
                    <p class="body-md text-muted">Dukung event terbaik dan tingkatkan eksposur brand Anda</p>
                </div>

                <div class="row g-4 justify-content-center">
                    @forelse($sponsorships as $sponsor)
                    <div class="col-md-4">
                        <div class="card-pricing-stripi {{ $loop->iteration == 2 ? 'card-pricing-featured' : '' }}">

                            @if($sponsor->image)
                                <div class="mb-4 text-center">
                                    <img src="{{ asset('storage/' . $sponsor->image) }}" alt="{{ $sponsor->name }}" style="width: 100%; max-height: 180px; height: auto; object-fit: contain; border-radius: 8px;">
                                </div>
                            @endif

                            <div class="micro-cap" style="color: {{ $loop->iteration == 2 ? 'var(--primary-soft)' : 'var(--primary)' }};">
                                UNTUK EVENT: {{ strtoupper($sponsor->event->name ?? 'EVENT TERHAPUS') }}
                            </div>
                            <div class="heading-lg plan-name mt-2">{{ $sponsor->name }}</div>
                            <div class="display-md price">Rp {{ number_format($sponsor->price, 0, ',', '.') }}</div>
                            <div class="caption mb-3">Sisa Kuota: {{ $sponsor->quota }} Paket</div>

                            <ul class="list-unstyled mb-4 flex-grow-1 border-top pt-3" style="border-color: rgba(105, 111, 199, 0.2) !important;">
                                @foreach(explode(',', $sponsor->benefits) as $benefit)
                                    <li class="body-md mb-2 d-flex gap-2">
                                        <span style="color: {{ $loop->iteration == 2 ? '#C95792' : '#696FC7' }};">✓</span>
                                        <span>{{ trim($benefit) }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <a href="https://wa.me/6282160762279?text=Halo%20Admin%20TICKS%20ID,%20saya%20tertarik%20untuk%20menjadi%20Sponsor%20*{{ urlencode($sponsor->name) }}*%20pada%20event%20*{{ urlencode($sponsor->event->name ?? 'Event Anda') }}*.%20Bagaimana%20prosedur%20selanjutnya?"
                               target="_blank"
                               class="{{ $loop->iteration == 2 ? 'btn-primary-pill' : 'btn-secondary' }} w-100"
                               style="{{ $loop->iteration == 2 ? 'background: var(--primary-soft); justify-content: center;' : '' }}">
                                Ajukan Sponsor
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-4">
                        <p class="text-muted">Saat ini belum ada paket sponsor yang ditawarkan oleh penyelenggara event.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="cream-band-stripi d-flex flex-wrap align-items-center justify-content-between gap-4 mb-5" style="background: rgba(105, 111, 199, 0.05); border: 1px solid var(--primary);">
                <div>
                    <div class="heading-md" style="color: var(--brand-dark-900); font-weight: 500;">Ingin buat event dan cari sponsor?</div>
                    <p class="body-md text-muted m-0">Dapatkan dashboard lengkap dan sistem tiket modern untuk event Anda.</p>
                </div>
                <a href="https://wa.me/6282160762279?text=Halo%20Admin%20TICKS%20ID,%20saya%20ingin%20membuat%20event%20baru%20di%20platform%20Anda%20dan%20sedang%20mencari%20sponsor.%20Bisa%20dibantu%20untuk%20proses%20pembuatan%20dan%20prosedurnya?"
                   target="_blank"
                   class="btn-primary-pill"
                   style="background: var(--primary-deep);">
                    Buat Event Sekarang
                </a>
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
                        <a href="https://www.instagram.com/eventorganizermedan?igsh=MXAwZHVqYTd5MGRwZQ==" target="_blank" rel="noopener noreferrer" title="Kunjungi Instagram Kami">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://wa.me/6282160762279" target="_blank" rel="noopener noreferrer" title="Hubungi kami via WhatsApp">
                            <i class="bi bi-whatsapp"></i>
                        </a>
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
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const target = document.querySelector(this.getAttribute('href'));
                if(target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
            });
        });
    </script>
</body>
</html>
