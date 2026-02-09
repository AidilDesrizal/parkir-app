<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Kendaraan;
use App\Models\TarifParkir;
use App\Models\AreaParkir;
use App\Models\User;

class TransaksiMasukFactory extends Factory
{
    public function definition(): array
    {
        $waktuMasuk = $this->faker->dateTimeBetween('-2 days', 'now');

        return [
            'kode_tiket' => 'TKT-' . strtoupper($this->faker->bothify('####??')),

            'kendaraan_id' => Kendaraan::factory(),
            'tarif_parkir_id' => TarifParkir::factory(),
            'area_parkir_id' => AreaParkir::factory(),
            'user_id' => User::factory(),

            'waktu_masuk' => $waktuMasuk,
        ];
    }
}
