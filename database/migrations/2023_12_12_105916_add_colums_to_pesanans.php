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
        Schema::table('pesanans', function (Blueprint $table) {
            $table->integer('kategori_id')->after('produk_id')->nullable();
            $table->integer('panjang')->after('total')->nullable();
            $table->integer('lebar')->after('total')->nullable();
            $table->string('kertas')->after('total')->nullable();
            $table->text('keterangan')->after('total')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            //
            $table->dropColumn('kategori_id');
            $table->dropColumn('panjang');
            $table->dropColumn('lebar');
            $table->dropColumn('kertas');
            $table->dropColumn('keterangan');
        });
    }
};
