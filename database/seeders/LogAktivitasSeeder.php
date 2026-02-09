<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LogAktivitas;
use App\Models\User;

class LogAktivitasSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach (range(1,20) as $i) {
            LogAktivitas::create([
                'user_id' => $users->random()->id,
                'aksi' => 'create',
                'keterangan' => 'Input transaksi parkir',
                'ip_address' => '127.0.0.1',
            ]);
        }
    }
}

