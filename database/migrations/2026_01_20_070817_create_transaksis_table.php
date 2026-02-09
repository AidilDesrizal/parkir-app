<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();

            // 🔹 user / petugas yang melakukan transaksi
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // 🔹 relasi utama
            $table->foreignId('kendaraan_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('tarif_parkir_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('area_parkir_id')
                ->constrained()
                ->cascadeOnDelete();

            // 🔹 data waktu parkir
            $table->time('jam_masuk');
            $table->time('jam_keluar')->nullable();

            // 🔹 perhitungan
            $table->integer('durasi_jam');
            $table->integer('total_bayar')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};