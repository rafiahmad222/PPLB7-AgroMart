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
            $table->id('id_pesanan');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('produks', 'id_produk')->onDelete('cascade');
            $table->foreignId('alamat_id')->constrained('alamat', 'id_alamat')->onDelete('cascade');
            $table->enum('pengiriman', ['wa_jek', 'ambil_ditempat']);
            $table->integer('jarak')->nullable();
            $table->integer('ongkir');
            $table->integer('jumlah')->default(1);
            $table->enum('pembayaran', ['transfer', 'cod']);
            $table->integer('total');
            $table->enum('status', ['Diproses', 'Dikirim', 'Diterima','Selesai'])->default('Diproses');
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
