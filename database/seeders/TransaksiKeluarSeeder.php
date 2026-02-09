<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransaksiKeluar;
use App\Models\TransaksiMasuk;

class TransaksiKeluarSeeder extends Seeder
{
    public function run(): void
    {
        $masuk = TransaksiMasuk::all();

        foreach ($masuk as $m) {
            TransaksiKeluar::create([
                'transaksi_masuk_id' => $m->id,
                'waktu_keluar' => $m->waktu_masuk->copy()->addMinutes(rand(30,300)),
            ]);
        }
    }
}

