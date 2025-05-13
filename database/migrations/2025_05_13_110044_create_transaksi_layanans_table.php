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
        Schema::create('transaksi_layanans', function (Blueprint $table) {
            $table->id('id_transaksi_layanan');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('layanan_id')->constrained('layanans', 'id_layanan')->onDelete('cascade');
            $table->foreignId('alamat_id')->constrained('alamat', 'id_alamat')->onDelete('cascade');
            $table->integer('jumlah')->default(1);
            $table->enum('pembayaran', ['transfer', 'cod']);
            $table->string('bukti_transfer')->nullable();
            $table->decimal('total', 12, 2);
            $table->dateTime('jadwal_booking');
            $table->enum('status', ['pending', 'lunas', 'gagal'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_layanans');
    }
};
