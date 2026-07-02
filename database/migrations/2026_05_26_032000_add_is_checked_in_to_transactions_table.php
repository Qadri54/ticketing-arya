<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Menambahkan kolom is_checked_in, default-nya false (belum hadir)
            $table->boolean('is_checked_in')->default(false)->after('payment_status');
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('is_checked_in');
        });
    }
};
