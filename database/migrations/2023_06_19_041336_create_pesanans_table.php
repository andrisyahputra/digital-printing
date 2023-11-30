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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('produk_id');
            $table->string('nama');
            $table->bigInteger('harga');
            $table->integer('kuantitas');
            $table->string('total');
            $table->enum('status',['pending','success','cancel','deny','expired','diproses','diterima','dikirim','tolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
