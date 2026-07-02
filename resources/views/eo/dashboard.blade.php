<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - TICKS ID</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        primary: '#696FC7',           /* Indigo Muted */
                        'primary-deep': '#3D365C',    /* Navy Ungu Gelap */
                        'primary-press': '#7C4585',   /* Plum */
                        'primary-soft': '#C95792',    /* Pink/Magenta */
                        'primary-subdued': '#F8B55F', /* Orange/Peach */
                        'brand-dark': '#1c1e54',
                        ink: '#0d253d',
                        'ink-secondary': '#273951',
                        'ink-mute': '#64748d',
                        canvas: '#ffffff',
                        'canvas-soft': '#f6f9fc',
                        'canvas-cream': '#f5e9d4',
                        hairline: '#e3e8ee',
                    },
                    boxShadow: {
                        'level-1': '0 1px 3px rgba(0,55,112,0.08)',
                        'level-2': '0 8px 24px rgba(0,55,112,0.08), 0 2px 6px rgba(0,55,112,0.04)',
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-feature-settings: "ss01" 1;
            -webkit-font-smoothing: antialiased;
        }
        .tabular-numeric {
            font-feature-settings: "tnum" 1;
            letter-spacing: -0.42px;
        }
        .display-tracking {
            letter-spacing: -0.64px;
        }
    </style>
</head>
<body class="bg-canvas-soft text-ink flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-brand-dark flex flex-col justify-between hidden lg:flex relative z-20 shadow-level-2">
        <div>
            <!-- Brand Logo -->
            <div class="h-24 flex items-center px-8 border-b border-white/5">
                <span class="text-white font-light text-[24px] tracking-[-0.22px]">
                    TICKS <span class="font-medium text-primary-subdued">ID</span>
                </span>
            </div>

            <!-- Navigation -->
            <nav class="p-5 space-y-2 mt-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-white/10 text-white rounded-xl text-[14px] font-medium shadow-sm transition-all hover:bg-white/15">
                    <span class="text-lg">📊</span> Ikhtisar Platform
                </a>
                <a href="{{ route('admin.events.index') }}" class="flex items-center gap-3 px-4 py-3 text-white/60 hover:text-white hover:bg-white/5 rounded-xl text-[14px] font-medium transition-all">
                    <span class="text-lg">🎟️</span> Manajemen Event
                </a>
                <a href="{{ route('admin.transactions.index') }}" class="flex items-center gap-3 px-4 py-3 text-white/60 hover:text-white hover:bg-white/5 rounded-xl text-[14px] font-medium transition-all">
                    <span class="text-lg">💳</span> Data Transaksi
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 text-white/60 hover:text-white hover:bg-white/5 rounded-xl text-[14px] font-medium transition-all">
                    <span class="text-lg">👥</span> Kelola Pengguna
                </a>
                <a href="{{ route('admin.sponsorships.index') }}" class="flex items-center gap-3 px-4 py-3 text-white/60 hover:text-white hover:bg-white/5 rounded-xl text-[14px] font-medium transition-all">
                    <span class="text-lg">🤝</span> Kelola Sponsorship
                </a>
            </nav>
        </div>

        <div class="p-5 border-t border-white/5">
            <div class="flex items-center gap-3 p-3 bg-white/5 rounded-xl border border-white/10">
                <!-- Inisial Nama -->
                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white text-sm font-semibold uppercase shadow-inner">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-[14px] text-white font-medium truncate">{{ Auth::user()->name ?? 'Administrator' }}</p>
                    <p class="text-[11px] text-primary-subdued truncate">Platform Admin</p>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="w-full text-left text-[13px] text-primary-soft hover:text-white px-3 py-2 rounded-lg transition-colors flex items-center gap-2">
                    🚪 Keluar dari Sistem
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col h-full overflow-y-auto relative z-10">

        <!-- MESH GRADIENT BACKDROP (Warna Baru!) -->
        <div class="absolute top-0 left-0 w-full h-[380px] bg-gradient-to-tr from-canvas-cream via-primary-soft/20 to-primary-subdued/30 blur-[90px] opacity-80 z-0 pointer-events-none"></div>

        <!-- Header -->
        <header class="h-24 px-10 flex items-center justify-between relative z-10 shrink-0">
            <div>
                <h1 class="text-[28px] font-light tracking-[-0.26px] text-ink">Ikhtisar Platform</h1>
                <p class="text-[14px] text-ink-mute mt-1 font-light">Ringkasan performa sistem secara keseluruhan.</p>
            </div>

            <div class="flex items-center gap-5">
                <span class="text-[13px] text-ink-mute">Periode: <strong class="text-primary-deep font-medium bg-white px-3 py-1.5 rounded-full border border-hairline shadow-sm">Tahun 2026</strong></span>
                <a href="{{ route('admin.events.create') }}" class="bg-primary hover:bg-primary-press text-white px-6 py-2.5 rounded-full text-[14px] font-medium transition-all shadow-level-1 hover:shadow-level-2 hover:-translate-y-0.5">
                    + Tambah Event
                </a>
            </div>
        </header>

        <!-- Content Area -->
        <div class="px-10 pb-12 relative z-10 flex-1">

            <!-- 4 METRIC CARDS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mt-4">

                <div class="bg-canvas border border-hairline rounded-[16px] p-6 shadow-level-2 hover:-translate-y-1 transition-transform duration-300">
                    <div class="flex justify-between items-start mb-4">
                        <p class="text-[12px] text-ink-mute uppercase tracking-[0.5px] font-medium">Pendapatan</p>
                        <span class="bg-green-50 text-green-700 text-[10px] px-2 py-1 rounded-full font-medium">Laba Bersih</span>
                    </div>
                    <div class="flex items-baseline gap-1">
                        <span class="text-[16px] text-primary-deep font-medium">Rp</span>
                        <h2 class="text-[32px] font-light text-ink tabular-numeric display-tracking">
                            {{ number_format($totalPendapatan, 0, ',', '.') }}
                        </h2>
                    </div>
                </div>

                <div class="bg-canvas border border-hairline rounded-[16px] p-6 shadow-level-2 hover:-translate-y-1 transition-transform duration-300">
                    <div class="flex justify-between items-start mb-4">
                        <p class="text-[12px] text-ink-mute uppercase tracking-[0.5px] font-medium">Tiket Terjual</p>
                        <span class="bg-primary/10 text-primary-deep text-[10px] px-2 py-1 rounded-full font-medium">Paid</span>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <h2 class="text-[32px] font-light text-ink tabular-numeric display-tracking">
                            {{ number_format($tiketTerjual, 0, ',', '.') }}
                        </h2>
                        <span class="text-[14px] text-ink-mute font-light">Lembar</span>
                    </div>
                </div>

                <div class="bg-canvas border border-hairline rounded-[16px] p-6 shadow-level-2 hover:-translate-y-1 transition-transform duration-300">
                    <div class="flex justify-between items-start mb-4">
                        <p class="text-[12px] text-ink-mute uppercase tracking-[0.5px] font-medium">Event Aktif</p>
                        <span class="bg-primary-subdued/30 text-primary-deep text-[10px] px-2 py-1 rounded-full font-medium">Katalog</span>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <h2 class="text-[32px] font-light text-ink tabular-numeric display-tracking">
                            {{ $eventAktif }}
                        </h2>
                        <span class="text-[14px] text-ink-mute font-light">Acara</span>
                    </div>
                </div>

                <div class="bg-canvas border border-hairline rounded-[16px] p-6 shadow-level-2 hover:-translate-y-1 transition-transform duration-300">
                    <div class="flex justify-between items-start mb-4">
                        <p class="text-[12px] text-ink-mute uppercase tracking-[0.5px] font-medium">Total Pengguna</p>
                        <span class="bg-primary-soft/10 text-primary-press text-[10px] px-2 py-1 rounded-full font-medium">Terdaftar</span>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <h2 class="text-[32px] font-light text-ink tabular-numeric display-tracking">
                            {{ number_format($totalPengguna, 0, ',', '.') }}
                        </h2>
                        <span class="text-[14px] text-ink-mute font-light">Akun</span>
                    </div>
                </div>
            </div>

            <!-- CHARTS SECTION -->
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 mt-8">
                <!-- Line Chart -->
                <div class="xl:col-span-8 bg-canvas border border-hairline rounded-[16px] p-7 shadow-level-1">
                    <h3 class="text-[16px] font-medium text-ink mb-6">Statistik Keuangan Bulanan (Juta Rp)</h3>
                    <div class="h-64 relative">
                        <canvas id="stripeRevenueChart"></canvas>
                    </div>
                </div>

                <!-- Doughnut Chart -->
                <div class="xl:col-span-4 bg-canvas border border-hairline rounded-[16px] p-7 shadow-level-1 flex flex-col">
                    <h3 class="text-[16px] font-medium text-ink mb-2">Proporsi Kategori</h3>
                    <div class="h-64 relative flex-1">
                        <canvas id="stripeCategoryChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- TABLE SECTION -->
            <div class="mt-8 bg-canvas border border-hairline rounded-[16px] shadow-level-1 overflow-hidden">
                <div class="p-6 border-b border-hairline bg-canvas-soft/40 flex justify-between items-center">
                    <h3 class="text-[16px] font-medium text-ink">Volume Penjualan Kategori</h3>
                    <button class="text-[13px] text-primary hover:text-primary-press font-medium transition-colors">Lihat Detail &rarr;</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white border-b border-hairline text-[11px] font-medium text-ink-mute tracking-wider uppercase">
                                <th class="py-4 px-6">Nama Kategori Kebutuhan</th>
                                <th class="py-4 px-6 text-right">Volume Tiket Terjual</th>
                            </tr>
                        </thead>
                        <tbody class="text-[14px] font-light text-ink divide-y divide-hairline">
                            @forelse($categoryData as $categoryName => $totalTickets)
                            <tr class="hover:bg-canvas-soft/50 transition-colors group">
                                <td class="py-4 px-6 font-medium text-ink-secondary flex items-center gap-3">
                                    <div class="w-2 h-2 rounded-full bg-primary-subdued group-hover:scale-150 transition-transform"></div>
                                    {{ $categoryName }}
                                </td>
                                <td class="py-4 px-6 text-right tabular-numeric font-medium text-primary-deep">
                                    {{ number_format($totalTickets, 0, ',', '.') }} Tiket
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="py-10 text-center text-ink-mute">Belum ada sirkulasi data transaksi paid.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // --- 1. RENDER LINE CHART ---
            const ctxRevenue = document.getElementById('stripeRevenueChart').getContext('2d');

            // Gradasi di bawah garis menggunakan warna Primary baru (#696FC7)
            let chartGradient = ctxRevenue.createLinearGradient(0, 0, 0, 240);
            chartGradient.addColorStop(0, 'rgba(105, 111, 199, 0.25)');
            chartGradient.addColorStop(1, 'rgba(105, 111, 199, 0.0)');

            new Chart(ctxRevenue, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Pendapatan (Juta)',
                        data: @json($salesData),
                        borderColor: '#696FC7', /* Primary Baru */
                        backgroundColor: chartGradient,
                        borderWidth: 2.5,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#696FC7',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.35 /* Lengkungan elegan */
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { borderDash: [4, 4], color: '#e3e8ee', drawBorder: false },
                            ticks: { font: { family: 'Inter', size: 12 }, color: '#64748d' }
                        },
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { font: { family: 'Inter', size: 12 }, color: '#64748d' }
                        }
                    }
                }
            });

            // --- 2. RENDER DOUGHNUT CHART ---
            const categoryLabels = @json(array_keys($categoryData));
            const categoryValues = @json(array_values($categoryData));
            const ctxCategory = document.getElementById('stripeCategoryChart').getContext('2d');

            new Chart(ctxCategory, {
                type: 'doughnut',
                data: {
                    labels: categoryLabels.length ? categoryLabels : ['Belum ada data'],
                    datasets: [{
                        data: categoryValues.length ? categoryValues : [1],
                        // Warna-warni palet baru yang sangat harmonis
                        backgroundColor: ['#696FC7', '#C95792', '#F8B55F', '#3D365C', '#7C4585'],
                        borderWidth: 3,
                        borderColor: '#ffffff',
                        hoverOffset: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '72%', // Ketebalan cincin
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                boxWidth: 10,
                                font: { family: 'Inter', size: 12, weight: '500' },
                                color: '#273951',
                                usePointStyle: true
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
