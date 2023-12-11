<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pesanan_dikirims', function (Blueprint $table) {
            //
            $table->text('paket')->after('expedisi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanan_dikirims', function (Blueprint $table) {
            //
            $table->dropColumn('paket');
        });
    }
};
