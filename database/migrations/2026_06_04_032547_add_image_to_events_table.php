<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration (Menambah kolom).
     */
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Menambahkan kolom image yang boleh kosong (nullable) sementara
            $table->string('image')->nullable()->after('description');
        });
    }

    /**
     * Kembalikan migration (Menghapus kolom).
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
