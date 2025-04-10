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
            $table->foreignId('produk_id')->constrained('produks', 'id_produk')->onDelete('cascade');
            $table->string('nama');
            $table->string('alamat');
            $table->string('no_hp');
            $table->enum('pengiriman', ['wa_jek', 'kurir']);
            $table->integer('jarak')->nullable();
            $table->integer('ongkir');
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
