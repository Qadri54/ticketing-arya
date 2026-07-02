<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sponsorships', function (Blueprint $table) {
            $table->id();
            // Menyambungkan sponsor ke event tertentu
            $table->foreignId('event_id')->constrained()->onDelete('cascade');

            $table->string('name'); // Nama paket (Contoh: Platinum Sponsor)
            $table->integer('price'); // Harga paket sponsor (Contoh: 10000000)
            $table->text('benefits'); // Benefit yang didapat (Bisa dipisah dengan koma/newline)
            $table->integer('quota')->default(1); // Kuota sponsor untuk paket ini

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sponsorships');
    }
};
