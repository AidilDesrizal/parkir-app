<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TarifParkir;

class TarifParkirSeeder extends Seeder
{
    public function run(): void
    {
        TarifParkir::create([
            'jenis_kendaraan' => 'Motor',
            'harga' => 3000,
        ]);

        TarifParkir::create([
            'jenis_kendaraan' => 'Mobil',
            'harga' => 5000,
        ]);

        TarifParkir::create([
            'jenis_kendaraan' => 'Truk',
            'harga' => 10000,
        ]);
    }
}
