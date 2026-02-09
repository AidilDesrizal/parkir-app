<?php

namespace Database\Factories;

use App\Models\TarifParkir; // ✅ WAJIB
use Illuminate\Database\Eloquent\Factories\Factory;

class TarifParkirFactory extends Factory
{
    protected $model = TarifParkir::class; // ✅ WAJIB

    public function definition(): array
    {
        $jenis = $this->faker->randomElement(['Motor','Mobil','Truk']);

        return [
            'jenis_kendaraan' => $jenis,
            'harga' => match ($jenis) {
                'Motor' => 3000,
                'Mobil' => 5000,
                'Truk'  => 10000,
            },
        ];
    }
}
