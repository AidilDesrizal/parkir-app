<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KendaraanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'no_plat' => strtoupper($this->faker->bothify('B #### ??')),
            'jenis_kendaraan' => $this->faker->randomElement(['Motor','Mobil']),
        ];
    }
}
