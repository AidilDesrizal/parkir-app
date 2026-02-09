<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\TransaksiKeluar;
use App\Models\TransaksiMasuk;
use App\Models\LogAktivitas;
use App\Models\Kendaraan;
use App\Models\AreaParkir;
use App\Models\TarifParkir;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 🔒 matikan FK sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        TransaksiKeluar::truncate();
        TransaksiMasuk::truncate();
        LogAktivitas::truncate();
        Kendaraan::truncate();
        AreaParkir::truncate();
        TarifParkir::truncate();
        User::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // =====================
        // USER (3 akun saja)
        // =====================

        User::create([
            'name' => 'Aidil',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Udin',
            'email' => 'petugas@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'petugas',
        ]);

        User::create([
            'name' => 'Budi',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'owner',
        ]);

        // =====================
        // Seeder lain
        // =====================

        $this->call([
            TarifParkirSeeder::class,
            AreaParkirSeeder::class,
            KendaraanSeeder::class,
            TransaksiMasukSeeder::class,
            TransaksiKeluarSeeder::class,
            LogAktivitasSeeder::class,
        ]);
    }
}
