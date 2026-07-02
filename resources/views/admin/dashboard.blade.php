<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ikhtisar Platform - TICKS ID</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'], },
                    colors: {
                        primary: '#696FC7',
                        'primary-deep': '#3D365C',
                        'primary-soft': '#C95792',
                        'primary-subdued': '#F8B55F',
                        'brand-dark': '#1c1e54',
                        ink: '#0d253d',
                        'ink-mute': '#64748d',
                        'canvas-soft': '#f8fafc',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-canvas-soft text-ink flex h-screen overflow-hidden font-sans">

    <aside class="w-64 bg-brand-dark flex flex-col justify-between hidden lg:flex relative z-20 shrink-0">
        <div>
            <div class="h-20 flex items-center px-8 border-b border-white/5 mt-4">
                <span class="text-white font-light text-[24px] tracking-tight">
                    TICKS <span class="font-bold text-primary-subdued">ID</span>
                </span>
            </div>

            <nav class="p-5 space-y-2 mt-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-white/10 text-white rounded-xl text-[14px] font-medium transition-all">
                    <span class="text-lg">📊</span> Ikhtisar Platform
                </a>
                <a href="{{ route('admin.events.index') }}" class="flex items-center gap-3 px-4 py-3 text-white/60 hover:text-white hover:bg-white/5 rounded-xl text-[14px] font-medium transition-all">
                    <span class="text-lg">🎟️</span> Manajemen Event
                </a>
                <a href="{{ route('admin.transactions.index') }}" class="flex items-center gap-3 px-4 py-3 text-white/60 hover:text-white hover:bg-white/5 rounded-xl text-[14px] font-medium transition-all">
                    <span class="text-lg">💳</span> Data Transaksi
                </a>
                <a href="{{ route('admin.users.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-white/60 hover:text-white hover:bg-white/5 rounded-xl text-[14px] font-medium transition-all">
                    <span class="text-lg">👥</span> Kelola Pengguna
                </a>
                <a href="{{ route('admin.sponsorships.index') }}" class="flex items-center gap-3 px-4 py-3 text-white/60 hover:text-white hover:bg-white/5 rounded-xl text-[14px] font-medium transition-all">
                    <span class="text-lg">🤝</span> Kelola Sponsorship
                </a>
            </nav>
        </div>

        <div class="p-5 border-t border-white/5">
            <div class="flex items-center gap-3 p-3 bg-white/5 rounded-xl border border-white/10">
                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white text-sm font-semibold uppercase">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-[14px] text-white font-medium truncate">{{ Auth::user()->name ?? 'Administrator' }}</p>
                    <p class="text-[11px] text-primary-subdued truncate">Platform Admin</p>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="w-full text-left text-[12px] text-red-400 hover:text-red-300 px-3 py-2 rounded-lg transition-colors flex items-center gap-2">
                    🚪 Keluar dari Sistem
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-full overflow-y-auto relative z-10 w-full bg-[#f4f7fb]">
        
        <div class="px-8 pt-10 pb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-[28px] font-normal text-ink mb-1">Ikhtisar Platform</h1>
                <p class="text-[14px] text-ink-mute">Ringkasan performa sistem secara keseluruhan.</p>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-[13px] text-ink-mute bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100">Periode: <span class="font-bold text-ink">Tahun 2026</span></span>
                <a href="{{ route('admin.events.create') }}" class="bg-brand-dark hover:bg-ink text-white px-5 py-2 rounded-full text-[14px] font-medium transition-colors shadow-md">
                    + Tambah Event
                </a>
            </div>
        </div>

        <div class="px-8 pb-12">
            
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-4 mb-8">
                
                <div class="bg-white rounded-[20px] p-5 shadow-sm border border-gray-100 flex flex-col justify-between h-28 relative">
                    <div class="flex justify-between items-start">
                        <span class="text-[11px] font-semibold text-gray-400 tracking-wider">OMSET TIKET</span>
                        <span class="bg-gray-100 text-gray-600 border border-gray-200 text-[9px] font-bold px-2 py-0.5 rounded">Midtrans</span>
                    </div>
                    <div>
                        <span class="text-[20px] font-bold text-ink">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="bg-white rounded-[20px] p-5 shadow-sm border border-gray-100 flex flex-col justify-between h-28 relative">
                    <div class="flex justify-between items-start">
                        <span class="text-[11px] font-semibold text-gray-400 tracking-wider">DANA SPONSOR</span>
                        <span class="bg-emerald-50 text-emerald-600 border border-emerald-100 text-[9px] font-bold px-2 py-0.5 rounded">WhatsApp</span>
                    </div>
                    <div>
                        <span class="text-[20px] font-bold text-ink">Rp {{ number_format($pendapatanSponsor ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="bg-white rounded-[20px] p-5 shadow-sm border border-gray-100 flex flex-col justify-between h-28 relative">
                    <div class="flex justify-between items-start">
                        <span class="text-[11px] font-semibold text-gray-400 tracking-wider">TIKET TERJUAL</span>
                        <span class="bg-gray-100 text-gray-600 border border-gray-200 text-[9px] font-bold px-2 py-0.5 rounded">Paid</span>
                    </div>
                    <div>
                        <span class="text-[20px] font-bold text-ink">{{ $tiketTerjual ?? 0 }} <span class="text-[13px] font-normal text-gray-400">Lembar</span></span>
                    </div>
                </div>

                <div class="bg-white rounded-[20px] p-5 shadow-sm border border-gray-100 flex flex-col justify-between h-28 relative">
                    <div class="flex justify-between items-start">
                        <span class="text-[11px] font-semibold text-gray-400 tracking-wider">EVENT AKTIF</span>
                        <span class="bg-gray-100 text-gray-600 border border-gray-200 text-[9px] font-bold px-2 py-0.5 rounded">Katalog</span>
                    </div>
                    <div>
                        <span class="text-[20px] font-bold text-ink">{{ $eventAktif ?? 0 }} <span class="text-[13px] font-normal text-gray-400">Acara</span></span>
                    </div>
                </div>

                <div class="bg-white rounded-[20px] p-5 shadow-sm border border-gray-100 flex flex-col justify-between h-28 relative">
                    <div class="flex justify-between items-start">
                        <span class="text-[11px] font-semibold text-gray-400 tracking-wider">TOTAL PENGGUNA</span>
                        <span class="bg-gray-100 text-gray-600 border border-gray-200 text-[9px] font-bold px-2 py-0.5 rounded">Terdaftar</span>
                    </div>
                    <div>
                        <span class="text-[20px] font-bold text-ink">{{ $totalPengguna ?? 0 }} <span class="text-[13px] font-normal text-gray-400">Akun</span></span>
                    </div>
                </div>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="lg:col-span-2 bg-white rounded-[24px] p-6 shadow-sm border border-gray-100">
                    <h3 class="text-[16px] font-bold text-ink mb-6">Statistik Keuangan Bulanan (Juta Rp)</h3>
                    <div class="relative w-full h-72">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-[24px] p-6 shadow-sm border border-gray-100 flex flex-col items-center">
                    <h3 class="text-[16px] font-bold text-ink mb-4 w-full text-left">Proporsi Kategori</h3>
                    <div class="relative w-full h-60 flex items-center justify-center">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>

            </div>

        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            
            // 1. GRAFIK GARIS (STATISTIK KEUANGAN)
            const salesCtx = document.getElementById('salesChart').getContext('2d');
            
            // Mengambil data dari variabel PHP dengan aman
            let salesDataValues = @json($salesData ?? [0,0,0,0,0,0,0,0,0,0,0,0]);

            new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Pendapatan (Juta Rp)',
                        data: salesDataValues,
                        borderColor: '#696FC7', 
                        backgroundColor: 'rgba(105, 111, 199, 0.15)', 
                        borderWidth: 3,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#696FC7',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        fill: true,
                        tension: 0.4 
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, ticks: { color: '#6b7280' } },
                        x: { ticks: { color: '#6b7280' }, grid: { display: false } }
                    }
                }
            });

            // 2. GRAFIK DONAT (PROPORSI KATEGORI)
            const catCtx = document.getElementById('categoryChart').getContext('2d');
            
            let rawCategoryData = @json($categoryData ?? []);
            
            // JIKA DATABASE MASIH KOSONG, TAMPILKAN DONAT ABU-ABU AGAR TIDAK ERROR
            if (Object.keys(rawCategoryData).length === 0) {
                rawCategoryData = {'Belum ada transaksi': 1};
            }

            const catLabels = Object.keys(rawCategoryData);
            const catValues = Object.values(rawCategoryData);
            
            // Set warna (jika kosong tampil abu-abu, jika ada isinya pakai warna cerah)
            const bgColors = Object.keys(rawCategoryData)[0] === 'Belum ada transaksi' 
                             ? ['#e2e8f0'] 
                             : ['#696FC7', '#C95792', '#F8B55F', '#1c1e54', '#3b82f6'];

            new Chart(catCtx, {
                type: 'doughnut',
                data: {
                    labels: catLabels,
                    datasets: [{
                        data: catValues,
                        backgroundColor: bgColors,
                        borderWidth: 2,
                        borderColor: '#ffffff',
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });
            
        });
    </script>
</body>
</html>