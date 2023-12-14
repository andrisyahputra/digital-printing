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
        Schema::table('kerajangs', function (Blueprint $table) {
            $table->integer('kategori_id')->after('produk_id')->nullable();
            $table->integer('panjang')->after('kuantitas')->nullable();
            $table->integer('lebar')->after('kuantitas')->nullable();
            $table->string('kertas')->after('kuantitas')->nullable();
            $table->text('keterangan')->after('kuantitas')->nullable();
            $table->text('foto')->after('kuantitas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kerajangs', function (Blueprint $table) {
            $table->dropColumn('kategori_id');
            $table->dropColumn('panjang');
            $table->dropColumn('lebar');
            $table->dropColumn('kertas');
            $table->dropColumn('keterangan');
            $table->dropColumn('foto');
        });
    }
};
