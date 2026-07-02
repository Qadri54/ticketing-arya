<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('revenues', function (Blueprint $table) {
        $table->id();
        // Menghubungkan pendapatan dengan order_id dari tabel transaksi
        $table->string('order_id')->unique();
        // Mencatat jumlah nominal uang yang masuk
        $table->bigInteger('amount');
        // Catatan tambahan (misal: "Pembayaran konser musik")
        $table->string('description')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revenues');
    }
};
