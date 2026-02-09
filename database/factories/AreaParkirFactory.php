<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AreaParkirFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama_area' => 'Area '.$this->faker->randomLetter(),
            'kapasitas' => $this->faker->numberBetween(10, 50),
        ];
    }
}
