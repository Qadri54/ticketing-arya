<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Transaction;
use App\Models\Revenue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
// 👇 Tambahan Library Carbon untuk mengecek waktu
use Carbon\Carbon; 

class CheckoutController extends Controller
{
    // 1. Memproses Checkout awal
    public function processCheckout(Request $request, $eventId)
    {
        // Tambahkan validasi ticket_type
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'ticket_type' => 'required|in:offline,online' 
        ]);

        $user = Auth::user();
        $jumlahBeli = $request->input('quantity');
        $tipeTiket = $request->input('ticket_type');
        $maksimalTiket = 5; // Disesuaikan dengan form HTML kamu (Maks 5)

        return DB::transaction(function () use ($eventId, $user, $jumlahBeli, $tipeTiket, $maksimalTiket) {
            $event = Event::where('id', $eventId)->lockForUpdate()->firstOrFail();

            // 🔴 1. VALIDASI TANGGAL: Tolak pesanan jika tanggal event sudah terlewat
            if (Carbon::parse($event->event_date)->isPast()) {
                return redirect()->back()->with('error', 'Transaksi gagal. Pendaftaran untuk event ini telah ditutup karena acara sudah selesai.');
            }

            // 🔴 2. VALIDASI TIKET ONLINE: Tolak pesanan jika tidak ada link YouTube
            if ($tipeTiket === 'online' && empty($event->youtube_link)) {
                return redirect()->back()->with('error', 'Mohon maaf, tiket Online/Livestream tidak tersedia untuk event ini karena tidak ada siaran langsung.');
            }

            $tiketSudahDibeli = Transaction::where('user_id', $user->id)
                ->where('event_id', $eventId)
                ->whereIn('payment_status', ['pending', 'paid'])
                ->sum('quantity');

            if (($tiketSudahDibeli + $jumlahBeli) > $maksimalTiket) {
                return redirect()->back()->with('error', "Gagal! Maksimal $maksimalTiket tiket per user.");
            }

            if ($event->quota < $jumlahBeli) {
                return redirect()->back()->with('error', 'Maaf, kuota tiket tidak mencukupi.');
            }

            // Kurangi kuota event
            $event->decrement('quota', $jumlahBeli);

            // PENENTUAN HARGA BERDASARKAN TIPE TIKET
            $hargaSatuan = 0;
            if ($tipeTiket === 'offline') {
                $hargaSatuan = $event->price;
            } else {
                // Pastikan kolom 'online_price' ada di database, jika null maka Gratis (0)
                $hargaSatuan = $event->online_price ?? 0;
            }

            $totalHarga = $hargaSatuan * $jumlahBeli;

            // Jika total 0 (Gratis), langsung lunas. Jika tidak, pending ke Midtrans.
            $statusPembayaran = ($totalHarga == 0) ? 'paid' : 'pending';

            $transaction = Transaction::create([
                'user_id' => $user->id,
                'event_id' => $event->id,
                'order_id' => 'TRX-' . strtoupper(Str::random(10)),
                'quantity' => $jumlahBeli,
                'ticket_type' => $tipeTiket, // Simpan tipe tiket ke database
                'total_amount' => $totalHarga,
                'payment_status' => $statusPembayaran
            ]);

            // BYPASS MIDTRANS JIKA TIKET GRATIS (Rp 0)
            if ($totalHarga == 0) {
                // Langsung cetak tiket
                for ($i = 0; $i < $transaction->quantity; $i++) {
                    \App\Models\Ticket::create([
                        'transaction_id' => $transaction->id,
                        'ticket_code' => $transaction->order_id . '-' . strtoupper(\Illuminate\Support\Str::random(4)),
                        'is_scanned' => false,
                    ]);
                }

                $transaction->load('tickets');

                // Kirim email
                if ($user->email) {
                    try {
                        Mail::to($user->email)->send(new TicketMail($transaction));
                    } catch (\Exception $e) {
                        Log::error("Gagal kirim email tiket gratis: " . $e->getMessage());
                    }
                }

                return redirect()->route('transaction.history')->with('success', 'Tiket gratis berhasil diklaim & dikirim ke email!');
            }

            // Jika berbayar, arahkan ke halaman Invoice (Midtrans)
            return redirect()->route('transaction.show', $transaction->id)
                             ->with('success', 'Pesanan berhasil dibuat!');
        });
    }

    // 2. Menampilkan halaman Invoice / Pembayaran
    public function show($id)
    {
        $transaction = Transaction::with('event')->findOrFail($id);

        if ($transaction->user_id !== Auth::id()) {
            abort(403, 'Maaf, Anda tidak memiliki akses.');
        }

        // Cegah error Midtrans jika tiket sudah lunas/gratis
        if ($transaction->payment_status === 'paid') {
            return redirect()->route('transaction.history')->with('success', 'Transaksi ini sudah lunas.');
        }

        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $transaction->order_id,
                'gross_amount' => $transaction->total_amount,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

        $snapToken = '';
        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
        } catch (\Exception $e) {
            Log::error("Midtrans Error: " . $e->getMessage());
        }

        return view('transactions.show', compact('transaction', 'snapToken'));
    }

    // 3. Callback dari Midtrans
    public function callback(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $transaction = Transaction::with(['event', 'user', 'tickets'])->where('order_id', $request->order_id)->first();

            if ($transaction && $transaction->payment_status != 'paid') {
                if (in_array($request->transaction_status, ['capture', 'settlement'])) {
                    $transaction->update(['payment_status' => 'paid']);

                    // MESIN PENCETAK TIKET
                    if ($transaction->tickets->count() == 0) {
                        for ($i = 0; $i < $transaction->quantity; $i++) {
                            \App\Models\Ticket::create([
                                'transaction_id' => $transaction->id,
                                'ticket_code' => $transaction->order_id . '-' . strtoupper(\Illuminate\Support\Str::random(4)),
                                'is_scanned' => false,
                            ]);
                        }
                    }

                    $transaction->load('tickets');

                    Revenue::firstOrCreate(['order_id' => $transaction->order_id], [
                        'amount' => $transaction->total_amount,
                        'description' => 'Pendapatan dari event: ' . ($transaction->event->name ?? 'Event')
                    ]);

                    if ($transaction->user && $transaction->user->email) {
                        try {
                            Mail::to($transaction->user->email)->send(new TicketMail($transaction));
                        } catch (\Exception $e) {
                            Log::error("Gagal kirim email: " . $e->getMessage());
                        }
                    }
                } elseif (in_array($request->transaction_status, ['deny', 'expire', 'cancel'])) {
                    $transaction->update(['payment_status' => 'failed']);
                }
            }
        }
        return response()->json(['message' => 'OK']);
    }

    // 4. Cek Status saat kembali dari Midtrans (Berjalan saat testing di Lokal)
    public function finish(Request $request)
    {
        $orderId = $request->order_id;
        if (!$orderId) return redirect()->route('transaction.history')->with('error', 'Transaksi tidak ditemukan.');

        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;

        try {
            $statusInfo = \Midtrans\Transaction::status($orderId);
            $transaction = Transaction::with(['event', 'user', 'tickets'])->where('order_id', $orderId)->first();

            if ($transaction && $transaction->payment_status != 'paid') {
                if (in_array($statusInfo->transaction_status, ['capture', 'settlement'])) {
                    $transaction->update(['payment_status' => 'paid']);

                    // MESIN PENCETAK TIKET
                    if ($transaction->tickets->count() == 0) {
                        for ($i = 0; $i < $transaction->quantity; $i++) {
                            \App\Models\Ticket::create([
                                'transaction_id' => $transaction->id,
                                'ticket_code' => $transaction->order_id . '-' . strtoupper(\Illuminate\Support\Str::random(4)),
                                'is_scanned' => false,
                            ]);
                        }
                    }

                    $transaction->load('tickets');

                    Revenue::firstOrCreate(['order_id' => $orderId], [
                        'amount' => $transaction->total_amount,
                        'description' => 'Pendapatan dari event: ' . ($transaction->event->name ?? 'Event')
                    ]);

                    if ($transaction->user && $transaction->user->email) {
                        Mail::to($transaction->user->email)->send(new TicketMail($transaction));
                    }
                }
            }
            return redirect()->route('transaction.history')->with('success', 'Pembayaran berhasil dikonfirmasi dan Tiket telah dikirim!');
        } catch (\Exception $e) {
            return redirect()->route('transaction.history')->with('error', 'Gagal update status.');
        }
    }

    // 5. Download PDF
    public function downloadTicket($id)
    {
        $transaction = Transaction::with(['event', 'user'])->findOrFail($id);
        if ($transaction->user_id !== Auth::id() || $transaction->payment_status !== 'paid') {
            abort(403, 'Akses ditolak.');
        }

        $pdf = Pdf::loadView('transactions.pdf_ticket', compact('transaction'));
        return $pdf->download('Tiket-Event-' . $transaction->order_id . '.pdf');
    }

    // 6. Debugging status (Hapus jika sudah live)
    public function debugPaid($id)
    {
        $transaction = Transaction::with('event', 'user', 'tickets')->findOrFail($id);
        $transaction->update(['payment_status' => 'paid']);

        if ($transaction->tickets->count() == 0) {
            for ($i = 0; $i < $transaction->quantity; $i++) {
                \App\Models\Ticket::create([
                    'transaction_id' => $transaction->id,
                    'ticket_code' => $transaction->order_id . '-' . strtoupper(\Illuminate\Support\Str::random(4)),
                    'is_scanned' => false,
                ]);
            }
        }

        $transaction = Transaction::with('event', 'user', 'tickets')->findOrFail($id);

        if ($transaction->user && $transaction->user->email) {
            Mail::to($transaction->user->email)->send(new TicketMail($transaction));
        }

        return "Status LUNAS. " . $transaction->quantity . " Tiket berhasil dicetak ke database & Email dikirim!";
    }

    public function history()
    {
        $transactions = Transaction::with('event')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('transactions.history', compact('transactions'));
    }
}