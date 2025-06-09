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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('pesanan_id')->nullable()->constrained('pesanans', 'id_pesanan')->onDelete('cascade');  // Referensi ke tabel pesanans
            $table->string('message');
            $table->string('type'); // 'new_order', 'status_update', etc.
            $table->boolean('is_read')->default(false);
            $table->json('data')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
