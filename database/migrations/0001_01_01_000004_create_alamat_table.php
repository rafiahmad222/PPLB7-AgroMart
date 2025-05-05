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
        Schema::create('alamat', function (Blueprint $table) {
            $table->id('id_alamat');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_kabupaten_kota');
            $table->unsignedBigInteger('id_kecamatan');
            $table->unsignedBigInteger('id_kode_pos');
            $table->text('detail_alamat');
            $table->timestamps();

            $table->foreign('id_kabupaten_kota')->references('id_kabupaten_kota')->on('kabupaten_kota')->onDelete('restrict');
            $table->foreign('id_kecamatan')->references('id_kecamatan')->on('kecamatan')->onDelete('restrict');
            $table->foreign('id_kode_pos')->references('id_kode_pos')->on('kode_pos')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alamat');
    }
};
