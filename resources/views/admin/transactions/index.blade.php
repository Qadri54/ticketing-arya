<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi - TICKS ID</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        primary: '#696FC7',
                        'primary-deep': '#3D365C',
                        'primary-press': '#7C4585',
                        'primary-soft': '#C95792',
                        'primary-subdued': '#F8B55F',
                        'brand-dark': '#1c1e54',
                        ink: '#0d253d',
                        'ink-secondary': '#273951',
                        'ink-mute': '#64748d',
                        canvas: '#ffffff',
                        'canvas-soft': '#f6f9fc',
                        'canvas-cream': '#f5e9d4',
                        hairline: '#e3e8ee',
                        ruby: '#ea2261',
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
        }
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
                <a href="{{ route('admin.events.index') }}" class="flex items-center gap-3 px-4 py-3 text-white/60 hover:text-white hover:bg-white/5 rounded-xl text-[14px] font-medium transition-all">
                    <span class="text-lg">🎟️</span> Manajemen Event
                </a>
                <a href="{{ route('admin.transactions.index') }}" class="flex items-center gap-3 px-4 py-3 bg-white/10 text-white rounded-xl text-[14px] font-medium shadow-sm transition-all hover:bg-white/15">
                    <span class="text-lg">💳</span> Data Transaksi
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 text-white/60 hover:text-white hover:bg-white/5 rounded-xl text-[14px] font-medium transition-all">
                    <span class="text-lg">👥</span> Kelola Pengguna
                </a>
                <a href="{{ route('admin.sponsorships.create') }}" class="flex items-center gap-3 px-4 py-3 text-white/60 hover:text-white hover:bg-white/5 rounded-xl text-[14px] font-medium transition-all">
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
                <h1 class="text-[32px] font-light tracking-[-0.64px] text-ink mb-1">Data Transaksi</h1>
                <p class="text-[15px] text-ink-mute font-light">Pantau seluruh riwayat pembelian dan status pembayaran tiket.</p>
            </div>

        </div>

        <div class="px-10 pb-12 relative z-10 flex-1">

            <div class="bg-canvas border border-hairline rounded-[16px] shadow-level-1 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-canvas-soft border-b border-hairline text-[12px] font-semibold text-ink-mute uppercase tracking-wider">
                                <th class="py-4 px-6 w-[15%]">Order ID / Waktu</th>
                                <th class="py-4 px-6 w-[25%]">Pembeli</th>
                                <th class="py-4 px-6 w-[25%]">Event</th>
                                <th class="py-4 px-6 w-[10%] text-center">Jml Tiket</th>
                                <th class="py-4 px-6 w-[15%] text-right">Total (Rp)</th>
                                <th class="py-4 px-6 w-[10%] text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-[14px] text-ink divide-y divide-hairline">

                            @forelse($transactions as $trx)
                            <tr class="hover:bg-canvas-soft/30 transition-colors">

                                <td class="py-4 px-6">
                                    <div class="font-medium text-primary text-[13px] tabular-numeric mb-1">
                                        #{{ $trx->order_id ?? $trx->id }}
                                    </div>
                                    <div class="text-[12px] text-ink-mute">
                                        {{ $trx->created_at->format('d M Y, H:i') }}
                                    </div>
                                </td>

                                <td class="py-4 px-6">
                                    <div class="font-medium text-[14px] text-ink mb-1 truncate max-w-[180px]">
                                        {{ $trx->user->name ?? 'User Terhapus' }}
                                    </div>
                                    <div class="text-[12px] text-ink-mute truncate max-w-[180px]">
                                        {{ $trx->user->email ?? '-' }}
                                    </div>
                                </td>

                                <td class="py-4 px-6">
                                    <span class="inline-block bg-canvas-soft border border-hairline text-ink-secondary text-[12px] px-3 py-1.5 rounded-md font-medium leading-snug truncate max-w-[180px]">
                                        {{ $trx->event->name ?? 'Event Terhapus' }}
                                    </span>
                                </td>

                                <td class="py-4 px-6 text-center">
                                    <span class="tabular-numeric font-medium text-ink">{{ $trx->quantity }}</span>
                                </td>

                                <td class="py-4 px-6 text-right font-medium">
                                    <span class="tabular-numeric text-ink">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</span>
                                </td>

                                <td class="py-4 px-6 text-center">
                                    @if($trx->payment_status == 'paid' || $trx->payment_status == 'success' || $trx->payment_status == 'settlement')
                                        <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 text-[11px] px-2.5 py-1 rounded-full font-medium">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Berhasil
                                        </span>
                                    @elseif($trx->payment_status == 'pending')
                                        <span class="inline-flex items-center gap-1.5 bg-yellow-50 text-yellow-700 text-[11px] px-2.5 py-1 rounded-full font-medium">
                                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 animate-pulse"></span> Pending
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 bg-ruby/10 text-ruby text-[11px] px-2.5 py-1 rounded-full font-medium">
                                            <span class="w-1.5 h-1.5 rounded-full bg-ruby"></span> Gagal
                                        </span>
                                    @endif
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-16 text-center">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-canvas-soft mb-4 border border-hairline">
                                        <span class="text-2xl opacity-50">📭</span>
                                    </div>
                                    <h5 class="text-[16px] font-medium text-ink mb-1">Belum Ada Transaksi</h5>
                                    <p class="text-[14px] text-ink-mute mb-4">Belum ada pengguna yang melakukan pembelian tiket.</p>
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
