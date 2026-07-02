<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class AdminTransactionController extends Controller
{
    public function index()
    {
        // Mengambil semua data transaksi beserta data pembeli (user) dan event terkait
        // latest() digunakan agar transaksi terbaru muncul paling atas
        $transactions = Transaction::with(['user', 'event'])->latest()->get();
        
        return view('admin.transactions.index', compact('transactions'));
    }
}