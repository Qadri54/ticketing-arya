<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Event;
use App\Models\Sponsorship;
use App\Models\Transaction;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\AdminTransactionController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\SponsorshipController;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketMail;
use Illuminate\Http\Request;

// =========================================================
// RUTE PUBLIK (TIDAK PERLU LOGIN)
// =========================================================
Route::get('/', function (Request $request) {
    $query = Event::query();

    if ($request->has('search') && $request->search != '') {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('category', 'like', '%' . $request->search . '%');
    }
    if ($request->has('location') && $request->location != '') {
        $query->where('location', 'like', '%' . $request->location . '%');
    }

    $events = $query->latest()->get();
    $sponsorships = Sponsorship::with('event')->latest()->get();

    return view('events.index', compact('events', 'sponsorships'));
});

Route::get('/event/{id}', function ($id) {
    $event = Event::findOrFail($id);
    return view('events.show', compact('event'));
});

// Testing Email (Boleh dibiarkan)
Route::get('/test-email-qr', function () {
    $transaction = Transaction::latest()->first();
    if (!$transaction) { return "Belum ada transaksi di database!"; }
    Mail::to('newwestthoseeyes@gmail.com')->send(new TicketMail($transaction));
    return "Email dengan QR Code dikirim!";
});
Route::get('/tes-langsung', function () { return view('emails.ticket'); });

// =========================================================
// RUTE PEMESANAN & PROFIL (SEMUA AKUN YANG LOGIN: USER, EO, ADMIN)
// =========================================================
Route::middleware('auth')->group(function () {
    Route::post('/checkout/{id}', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/transaction/{id}', [CheckoutController::class, 'show'])->name('transaction.show');
    Route::get('/history', [CheckoutController::class, 'history'])->name('transaction.history');
    Route::get('/download-ticket/{id}', [CheckoutController::class, 'downloadTicket'])->name('ticket.download');
    Route::get('/debug-paid/{id}', [CheckoutController::class, 'debugPaid']);

    // Profil User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =========================================================
// RUTE SCANNER (KHUSUS PANITIA, EO, & ADMIN)
// =========================================================
Route::middleware(['auth', 'role:admin,eo,panitia'])->group(function () {
    Route::get('/scanner', [CheckInController::class, 'index']);
    Route::post('/check-in-process', [CheckInController::class, 'process']);
});

// =========================================================
// RUTE DASHBOARD & MANAJEMEN EVENT (KHUSUS EO & ADMIN)
// =========================================================
Route::middleware(['auth', 'role:admin,eo'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Utama
    Route::get('/dashboard', [AdminEventController::class, 'dashboard'])->name('dashboard');

    // CRUD Event
    Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [AdminEventController::class, 'create'])->name('events.create');
    Route::post('/events', [AdminEventController::class, 'store'])->name('events.store');
    Route::get('/events/{id}/edit', [AdminEventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}', [AdminEventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [AdminEventController::class, 'destroy'])->name('events.destroy');

    // Manajemen Transaksi
    Route::get('/transactions', [AdminTransactionController::class, 'index'])->name('transactions.index');

    // Manajemen Sponsorship (DIPERBARUI: Menambahkan rute index)
    // Manajemen Sponsorship
    Route::get('/sponsorships', [SponsorshipController::class, 'index'])->name('sponsorships.index');
    Route::get('/sponsorships/create', [SponsorshipController::class, 'create'])->name('sponsorships.create');
    Route::post('/sponsorships', [SponsorshipController::class, 'store'])->name('sponsorships.store');

    // TAMBAHKAN 3 BARIS INI:
    Route::get('/sponsorships/{id}/edit', [SponsorshipController::class, 'edit'])->name('sponsorships.edit');
    Route::put('/sponsorships/{id}', [SponsorshipController::class, 'update'])->name('sponsorships.update');
    Route::delete('/sponsorships/{id}', [SponsorshipController::class, 'destroy'])->name('sponsorships.destroy');
});

// =========================================================
// RUTE KELOLA PENGGUNA (SANGAT RAHASIA - KHUSUS ADMIN)
// =========================================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');
});


// =========================================================
// INTEGRASI PAYMENT GATEWAY MIDTRANS
// =========================================================
Route::post('/midtrans-callback', [CheckoutController::class, 'callback']);
Route::get('/midtrans/finish', [CheckoutController::class, 'finish'])->name('midtrans.finish');

require __DIR__.'/auth.php';
