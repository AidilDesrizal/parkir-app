<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class LogAktivitasFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'aksi' => $this->faker->randomElement(['create','update','delete','login']),
            'keterangan' => $this->faker->sentence(),
            'ip_address' => $this->faker->ipv4(),
        ];
    }
}
