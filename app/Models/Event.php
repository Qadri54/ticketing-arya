<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Mengizinkan semua kolom ini diisi data secara otomatis
    protected $fillable = [
        'name',
        'description',
        'image',
        'category',
        'location',
        'price',
        'online_price',
        'quota',
        'event_date',
        'youtube_link', 
    ];

    // Relasi: Satu Event punya banyak Transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Relasi: Satu Event memiliki banyak paket Sponsorship
    public function sponsorships()
    {
        return $this->hasMany(Sponsorship::class);
    }
}
