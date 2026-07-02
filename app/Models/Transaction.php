<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi: Transaksi ini milik Event apa?
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Relasi: Transaksi ini milik User siapa?
    public function user()
    {
        return $this->belongsTo(User::class); // Pastikan model User ada bawaan Laravel
    }

    // Relasi: Satu Transaksi bisa membuahkan banyak Tiket fisik/QR
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
