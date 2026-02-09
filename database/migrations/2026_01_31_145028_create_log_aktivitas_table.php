<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id();

            // 🔹 petugas / user yang melakukan aksi
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // 🔹 aksi yang dilakukan (create, update, delete, login, dll)
            $table->string('aksi');

            // 🔹 keterangan tambahan
            $table->text('keterangan')->nullable();

            // 🔹 ip address (nilai plus)
            $table->string('ip_address', 45)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_aktivitas');
    }
};