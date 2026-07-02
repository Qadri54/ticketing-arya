<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Paket Sponsor - TICKS ID</title>

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

    <header class="h-20 bg-brand-dark border-b border-white/10 flex items-center justify-between px-8 sticky top-0 z-50 shadow-md">
        <div class="flex items-center w-1/4">
            <a href="{{ route('admin.sponsorships.index') }}" class="text-white/70 hover:text-white flex items-center gap-2 text-[14px] font-semibold transition-all duration-200 group">
                <span class="transform group-hover:-translate-x-1 transition-transform">&larr;</span> Kembali
            </a>
        </div>
        
        <div class="flex items-center justify-center gap-1.5 w-2/4">
            <span class="font-syne font-extrabold text-[22px] tracking-tight text-white block">TICKS</span>
            <span class="font-syne font-extrabold text-[22px] tracking-tight text-primary-subdued block">ID</span>
        </div>

        <div class="flex items-center justify-end w-1/4">
            <div class="flex items-center gap-2 bg-white/10 px-4 py-2 rounded-full border border-white/10">
                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                <span class="text-[11px] font-bold text-white tracking-wide uppercase">Sponsor Editor</span>
            </div>
        </div>
    </header>

    <div class="bg-gradient-to-r from-brand-dark via-primary-deep to-primary text-white py-12 px-8 shadow-inner">
        <div class="max-w-6xl w-full mx-auto flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <span class="text-primary-subdued font-bold text-xs uppercase tracking-widest bg-white/10 px-3 py-1 rounded-full border border-white/10">Kemitraan Komersial</span>
                <h1 class="text-[36px] font-bold tracking-tight font-syne mt-2">Modifikasi Paket Sponsor</h1>
                <p class="text-[14px] text-white/70 font-light mt-1">Sesuaikan nilai valuasi, kuota maksimal pendanaan, dan klausa benefit mitra.</p>
            </div>
            <div class="text-right">
                <span class="text-[12px] font-mono text-white/90 bg-brand-dark/50 px-4 py-2 border border-white/10 rounded-xl inline-block backdrop-blur-sm shadow-md">
                    💼 SPONSOR_ID: #{{ $sponsor->id }}
                </span>
            </div>
        </div>
    </div>

    <main class="flex-1 max-w-6xl w-full mx-auto py-10 px-6 -mt-8">
        
        <form action="{{ route('admin.sponsorships.update', $sponsor->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="bg-ruby/10 border border-ruby/20 text-ruby p-4 rounded-xl mb-6 text-[14px] flex gap-3 items-start shadow-sm">
                    <i class="bi bi-exclamation-triangle-fill text-[18px] mt-0.5"></i>
                    <div>
                        <span class="font-bold block mb-1">Gagal memperbarui paket sponsor:</span>
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
                            <i class="bi bi-award text-primary"></i> Detail Informasi Kemitraan
                        </h2>

                        <div>
                            <label class="block text-[11px] font-bold text-ink-secondary mb-2 uppercase tracking-wider">Hubungkan ke Event / Acara</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-primary/60"><i class="bi bi-calendar2-check"></i></span>
                                <select name="event_id" required class="w-full bg-canvas-soft focus:bg-white border border-hairline text-ink text-[15px] font-semibold rounded-xl pl-11 pr-4 py-3.5 focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all duration-200 appearance-none cursor-pointer">
                                    <option value="" disabled>-- Pilih Event Terkait --</option>
                                    @foreach($events as $event)
                                        <option value="{{ $event->id }}" {{ (old('event_id', $sponsor->event_id) == $event->id) ? 'selected' : '' }}>
                                            {{ $event->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-ink-mute/50"><i class="bi bi-chevron-down text-xs"></i></span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-ink-secondary mb-2 uppercase tracking-wider">Nama Paket Kemitraan</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-primary/60"><i class="bi bi-journal-bookmark-fill"></i></span>
                                <input type="text" name="name" value="{{ old('name', $sponsor->name) }}" required placeholder="Contoh: Platinum Sponsor Tier"
                                    class="w-full bg-canvas-soft focus:bg-white border border-hairline text-ink text-[15px] font-semibold rounded-xl pl-11 pr-4 py-3.5 focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all duration-200">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-ink-secondary mb-2 uppercase tracking-wider">Klausa Benefit / Keuntungan Kontraprestasi</label>
                            <textarea name="benefits" rows="6" required placeholder="Contoh: Eksklusivitas logo di panggung utama, Space booth ukuran 4x4 meter..."
                                class="w-full bg-canvas-soft focus:bg-white border border-hairline text-ink text-[15px] rounded-xl px-4 py-3.5 focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all duration-200 shadow-inner">{{ old('benefits', $sponsor->benefits) }}</textarea>
                            <div class="flex items-center gap-1.5 mt-2 text-ink-mute">
                                <i class="bi bi-info-circle text-[12px] text-primary"></i>
                                <span class="text-[11px]">Gunakan tanda koma (,) sebagai pemisah poin benefit agar otomatis terpecah menjadi daftar list.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    
                    <div class="bg-white border border-hairline rounded-[24px] shadow-level-1 p-6 space-y-5 relative overflow-hidden">
                        <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-primary-soft to-primary-subdued"></div>

                        <h2 class="text-[18px] font-bold text-brand-dark border-b border-hairline pb-3 flex items-center gap-2">
                            <i class="bi bi-cash-coin text-primary"></i> Nilai Kontrak Finansial
                        </h2>

                        <div>
                            <label class="block text-[11px] font-bold text-ink-secondary mb-2 uppercase tracking-wider">Harga Valuasi Paket</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-emerald-600 font-bold text-[14px]">Rp</span>
                                <input type="number" name="price" value="{{ old('price', $sponsor->price) }}" required min="0" placeholder="Contoh: 15000000"
                                    class="w-full bg-emerald-500/5 focus:bg-white border border-emerald-500/20 focus:border-emerald-500 text-emerald-700 text-[16px] font-bold rounded-xl pl-11 pr-4 py-3 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-ink-secondary mb-2 uppercase tracking-wider">Batas Batasan Maksimal Kuota (Slot)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-indigo-600/70"><i class="bi bi-people-fill"></i></span>
                                <input type="number" name="quota" value="{{ old('quota', $sponsor->quota) }}" required min="1"
                                    class="w-full bg-indigo-500/5 focus:bg-white border border-indigo-500/20 focus:border-indigo-500 text-indigo-700 text-[16px] font-bold rounded-xl pl-11 pr-4 py-3 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200">
                            </div>
                            <span class="text-[10px] text-ink-mute mt-1.5 block leading-relaxed">Jumlah korporat maksimal yang diizinkan untuk menandatangani paket ini.</span>
                        </div>
                    </div>

                    <div class="bg-gradient-to-b from-white to-primary/5 border border-hairline rounded-[24px] shadow-level-1 p-6 space-y-4">
                        <h2 class="text-[16px] font-bold text-brand-dark flex items-center gap-2">
                            <i class="bi bi-image text-primary"></i> Ilustrasi / Badge <span class="text-[11px] font-normal text-ink-mute">(Opsional)</span>
                        </h2>
                        
                        <div class="relative group aspect-square w-full max-w-[220px] mx-auto rounded-2xl bg-canvas-soft border-2 border-dashed border-primary/20 overflow-hidden flex items-center justify-center shadow-inner">
                            @if($sponsor->image)
                                <img id="badge-preview" src="{{ asset('storage/' . $sponsor->image) }}" alt="Preview" class="w-full h-full object-cover">
                                <div id="hover-overlay" class="absolute inset-0 bg-brand-dark/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-xs">
                                    <span class="text-white text-[11px] font-semibold bg-primary px-3 py-1.5 rounded-full shadow-md"><i class="bi bi-arrow-repeat mr-1"></i> Ganti Gambar</span>
                                </div>
                            @else
                                <div class="text-center p-4 transition-opacity duration-200" id="placeholder-box">
                                    <i class="bi bi-shield-check text-[36px] text-primary block mb-1"></i>
                                    <span class="text-primary text-[11px] font-bold block">Unggah Badge</span>
                                </div>
                                <img id="badge-preview" class="w-full h-full object-cover hidden">
                                <div id="hover-overlay" class="absolute inset-0 bg-brand-dark/60 opacity-0 group-hover:opacity-100 transition-opacity hidden items-center justify-center backdrop-blur-xs">
                                    <span class="text-white text-[11px] font-semibold bg-primary px-3 py-1.5 rounded-full shadow-md"><i class="bi bi-arrow-repeat mr-1"></i> Ganti Gambar</span>
                                </div>
                            @endif
                        </div>

                        <div>
                            <input type="file" name="image" id="badge-input" accept="image/*"
                                class="w-full text-xs text-ink-mute file:mr-3 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[11px] file:font-bold file:bg-primary file:text-white hover:file:bg-primary-press transition-all cursor-pointer border border-hairline rounded-lg p-1.5 bg-white">
                            <p class="text-[10px] text-ink-mute mt-2 text-center">Biarkan kosong jika tidak ingin mengubah gambar. Max 2MB.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 bg-brand-dark border border-white/10 rounded-[24px] p-6 shadow-level-2 flex flex-col sm:flex-row items-center justify-between gap-4">
                <span class="text-[13px] text-white/70 font-medium flex items-center gap-1.5">
                    <i class="bi bi-info-circle-fill text-primary-subdued"></i> Penyesuaian data tidak akan mengganggu riwayat transaksi sponsorship yang sudah berjalan.
                </span>
                <div class="flex items-center gap-4 w-full sm:w-auto shrink-0">
                    <a href="{{ route('admin.sponsorships.index') }}" class="text-[14px] text-white/70 hover:text-white font-bold px-5 py-3 transition-colors rounded-full hover:bg-white/5 w-center text-center w-full sm:w-auto">Batal</a>
                    <button type="submit" class="bg-primary hover:bg-primary-press text-white px-8 py-3.5 rounded-full text-[14px] font-bold transition-all shadow-md hover:-translate-y-0.5 w-full sm:w-auto text-center flex items-center justify-center gap-2">
                        <i class="bi bi-check-circle-fill"></i> Terapkan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </main>

    <script>
        const badgeInput = document.getElementById('badge-input');
        const badgePreview = document.getElementById('badge-preview');
        const placeholderBox = document.getElementById('placeholder-box');
        const hoverOverlay = document.getElementById('hover-overlay');

        if(badgeInput) {
            badgeInput.addEventListener('change', function() {
                const file = this.files[0];
                if(file) {
                    const reader = new FileReader();
                    reader.addEventListener('load', function() {
                        if(placeholderBox) placeholderBox.classList.add('hidden');
                        if(hoverOverlay) {
                            hoverOverlay.classList.remove('hidden');
                            hoverOverlay.classList.add('flex');
                        }
                        badgePreview.classList.remove('hidden');
                        badgePreview.setAttribute('src', this.result);
                    });
                    reader.readAsDataURL(file);
                }
            });
        }
    </script>
</body>
</html>