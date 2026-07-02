<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Revenue;
use Illuminate\Support\Facades\DB;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\Storage; // Pastikan ini tetap di-import untuk menghapus berkas lama

class AdminEventController extends Controller
{
    // HANYA UNTUK DASHBOARD (Grafik & Statistik)
    public function dashboard()
    {
        // 1. Mengambil data statistik atas
        $totalPendapatan = Revenue::sum('amount');
        $tiketTerjual = Transaction::where('payment_status', 'paid')->sum('quantity');
        $eventAktif = Event::count();
        $totalPengguna = User::count();

        // TAMBAHAN: Pendapatan Sponsor
        // (Untuk sementara kita jumlahkan dari tabel Sponsorship. Nanti bisa kamu sesuaikan
        // jika kamu punya tabel khusus untuk mencatat 'transaksi_sponsor' yang sudah lunas)
        $pendapatanSponsor = Sponsorship::sum('price');

        // 2. Mengambil 5 Event terbaru untuk ditampilkan di tabel
        $activeEvents = Event::latest()->take(5)->get();

        // 3. Data chart tahun 2026
        $monthlySales = Revenue::whereYear('created_at', 2026)
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(amount) as total'))
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $salesData = [];
        for ($i = 1; $i <= 12; $i++) {
            $salesData[] = isset($monthlySales[$i]) ? $monthlySales[$i] / 1000000 : 0;
        }

        $categoryData = Event::join('transactions', 'events.id', '=', 'transactions.event_id')
            ->where('transactions.payment_status', 'paid')
            ->select('events.category', DB::raw('SUM(transactions.quantity) as total'))
            ->groupBy('events.category')
            ->pluck('total', 'events.category')
            ->toArray();

        // PASTIKAN $pendapatanSponsor MASUK KE DALAM COMPACT DI BAWAH INI:
        return view('eo.dashboard', compact(
            'totalPendapatan',
            'tiketTerjual',
            'eventAktif',
            'totalPengguna',
            'pendapatanSponsor', // <-- Ini yang baru ditambahkan
            'salesData',
            'categoryData',
            'activeEvents'
        ));
    }

    // HANYA UNTUK MANAJEMEN EVENT (Tabel)
    public function index()
    {
        $events = Event::all();
        $sponsorships = Sponsorship::all();

        return view('admin.events.index', compact('events', 'sponsorships'));
    }

    public function create() { return view('admin.events.create'); }

   // ==========================================
    // FUNGSI UNTUK MENYIMPAN EVENT BARU (CREATE)
    // ==========================================
    public function store(Request $request)
    {
        // 1. Tentukan kategori mana yang boleh punya fitur Online
        $hybridCategories = ['LIVE CONCERT', 'WORKSHOP', 'STAND UP COMEDY'];

        // 2. Jika kategori tidak ada di daftar di atas, paksa nilai Online menjadi kosong/0
        if (!in_array($request->category, $hybridCategories)) {
            $request->merge([
                'youtube_link' => null,
                'online_price' => 0
            ]);
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'event_date' => 'required|date',
            'price' => 'required|numeric|min:0',
            'online_price' => 'nullable|numeric|min:0',
            'quota' => 'required|numeric|min:1',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'youtube_link' => 'nullable|url|max:255', // <-- Tambahan validasi baru
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('event-posters', 'public');
        }

        Event::create($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event baru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    // ==========================================
    // FUNGSI UNTUK MENYIMPAN EDIT EVENT (UPDATE)
    // ==========================================
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'event_date' => 'required|date',
            'price' => 'required|numeric|min:0',
            'online_price' => 'nullable|numeric|min:0',
            'quota' => 'required|numeric|min:1',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'youtube_link' => 'nullable|url|max:255', // <-- Tambahan validasi baru
        ]);

        if ($request->hasFile('image')) {
            if ($event->image && \Storage::disk('public')->exists($event->image)) {
                \Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = $request->file('image')->store('event-posters', 'public');
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')->with('success', 'Data event berhasil diperbarui!');
    }

    // ==========================================
    // FUNGSI UNTUK MENGHAPUS EVENT (DESTROY)
    // ==========================================
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        // Hapus file gambar/poster dari penyimpanan jika ada
        if ($event->image && \Storage::disk('public')->exists($event->image)) {
            \Storage::disk('public')->delete($event->image);
        }

        // Hapus data event dari database
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Data event berhasil dihapus!');
    }
}
