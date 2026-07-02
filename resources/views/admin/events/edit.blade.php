<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event - TICKS ID</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'system-ui', 'sans-serif'],
                        syne: ['Syne', 'sans-serif'],
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
                        'canvas-soft': '#f0f4f8',
                        hairline: '#e3e8ee',
                        ruby: '#ea2261',
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
        textarea::-webkit-scrollbar { width: 6px; }
        textarea::-webkit-scrollbar-track { background: transparent; }
        textarea::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        textarea::-webkit-scrollbar-thumb:hover { background: #696FC7; }
    </style>
</head>
<body class="bg-canvas-soft text-ink font-sans antialiased min-h-screen flex flex-col">

    <header class="h-20 bg-brand-dark border-b border-white/10 flex items-center justify-between px-8 sticky top-0 z-50 shadow-level-1">
        <a href="{{ route('admin.events.index') }}" class="text-white/70 hover:text-white flex items-center gap-2 text-[14px] font-semibold transition-all duration-200 group">
            <span class="transform group-hover:-translate-x-1 transition-transform">&larr;</span> Kembali
        </a>
        <div class="flex items-center gap-1.5">
            <span class="font-syne font-extrabold text-[20px] tracking-tight text-white">TICKS</span>
            <span class="font-syne font-extrabold text-[20px] tracking-tight text-primary-subdued">ID</span>
        </div>
        <div class="flex items-center gap-2 bg-white/10 px-4 py-2 rounded-full border border-white/10">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            <span class="text-[11px] font-bold text-white tracking-wide uppercase">Editor</span>
        </div>
    </header>

    <div class="bg-gradient-to-r from-brand-dark via-primary-deep to-primary text-white py-12 px-8 shadow-inner">
        <div class="max-w-6xl w-full mx-auto flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <span class="text-primary-subdued font-bold text-xs uppercase tracking-widest bg-white/10 px-3 py-1 rounded-full border border-white/10">Manajemen Konten</span>
                <h1 class="text-[36px] font-bold tracking-tight font-syne mt-2">Modifikasi Atribut Event</h1>
                <p class="text-[14px] text-white/70 font-light mt-1">Perbarui instrumen pemasaran, penyesuaian kuota, dan unggah berkas visual.</p>
            </div>
            <div class="text-right hidden md:block">
                <span class="text-[12px] font-mono text-white/90 bg-brand-dark/50 px-4 py-2 border border-white/10 rounded-xl inline-block backdrop-blur-sm shadow-md">
                    ⚙️ EVENT_ID: #{{ $event->id }}
                </span>
            </div>
        </div>
    </div>

    <main class="flex-1 max-w-6xl w-full mx-auto py-10 px-6 -mt-8">

        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="bg-ruby/10 border border-ruby/20 text-ruby p-4 rounded-xl mb-6 text-[14px] flex gap-3 items-start shadow-level-1">
                    <i class="bi bi-exclamation-triangle-fill text-[18px] mt-0.5"></i>
                    <div>
                        <span class="font-bold block mb-1">Gagal memperbarui data:</span>
                        <ul class="list-disc list-inside space-y-0.5 opacity-90">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white border border-hairline rounded-[24px] shadow-level-1 p-8 space-y-6 relative overflow-hidden">
                        <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-primary to-primary-soft"></div>

                        <h2 class="text-[18px] font-bold text-brand-dark border-b border-hairline pb-3 flex items-center gap-2">
                            <i class="bi bi-file-earmark-text text-primary"></i> Detail Konten Utama
                        </h2>

                        <div>
                            <label class="block text-[11px] font-bold text-ink-secondary mb-2 uppercase tracking-wider">Nama Resmi Event</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-primary/60"><i class="bi bi-type"></i></span>
                                <input type="text" name="name" value="{{ old('name', $event->name) }}" required
                                    class="w-full bg-canvas-soft focus:bg-white border border-hairline text-ink text-[15px] font-semibold rounded-xl pl-11 pr-4 py-3.5 focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all duration-200">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[11px] font-bold text-ink-secondary mb-2 uppercase tracking-wider">Kategori Klaster</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-primary/60"><i class="bi bi-tags"></i></span>
                                    <select name="category" id="category-select" required class="w-full bg-canvas-soft focus:bg-white border border-hairline text-ink text-[15px] font-medium rounded-xl pl-11 pr-4 py-3.5 focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all duration-200 appearance-none cursor-pointer">
                                        @foreach(['LIVE CONCERT', 'EXHIBITION', 'SPORTS', 'CULINARY FEST', 'WORKSHOP', 'STAND UP COMEDY'] as $cat)
                                            <option value="{{ $cat }}" {{ old('category', $event->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                        @endforeach
                                    </select>
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-ink-mute/50"><i class="bi bi-chevron-down text-xs"></i></span>
                                </div>
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-ink-secondary mb-2 uppercase tracking-wider">Lokasi / Venue</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-primary/60"><i class="bi bi-geo-alt"></i></span>
                                    <input type="text" name="location" value="{{ old('location', $event->location) }}" required
                                        class="w-full bg-canvas-soft focus:bg-white border border-hairline text-ink text-[15px] font-medium rounded-xl pl-11 pr-4 py-3.5 focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all duration-200">
                                </div>
                            </div>
                        </div>

                        {{-- WRAPPER ONLINE OPTION (Hanya muncul jika kategori hybrid) --}}
                        <div id="online-options" class="{{ in_array(old('category', $event->category), ['LIVE CONCERT', 'WORKSHOP', 'STAND UP COMEDY']) ? '' : 'hidden' }} space-y-6 mt-6 pt-6 border-t border-hairline transition-all duration-500">
                            <div class="p-5 border-2 border-dashed border-ruby/30 rounded-xl bg-ruby/5">
                                <label class="block text-[11px] font-bold text-ruby mb-1 uppercase tracking-wider"><i class="bi bi-youtube mr-1"></i> Link Livestream YouTube</label>
                                <p class="text-[11px] text-ruby/80 font-medium mb-3">Isi jika event ini menyiarkan tayangan langsung. Link akan dikunci oleh sistem dan hanya muncul setelah pelanggan lunas.</p>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-ruby/60"><i class="bi bi-link-45deg text-lg"></i></span>
                                    <input type="url" name="youtube_link" value="{{ old('youtube_link', $event->youtube_link) }}" placeholder="Contoh: https://www.youtube.com/watch?v=..."
                                        class="w-full bg-white border border-ruby/20 text-ink text-[14px] font-medium rounded-xl pl-11 pr-4 py-3 focus:outline-none focus:border-ruby focus:ring-4 focus:ring-ruby/10 transition-all duration-200">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-ink-secondary mb-2 uppercase tracking-wider">Deskripsi Lengkap Acara</label>
                            <textarea name="description" rows="5" required placeholder="Tuliskan detail rundown jadwal..."
                                class="w-full bg-canvas-soft focus:bg-white border border-hairline text-ink text-[15px] rounded-xl px-4 py-3.5 focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all duration-200">{{ old('description', $event->description) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white border border-hairline rounded-[24px] shadow-level-1 p-6 space-y-5 relative overflow-hidden">
                        <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-primary-soft to-primary-subdued"></div>
                        <h2 class="text-[18px] font-bold text-brand-dark border-b border-hairline pb-3 flex items-center gap-2">
                            <i class="bi bi-sliders text-primary"></i> Logistik & Aturan
                        </h2>

                        <div>
                            <label class="block text-[11px] font-bold text-ink-secondary mb-2 uppercase tracking-wider">Waktu Pelaksanaan</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-primary/60"><i class="bi bi-calendar-event"></i></span>
                                <input type="datetime-local" name="event_date" value="{{ old('event_date', date('Y-m-d\TH:i', strtotime($event->event_date))) }}" required
                                    class="w-full bg-canvas-soft focus:bg-white border border-hairline text-ink text-[14px] font-semibold rounded-xl pl-11 pr-4 py-3 focus:outline-none focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all duration-200">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[11px] font-bold text-ink-secondary mb-2 uppercase tracking-wider">Harga Offline</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-emerald-600 font-bold text-[14px]">Rp</span>
                                    <input type="number" name="price" value="{{ old('price', $event->price) }}" required min="0"
                                        class="w-full bg-emerald-500/5 focus:bg-white border border-emerald-500/20 focus:border-emerald-500 text-emerald-700 text-[15px] font-bold rounded-xl pl-11 pr-4 py-3 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200">
                                </div>
                            </div>

                            <div id="online-price-wrapper" class="{{ in_array(old('category', $event->category), ['LIVE CONCERT', 'WORKSHOP', 'STAND UP COMEDY']) ? '' : 'hidden' }}">
                                <label class="block text-[11px] font-bold text-ink-secondary mb-2 uppercase tracking-wider">Harga Online</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-blue-600 font-bold text-[14px]">Rp</span>
                                    <input type="number" name="online_price" value="{{ old('online_price', $event->online_price) }}" min="0"
                                        class="w-full bg-blue-500/5 focus:bg-white border border-blue-500/20 focus:border-blue-500 text-blue-700 text-[15px] font-bold rounded-xl pl-11 pr-4 py-3 focus:outline-none focus:ring-4 focus:ring-blue-500/10 transition-all duration-200">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-ink-secondary mb-2 uppercase tracking-wider">Kuota Maksimal Tiket</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-indigo-600/70"><i class="bi bi-ticket-perforated"></i></span>
                                <input type="number" name="quota" value="{{ old('quota', $event->quota) }}" required min="1"
                                    class="w-full bg-indigo-500/5 focus:bg-white border border-indigo-500/20 focus:border-indigo-500 text-indigo-700 text-[16px] font-bold rounded-xl pl-11 pr-4 py-3 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200">
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-b from-white to-primary/5 border border-hairline rounded-[24px] shadow-level-1 p-6 space-y-4">
                        <h2 class="text-[16px] font-bold text-brand-dark flex items-center gap-2">
                            <i class="bi bi-image text-primary"></i> Poster Promosi <span class="text-xs font-normal text-ink-mute">(Opsional)</span>
                        </h2>
                        <div class="relative group aspect-video w-full rounded-xl bg-canvas-soft border-2 border-dashed border-primary/20 overflow-hidden flex items-center justify-center shadow-inner">
                            <div class="text-center p-4 transition-opacity duration-200 {{ $event->image ? 'hidden' : '' }}" id="placeholder-box">
                                <i class="bi bi-cloud-arrow-up-fill text-[36px] text-primary/60 block mb-1"></i>
                                <span class="text-primary text-[13px] font-bold block">Unggah Selebaran</span>
                            </div>
                            <img id="poster-preview" src="{{ $event->image ? asset('storage/' . $event->image) : '' }}" class="w-full h-full object-cover {{ $event->image ? '' : 'hidden' }}">
                            <div id="hover-overlay" class="absolute inset-0 bg-brand-dark/60 opacity-0 group-hover:opacity-100 transition-opacity {{ $event->image ? 'flex' : 'hidden' }} items-center justify-center backdrop-blur-xs">
                                <span class="text-white text-xs font-semibold bg-primary px-4 py-2 rounded-full shadow-lg"><i class="bi bi-arrow-repeat mr-1"></i> Ganti File</span>
                            </div>
                        </div>
                        <input type="file" name="image" id="image-input" accept="image/*" class="w-full text-xs text-ink-mute file:mr-3 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[11px] file:font-bold file:bg-primary file:text-white hover:file:bg-primary-press transition-all cursor-pointer border border-hairline rounded-lg p-1.5 bg-white">
                    </div>
                </div>
            </div>

            <div class="mt-8 bg-brand-dark border border-white/10 rounded-[24px] p-6 shadow-level-2 flex flex-col sm:flex-row items-center justify-between gap-4">
                <span class="text-[13px] text-white/70 font-medium flex items-center gap-1.5"><i class="bi bi-info-circle-fill text-primary-subdued"></i> Pastikan data sudah tervalidasi.</span>
                <div class="flex items-center gap-4 w-full sm:w-auto shrink-0">
                    <a href="{{ route('admin.events.index') }}" class="text-[14px] text-white/70 hover:text-white font-bold px-5 py-3 transition-colors rounded-full w-center text-center w-full sm:w-auto">Batal</a>
                    <button type="submit" class="bg-primary hover:bg-primary-press text-white px-8 py-3.5 rounded-full text-[14px] font-bold transition-all w-full sm:w-auto text-center flex items-center justify-center gap-2"><i class="bi bi-check-circle-fill"></i> Terapkan Perubahan</button>
                </div>
            </div>
        </form>
    </main>

    <script>
        // Logika Hide/Show
        const categorySelect = document.getElementById('category-select');
        const onlineOptions = document.getElementById('online-options');
        const onlinePriceWrapper = document.getElementById('online-price-wrapper');
        const hybridCategories = ['LIVE CONCERT', 'WORKSHOP', 'STAND UP COMEDY'];

        function toggleOnlineFields() {
            if (hybridCategories.includes(categorySelect.value)) {
                onlineOptions.classList.remove('hidden');
                onlinePriceWrapper.classList.remove('hidden');
            } else {
                onlineOptions.classList.add('hidden');
                onlinePriceWrapper.classList.add('hidden');
                // Reset nilai jika kategori diganti ke non-hybrid
                document.querySelector('input[name="youtube_link"]').value = '';
                document.querySelector('input[name="online_price"]').value = 0;
            }
        }

        categorySelect.addEventListener('change', toggleOnlineFields);

        // Script untuk Preview Gambar
        const imageInput = document.getElementById('image-input');
        const posterPreview = document.getElementById('poster-preview');
        const placeholderBox = document.getElementById('placeholder-box');
        const hoverOverlay = document.getElementById('hover-overlay');

        if(imageInput) {
            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if(file) {
                    const reader = new FileReader();
                    reader.addEventListener('load', function() {
                        if(placeholderBox) placeholderBox.classList.add('hidden');
                        if(hoverOverlay) {
                            hoverOverlay.classList.remove('hidden');
                            hoverOverlay.classList.add('flex');
                        }
                        posterPreview.classList.remove('hidden');
                        posterPreview.setAttribute('src', this.result);
                    });
                    reader.readAsDataURL(file);
                }
            });
        }
    </script>
</body>
</html>
