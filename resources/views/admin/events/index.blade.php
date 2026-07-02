<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Event - TICKS ID</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'], },
                    colors: {
                        primary: '#696FC7', 'primary-deep': '#3D365C', 'primary-press': '#7C4585',
                        'primary-soft': '#C95792', 'primary-subdued': '#F8B55F', 'brand-dark': '#1c1e54',
                        ink: '#0d253d', 'ink-secondary': '#273951', 'ink-mute': '#64748d',
                        canvas: '#ffffff', 'canvas-soft': '#f0f4f8', hairline: '#e3e8ee', ruby: '#ea2261',
                    },
                    boxShadow: {
                        'level-1': '0 4px 20px rgba(28, 30, 84, 0.04), 0 1px 3px rgba(28, 30, 84, 0.02)',
                        'level-2': '0 20px 40px rgba(28, 30, 84, 0.08), 0 1px 10px rgba(28, 30, 84, 0.03)',
                    }
                }
            }
        }
    </script>
    <style>
        body { font-feature-settings: "ss01" 1; -webkit-font-smoothing: antialiased; }
        .tabular-numeric { font-feature-settings: "tnum" 1; }
    </style>
</head>
<body class="bg-canvas-soft text-ink flex h-screen overflow-hidden">

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
                <a href="{{ route('admin.events.index') }}" class="flex items-center gap-3 px-4 py-3 bg-white/10 text-white rounded-xl text-[14px] font-medium shadow-sm transition-all hover:bg-white/15">
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

    <main class="flex-1 flex flex-col h-full overflow-y-auto relative z-10">
        <div class="absolute top-0 left-0 w-full h-[300px] bg-gradient-to-tr from-canvas-cream via-primary-soft/20 to-primary-subdued/30 blur-[90px] opacity-80 z-0 pointer-events-none"></div>

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
                <h1 class="text-[32px] font-light tracking-[-0.64px] text-ink mb-1">Manajemen Event</h1>
                <p class="text-[15px] text-ink-mute font-light">Kelola seluruh data katalog event resmi TICKS ID.</p>
            </div>
            <a href="{{ route('admin.events.create') }}" class="bg-primary hover:bg-primary-press text-white px-6 py-2.5 rounded-full text-[14px] font-medium transition-all shadow-level-1 hover:shadow-level-2 hover:-translate-y-0.5 inline-flex items-center gap-2">
                <span>+</span> Tambah Event Baru
            </a>
        </div>

        <div class="px-10 pb-12 relative z-10 flex-1">
            @if(session('success'))
                <div class="bg-green-50 border border-green-100 text-green-700 px-6 py-4 rounded-[12px] mb-6 flex items-center gap-3 shadow-sm">
                    <span class="text-lg">🎉</span>
                    <span class="text-[14px] font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-canvas border border-hairline rounded-[16px] shadow-level-1 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left min-w-[950px]">
                        <thead>
                            <tr class="bg-canvas-soft border-b border-hairline text-[12px] font-semibold text-ink-mute uppercase tracking-wider">
                                <th class="py-4 px-6 w-[5%]">No</th>
                                <th class="py-4 px-6 w-[35%]">Detail Event</th>
                                <th class="py-4 px-6 w-[15%]">Kategori</th>
                                <th class="py-4 px-6 w-[15%]">Pelaksanaan</th>
                                <th class="py-4 px-6 w-[15%] text-right">Harga</th>
                                <th class="py-4 px-6 w-[15%] text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-[14px] text-ink divide-y divide-hairline">
                            @forelse($events as $index => $event)
                            <tr class="hover:bg-canvas-soft/30 transition-colors">
                                <td class="py-4 px-6 font-medium text-ink-mute">{{ $index + 1 }}</td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-16 rounded-lg bg-hairline overflow-hidden shrink-0 shadow-sm flex items-center justify-center">
                                        @if($event->image)
                                            {{-- Hapus 'event-posters/' dari sini, karena sudah ada di dalam variabel $event->image --}}
                                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-ink-mute text-xs">No Img</span>
                                        @endif
                                    </div>
                                        <div>
                                            <div class="font-medium text-[15px] text-ink mb-1">{{ $event->name }}</div>
                                            <div class="text-[13px] text-ink-mute flex items-center gap-1">
                                                <span class="opacity-70">📍</span>
                                                <span class="truncate max-w-[200px]">{{ $event->location }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 align-middle">
                                    <span class="inline-block bg-primary-subdued/20 text-primary-deep text-[11.5px] px-3 py-1.5 rounded-md font-medium text-center">
                                        {{ $event->category }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="text-[14px] text-ink tabular-numeric font-medium mb-1">{{ date('d M Y', strtotime($event->event_date)) }}</div>
                                    <div class="text-[12px] text-ink-mute">{{ date('H:i', strtotime($event->event_date)) }} WIB</div>
                                </td>
                                <td class="py-4 px-6 text-right font-medium">
                                    @if($event->price == 0)
                                        <span class="text-green-600">Gratis</span>
                                    @else
                                        <span class="tabular-numeric text-ink">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                                    @endif
                                    <div class="text-[12px] text-ink-mute mt-1 font-normal">Kuota: {{ $event->quota }}</div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('admin.events.edit', $event->id) }}" class="text-[13px] bg-white border border-hairline text-ink hover:border-primary hover:text-primary px-4 py-2 rounded-full font-medium transition-colors shadow-sm">Edit</a>
                                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus event ini?')" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-[13px] bg-ruby/10 border border-transparent text-ruby hover:bg-ruby hover:text-white px-4 py-2 rounded-full font-medium transition-colors">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-16 text-center">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-canvas-soft mb-4 border border-hairline">📁</div>
                                    <h5 class="text-[16px] font-medium text-ink mb-1">Belum ada data event</h5>
                                    <a href="{{ route('admin.events.create') }}" class="text-[14px] text-primary underline">Tambah Event Sekarang</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>


</html>
