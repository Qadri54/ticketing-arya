<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'price',
        'benefits',
        'quota',
        'image', // <-- Tambahkan baris ini
    ];

    // Relasi balik: Paket Sponsorship ini milik satu Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
