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
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom role dengan 4 pilihan. Default-nya 'user'
            $table->enum('role', ['admin', 'eo', 'panitia', 'user'])
                  ->default('user')
                  ->after('email');
        });
    }

    /**
     * Kembalikan migration (Menghapus kolom).
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
