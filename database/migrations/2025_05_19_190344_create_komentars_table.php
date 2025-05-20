<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('komentars', function (Blueprint $table) {
            $table->id('id_komentar');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('artikel_id')->constrained('artikels', 'id_artikel')->onDelete('cascade');
            $table->text('konten');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentars');
    }
};
