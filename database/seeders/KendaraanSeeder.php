<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kendaraan;

class KendaraanSeeder extends Seeder
{
    public function run(): void
    {
        $jenis = ['Motor','Mobil','Truk'];

        for ($i=1; $i<=20; $i++) {
            Kendaraan::create([
                'no_plat' => 'B '.rand(1000,9999).' '.chr(rand(65,90)).chr(rand(65,90)),
                'jenis_kendaraan' => $jenis[array_rand($jenis)],
            ]);
        }
    }
}
