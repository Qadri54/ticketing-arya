<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event; // Memanggil model Event
use Carbon\Carbon; // Bawaan Laravel untuk mengatur format tanggal

class EventSeeder extends Seeder
{
    public function run()
    {
        // Kita siapkan daftar event mitramu di sini
        $events = [
            [
                'name' => 'Sumut Heritage Run 2026',
                'description' => 'Acara lari maraton menyusuri bangunan bersejarah di Sumatera Utara. Dapatkan medali dan jersey eksklusif!',
                'category' => 'Sport Event',
                'price' => 150000,
                'quota' => 500,
                'event_date' => Carbon::create(2026, 8, 15, 6, 0, 0), // Format: Tahun, Bulan, Tanggal, Jam, Menit, Detik
            ],
            [
                'name' => 'Medan Padel Fest',
                'description' => 'Turnamen Padel amatir dan profesional. Jangan lewatkan keseruannya bersama komunitas!',
                'category' => 'Sport Event & Tournament',
                'price' => 250000,
                'quota' => 200,
                'event_date' => Carbon::create(2026, 9, 10, 8, 0, 0),
            ],
            [
                'name' => 'Instaperfect Beauty Class',
                'description' => 'Workshop kecantikan bersama pakar makeup artist. Gratis produk untuk peserta!',
                'category' => 'Seminar & Workshop',
                'price' => 0, // Sengaja kita buat 0 untuk mengetes event gratis
                'quota' => 50,
                'event_date' => Carbon::create(2026, 10, 5, 13, 0, 0),
            ]
        ];

        // Looping untuk menyimpan data di atas ke tabel events di database
        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
