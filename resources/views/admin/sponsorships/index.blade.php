<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Sponsorship - TICKS ID</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'] },
                    colors: {
                        primary: '#696FC7', 'primary-deep': '#3D365C', 'primary-press': '#7C4585',
                        'primary-subdued': '#F8B55F', 'brand-dark': '#1c1e54', ink: '#0d253d',
                        'ink-secondary': '#273951', 'ink-mute': '#64748d', canvas: '#ffffff',
                        'canvas-soft': '#f6f9fc', hairline: '#e3e8ee', ruby: '#ea2261',
                    },
                    boxShadow: {
                        'level-1': '0 1px 3px rgba(0,55,112,0.08)',
                        'level-2': '0 8px 24px rgba(0,55,112,0.08), 0 2px 6px rgba(0,55,112,0.04)',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-canvas-soft text-ink flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-brand-dark flex flex-col justify-between hidden lg:flex relative z-20 shadow-level-2">
        <div>
            <div class="h-24 flex items-center px-8 border-b border-white/5">
                <span class="text-white font-light text-[24px] tracking-[-0.22px]">
                    TICKS <span class="font-medium text-primary-subdued">ID</span>
                </span>
            </div>

            <nav class="p-5 space-y-2 mt-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-white/60 hover:text-white hover:bg-white/5 rounded-xl text-[14px] font-medium transition-all">
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
                <a href="{{ route('admin.sponsorships.index') }}" class="flex items-center gap-3 px-4 py-3 bg-white/10 text-white rounded-xl text-[14px] font-medium shadow-sm transition-all hover:bg-white/15">
                    <span class="text-lg">🤝</span> Kelola Sponsorship
                </a>
            </nav>
        </div>

        <div class="p-5 border-t border-white/5">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left text-[13px] text-primary-soft hover:text-white px-3 py-2 rounded-lg transition-colors flex items-center gap-2">
                    🚪 Keluar dari Sistem
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col h-full overflow-y-auto relative z-10">
        <div class="absolute top-0 left-0 w-full h-[300px] bg-gradient-to-tr from-canvas-soft via-primary-soft/10 to-primary-subdued/20 blur-[90px] opacity-80 z-0 pointer-events-none"></div>

        <div class="h-20 px-10 flex items-center justify-end relative z-10 shrink-0">
            <div class="flex items-center gap-3 bg-white/40 px-4 py-2 rounded-full border border-hairline backdrop-blur-sm">
                <div class="w-7 h-7 rounded-full bg-primary flex items-center justify-center text-white text-xs font-semibold uppercase">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
                <span class="text-[13px] font-medium text-ink">{{ Auth::user()->name ?? 'Administrator' }}</span>
            </div>
        </div>

        <div class="px-10 mb-8 relative z-10 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div>
                <h1 class="text-[32px] font-light tracking-[-0.64px] text-ink mb-1">Marketplace Sponsorship</h1>
                <p class="text-[15px] text-ink-mute font-light">Kelola penawaran paket sponsor untuk seluruh event Anda.</p>
            </div>

            <a href="{{ route('admin.sponsorships.create') }}" class="bg-primary hover:bg-primary-press text-white px-6 py-2.5 rounded-full text-[14px] font-medium transition-all shadow-level-1 inline-flex items-center gap-2">
                <span>+</span> Tambah Paket Baru
            </a>
        </div>

        <div class="px-10 pb-12 relative z-10 flex-1">
            @if(session('success'))
                <div class="bg-green-50 border border-green-100 text-green-700 px-6 py-4 rounded-[12px] mb-6 flex items-center gap-3 shadow-sm">
                    <span class="text-[14px] font-medium">✅ {{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-canvas border border-hairline rounded-[16px] shadow-level-1 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left min-w-[950px]">
                        <thead>
                            <tr class="bg-canvas-soft border-b border-hairline text-[12px] font-semibold text-ink-mute uppercase tracking-wider">
                                <th class="py-4 px-6 w-[5%]">No</th>
                                <th class="py-4 px-6 w-[30%]">Nama Paket & Event</th>
                                <th class="py-4 px-6 w-[25%]">Benefit / Keuntungan</th>
                                <th class="py-4 px-6 w-[15%] text-right">Harga (Rp)</th>
                                <th class="py-4 px-6 w-[10%] text-center">Kuota</th>
                                <!-- Kolom Aksi dilebarkan -->
                                <th class="py-4 px-6 w-[15%] text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-[14px] text-ink divide-y divide-hairline">
                            @forelse($sponsorships as $index => $sponsor)
                            <tr class="hover:bg-canvas-soft/30 transition-colors">
                                <td class="py-4 px-6 font-medium text-ink-mute">{{ $index + 1 }}</td>

                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-16 rounded-lg bg-hairline overflow-hidden shrink-0 shadow-sm flex items-center justify-center">
                                            @if($sponsor->image)
                                                <img src="{{ asset('storage/' . $sponsor->image) }}" alt="{{ $sponsor->name }}" class="w-full h-full object-cover">
                                            @else
                                                <span class="text-ink-mute text-xs text-center px-1">No Img</span>
                                            @endif
                                        </div>

                                        <div>
                                            <div class="font-medium text-[15px] text-ink mb-1">{{ $sponsor->name }}</div>
                                            <div class="text-[12px] text-primary bg-primary/10 inline-block px-2 py-1 rounded-md mt-1">
                                                📍 {{ $sponsor->event->name ?? 'Event Dihapus' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-4 px-6">
                                    <ul class="text-[13px] text-ink-mute list-disc list-inside">
                                        @foreach(explode(',', $sponsor->benefits) as $benefit)
                                            <li>{{ trim($benefit) }}</li>
                                        @endforeach
                                    </ul>
                                </td>

                                <td class="py-4 px-6 text-right font-medium">
                                    {{ number_format($sponsor->price, 0, ',', '.') }}
                                </td>

                                <td class="py-4 px-6 text-center">
                                    <span class="bg-canvas-soft border border-hairline px-3 py-1 rounded-full text-[13px]">
                                        {{ $sponsor->quota }}
                                    </span>
                                </td>

                                <td class="py-4 px-6">
                                    <!-- TOMBOL AKSI BARU -->
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.sponsorships.edit', $sponsor->id) }}" class="text-[13px] bg-white border border-hairline text-ink hover:border-primary hover:text-primary px-4 py-2 rounded-full font-medium transition-colors shadow-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.sponsorships.destroy', $sponsor->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus paket sponsor ini?')" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-[13px] bg-ruby/10 border border-transparent text-ruby hover:bg-ruby hover:text-white px-4 py-2 rounded-full font-medium transition-colors">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-16 text-center">
                                    <h5 class="text-[16px] font-medium text-ink mb-1">Belum ada paket sponsor</h5>
                                    <p class="text-[14px] text-ink-mute mb-4">Buat paket pertama Anda untuk menarik sponsor.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
