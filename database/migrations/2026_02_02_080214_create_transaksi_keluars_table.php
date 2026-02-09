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
    Schema::create('transaksi_keluars', function (Blueprint $table) {
    $table->id();

    $table->foreignId('transaksi_masuk_id')
        ->constrained('transaksi_masuks')
        ->cascadeOnDelete();

    $table->timestamp('waktu_keluar');

    $table->integer('durasi_menit')->nullable();
    $table->integer('biaya')->nullable();

    $table->timestamps();
});

}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_keluars');
    }
};
