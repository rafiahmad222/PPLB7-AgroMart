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
        Schema::create('kode_pos', function (Blueprint $table) {
            $table->id('id_kode_pos');
            $table->unsignedBigInteger('id_kecamatan'); // foreign key ke kecamatan
            $table->string('kode_pos', 10);
            $table->timestamps();

            $table->foreign('id_kecamatan')->references('id_kecamatan')->on('kecamatan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kode_pos');
    }
};
