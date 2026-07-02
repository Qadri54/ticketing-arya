<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>{{ $event->name }} | TICKS ID</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Syne:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
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

            --rounded-xl: 16px;
            --rounded-pill: 9999px;

            --shadow-level-1: 0 1px 3px rgba(0, 55, 112, 0.08);

            --font-sans: 'Inter', 'SF Pro Display', system-ui, -apple-system, sans-serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: var(--font-sans); background: var(--canvas-soft); color: var(--ink);
            font-weight: 300; line-height: 1.4; font-feature-settings: "ss01"; -webkit-font-smoothing: antialiased;
            display: flex; flex-direction: column; min-height: 100vh;
        }

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

        /* CUSTOM RADIO TICKET SELECTION */
        .ticket-type-label { transition: all 0.2s; border: 2px solid var(--hairline) !important; }
        .ticket-type-label:hover { border-color: #a8c3de !important; }
        .ticket-type-label:has(input:checked) {
            border-color: var(--primary) !important;
            background-color: rgba(105,111,199,0.05);
        }

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
        <div class="container">

            {{-- BAGIAN PESAN ERROR/SUKSES --}}
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

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4 border-0 shadow-sm" style="background-color: #fef2f2; color: #991b1b; border-radius: 12px;" role="alert">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ url('/') }}" class="btn btn-sm bg-white border shadow-sm rounded-pill fw-medium text-secondary px-4 py-2" style="font-size: 13px;">
                    &larr; Kembali ke Daftar Event
                </a>
            </div>

            <div class="row g-4">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: var(--rounded-xl); overflow: hidden; height: 400px; border: 1px solid var(--hairline);">
                        <img src="{{ $event->image ? asset('storage/' . $event->image) : 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&w=1200&q=80' }}" class="w-100 h-100 object-fit-cover" alt="{{ $event->name }}" style="object-fit: cover;">
                    </div>

                    <div class="card-stripi mb-4">
                        <span class="badge mb-3 text-uppercase fw-bold px-3 py-2" style="background-color: rgba(105,111,199,0.1); color: var(--primary); border-radius: 8px; font-size: 11px;">
                            🎫 {{ $event->category }}
                        </span>

                        <h1 class="event-title mb-4">{{ $event->name }}</h1>

                        <div class="row g-3 p-3 mb-4" style="background-color: var(--canvas-soft); border-radius: 12px; border: 1px solid var(--hairline);">
                            <div class="col-md-6 d-flex align-items-center gap-3 border-end-md">
                                <div style="width: 48px; height: 48px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">📅</div>
                                <div>
                                    <small class="text-muted d-block fw-medium mb-1">Tanggal & Waktu</small>
                                    <span class="fw-bold" style="color: var(--ink); font-size: 14px;">
                                        {{ date('d M Y - H:i', strtotime($event->event_date)) }} WIB
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-center gap-3">
                                <div style="width: 48px; height: 48px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">📍</div>
                                <div>
                                    <small class="text-muted d-block fw-medium mb-1">Lokasi Acara</small>
                                    <span class="fw-bold" style="color: var(--ink); font-size: 14px;">
                                        {{ $event->location }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <h5 class="fw-bold mb-3" style="color: var(--ink); font-family: 'Syne', sans-serif;">Tentang Event</h5>
                        <div class="text-secondary lh-lg mb-0" style="white-space: pre-line; font-size: 15px;">
                            {{ $event->description }}
                        </div>
                    </div>

                    <div class="card-stripi">
                        <h5 class="fw-bold mb-3" style="color: var(--ink); font-family: 'Syne', sans-serif;">📜 Syarat & Ketentuan</h5>
                        <ul class="text-secondary d-flex flex-column gap-2 ps-3 m-0" style="font-size: 14px;">
                            <li>Tiket yang sudah dibeli bersifat <strong>Non-Refundable</strong> (tidak dapat diuangkan kembali).</li>
                            <li>Pengunjung *offline* wajib menunjukkan e-tiket (QR Code) resmi dari TICKS ID saat registrasi di lokasi.</li>
                            <li>Pembeli tiket *online (livestream)* dilarang menyebarkan ulang link siaran ke pihak lain.</li>
                            <li>Satu tiket hanya berlaku untuk satu orang/satu akun.</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="position-sticky" style="top: 20px;">
                        
                        {{-- 🔴 PENGECEKAN TANGGAL: Cek apakah event_date sudah lewat --}}
                        @php
                            $isPast = \Carbon\Carbon::parse($event->event_date)->isPast();
                        @endphp

                        {{-- Tambahkan efek sedikit pudar (opacity) jika event sudah lewat --}}
                        <div class="card border-0 shadow-sm" style="border-radius: var(--rounded-xl); overflow: hidden; background: var(--canvas); border: 1px solid var(--hairline); {{ $isPast ? 'opacity: 0.8;' : '' }}">

                            <div class="p-3 text-center fw-bold text-white" style="background: linear-gradient(135deg, var(--brand-dark-900), var(--primary-deep)); font-size: 14px; letter-spacing: 0.5px;">
                                PANEL PEMBELIAN
                            </div>

                            <div class="p-4">
                                <form action="/checkout/{{ $event->id }}" method="POST">
                                    @csrf

                                    <div class="mb-4">
                                        <label class="form-label small fw-bold text-secondary text-uppercase mb-3" style="letter-spacing: 0.5px;">Pilih Tipe Tiket</label>
                                        
                                        {{-- Matikan klik pada area tiket jika event selesai --}}
                                        <div class="d-flex flex-column gap-3" style="{{ $isPast ? 'pointer-events: none;' : '' }}">

                                            <label class="border rounded-3 p-3 d-flex align-items-center justify-content-between cursor-pointer ticket-type-label m-0" style="{{ $isPast ? 'background-color: var(--canvas-soft);' : '' }}">
                                                <div class="d-flex align-items-center gap-2">
                                                    {{-- Tambahkan atribut disabled --}}
                                                    <input type="radio" name="ticket_type" value="offline" class="form-check-input mt-0" checked onchange="updateTotal()" {{ $isPast ? 'disabled' : '' }}>
                                                    <span class="fw-bold" style="font-size: 14px; color: var(--ink);">🎫 Offline (Di Venue)</span>
                                                </div>
                                                <span class="fw-bold text-primary" style="font-size: 14px;" data-price="{{ $event->price }}">
                                                    {{ $event->price == 0 ? 'Gratis' : 'Rp ' . number_format($event->price, 0, ',', '.') }}
                                                </span>
                                            </label>

                                            @if($event->online_price > 0 && !empty($event->youtube_link))
                                                <label class="border rounded-3 p-3 d-flex align-items-center justify-content-between cursor-pointer ticket-type-label m-0" style="{{ $isPast ? 'background-color: var(--canvas-soft);' : '' }}">
                                                    <div class="d-flex align-items-center gap-2">
                                                        {{-- Tambahkan atribut disabled --}}
                                                        <input type="radio" name="ticket_type" value="online" class="form-check-input mt-0" onchange="updateTotal()" {{ $isPast ? 'disabled' : '' }}>
                                                        <span class="fw-bold" style="font-size: 14px; color: var(--ink);">🌐 Online (Livestream)</span>
                                                    </div>
                                                    <span class="fw-bold text-primary" style="font-size: 14px;" data-price="{{ $event->online_price }}">
                                                        {{ $event->online_price == 0 ? 'Gratis' : 'Rp ' . number_format($event->online_price, 0, ',', '.') }}
                                                    </span>
                                                </label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 d-flex justify-content-between align-items-center p-3" style="background-color: var(--canvas-soft); border-radius: 12px; border: 1px solid var(--hairline);">
                                        <span class="small fw-semibold text-secondary">Sisa Total Kuota:</span>
                                        <span class="badge" style="background-color: var(--ink); color: white; padding: 6px 12px; border-radius: 8px; font-size: 12px;">{{ $event->quota }} Tiket</span>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label small fw-bold text-secondary text-uppercase" style="letter-spacing: 0.5px;">Jumlah Pesanan</label>
                                        {{-- Tambahkan atribut disabled pada dropdown --}}
                                        <select class="form-select form-select-lg text-center fw-bold shadow-none" name="quantity" id="ticketQuantity" onchange="updateTotal()" style="border-radius: 12px; border-color: var(--hairline); color: var(--ink); font-size: 15px; {{ $isPast ? 'background-color: var(--canvas-soft); cursor: not-allowed;' : '' }}" {{ $isPast ? 'disabled' : '' }}>
                                            <option value="1">1 Tiket</option>
                                            <option value="2">2 Tiket</option>
                                            <option value="3">3 Tiket</option>
                                            <option value="4">4 Tiket</option>
                                            <option value="5">5 Tiket (Maks)</option>
                                        </select>
                                    </div>

                                    <div class="p-3 mb-4 d-flex justify-content-between align-items-center" style="background-color: rgba(105,111,199,0.05); border-radius: 12px; border: 1px dashed var(--primary);">
                                        <span class="small fw-bold text-secondary">Total Bayar:</span>
                                        <span class="fw-bold fs-5" id="totalPriceDisplay" style="color: var(--ink);"></span>
                                    </div>

                                    {{-- 🔴 LOGIKA TOMBOL AKSI UTAMA --}}
                                    @if($isPast)
                                        <button type="button" class="btn w-100 fw-bold py-3" style="background-color: var(--hairline); color: var(--ink-mute); border-radius: var(--rounded-pill);" disabled>
                                            Event Telah Selesai
                                        </button>
                                    @elseif($event->quota > 0)
                                        <button type="submit" class="btn-primary-pill">
                                            Lanjutkan Pembayaran
                                        </button>
                                        <p class="text-center text-muted mt-3 mb-0" style="font-size: 11px;">Transaksi aman didukung oleh sistem kami</p>
                                    @else
                                        <button type="button" class="btn w-100 fw-bold py-3" style="background-color: var(--hairline); color: var(--ink-mute); border-radius: var(--rounded-pill);" disabled>
                                            Maaf, Tiket Habis
                                        </button>
                                    @endif

                                </form>
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
                    <div class="footer-brand-title">🎟️ TICKS ID</div>
                    <p style="font-size: 14px; line-height: 1.6; margin-bottom: 24px;">Integrated Event Ecosystem Platform. Solusi terbaik untuk manajemen tiket event, check-in QR Code, hingga pencarian sponsor dalam satu sistem modern.</p>
                </div>
                <div class="col-lg-2 col-md-3 col-6">
                    <div class="footer-heading">Jelajahi</div>
                    <ul class="footer-links">
                        <li><a href="#">Semua Event</a></li>
                        <li><a href="#">Live Concert</a></li>
                        <li><a href="#">Sponsorship Marketplace</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-3 col-6">
                    <div class="footer-heading">Perusahaan</div>
                    <ul class="footer-links">
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Hubungi Kami</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer-heading">Stay In The Loop</div>
                    <p style="font-size: 14px; line-height: 1.6; margin-bottom: 0;">Dapatkan informasi event terbaru, promo tiket, dan tips mengelola event dari kami.</p>
                </div>
            </div>
            <div class="footer-bottom">
                <div>&copy; {{ date('Y') }} <strong>TICKS ID</strong>. Seluruh Hak Cipta Dilindungi.</div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function updateTotal() {
            // Ambil jumlah tiket
            const qty = parseInt(document.getElementById('ticketQuantity').value);

            // Ambil radio button tipe tiket yang sedang dipilih
            const selectedRadio = document.querySelector('input[name="ticket_type"]:checked');

            // Ambil harga dari atribut 'data-price' pada elemen span di sebelahnya
            const priceSpan = selectedRadio.closest('.ticket-type-label').querySelector('[data-price]');
            const price = parseInt(priceSpan.getAttribute('data-price'));

            // Tampilkan ke layar
            const displayEl = document.getElementById('totalPriceDisplay');
            if (price === 0) {
                displayEl.innerText = 'Gratis';
            } else {
                const total = qty * price;
                // Format angka menjadi format Rupiah
                const formatted = 'Rp ' + total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                displayEl.innerText = formatted;
            }
        }

        // Panggil fungsi ini pertama kali saat halaman dimuat
        document.addEventListener('DOMContentLoaded', updateTotal);
    </script>
</body>
</html>