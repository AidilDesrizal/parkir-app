<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AreaParkir;

class AreaParkirSeeder extends Seeder
{
    public function run(): void
    {
        AreaParkir::insert([
            ['nama_area'=>'A','kapasitas'=>50],
            ['nama_area'=>'B','kapasitas'=>40],
            ['nama_area'=>'C','kapasitas'=>30],
        ]);
    }
}
