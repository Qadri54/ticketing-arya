<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class CheckInController extends Controller
{
    public function index() {
        return view('admin.scanner');
    }

    public function process(Request $request)
    {
        // 1. Ambil order_id dari hasil scan QR Code
        $order_id = $request->order_id;

        // 2. Cari transaksi di database
        $transaction = Transaction::with('user', 'event')->where('order_id', $order_id)->first();

        // 3. Validasi 1: Apakah tiket ditemukan?
        if (!$transaction) {
            return response()->json(['success' => false, 'message' => 'Tiket tidak ditemukan / Palsu!']);
        }

        // 4. Validasi 2: Apakah tiket sudah lunas?
        if ($transaction->payment_status !== 'paid' && $transaction->payment_status !== 'settlement') {
            return response()->json(['success' => false, 'message' => 'Tiket ini belum dibayar lunas!']);
        }

        // 5. Validasi 3: Apakah tiket sudah di-scan sebelumnya?
        if ($transaction->is_checked_in) {
            return response()->json(['success' => false, 'message' => 'Tiket sudah digunakan sebelumnya!']);
        }

        // 6. Jika semua lolos, ubah status jadi sudah check-in
        $transaction->is_checked_in = true;
        $transaction->save();

        // Kembalikan respon sukses beserta nama pesertanya
        return response()->json([
            'success' => true,
            'message' => 'Check-in Berhasil!',
            'participant_name' => $transaction->user->name ?? 'Peserta'
        ]);
    }
}
