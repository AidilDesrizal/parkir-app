<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_masuks', function (Blueprint $table) {
            $table->id();

            $table->string('kode_tiket')->unique();

            // 🔹 relasi kendaraan
            $table->foreignId('kendaraan_id')
                ->constrained()
                ->cascadeOnDelete();

            // 🔹 petugas input
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // 🔹 tarif
            $table->foreignId('tarif_parkir_id')
                ->constrained()
                ->cascadeOnDelete();

            // 🔹 area
            $table->foreignId('area_parkir_id')
                ->constrained()
                ->cascadeOnDelete();

            // 🔹 waktu masuk
            $table->timestamp('waktu_masuk');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_masuks');
    }
};
