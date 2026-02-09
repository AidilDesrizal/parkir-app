<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TransaksiMasuk;
use Carbon\Carbon;

class TransaksiKeluarFactory extends Factory
{
    public function definition(): array
    {
        $masuk = TransaksiMasuk::factory()->create();

        $keluar = Carbon::parse($masuk->waktu_masuk)
            ->addMinutes(rand(30, 600));

        return [
            'transaksi_masuk_id' => $masuk->id,
            'waktu_keluar' => $keluar,

            // kosongkan → dihitung otomatis model
            'durasi_menit' => null,
            'biaya' => null,
        ];
    }
}
