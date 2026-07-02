<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi: Tiket ini berasal dari Transaksi yang mana?
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
