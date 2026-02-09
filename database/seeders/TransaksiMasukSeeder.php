<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransaksiMasuk;
use App\Models\Kendaraan;
use App\Models\User;
use App\Models\TarifParkir;
use App\Models\AreaParkir;

class TransaksiMasukSeeder extends Seeder
{
    public function run(): void
    {
        $kend = Kendaraan::all();
        $users = User::all();
        $tarif = TarifParkir::all();
        $area  = AreaParkir::all();

        foreach ($kend as $k) {
            TransaksiMasuk::create([
                'kode_tiket' => 'TKT'.rand(10000,99999),
                'kendaraan_id' => $k->id,
                'user_id' => $users->random()->id,
                'tarif_parkir_id' => $tarif->random()->id,
                'area_parkir_id' => $area->random()->id,
                'waktu_masuk' => now()->subMinutes(rand(30,600)),
            ]);
        }
    }
}
