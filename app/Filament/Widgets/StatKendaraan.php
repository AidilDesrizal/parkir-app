<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Kendaraan;

class StatKendaraan extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make(
                'Total Kendaraan',
                Kendaraan::count()
            )
                ->description('Semua kendaraan terdaftar')
                ->icon('heroicon-o-truck')
                ->color('primary'),

            Stat::make(
                'Motor',
                Kendaraan::where('jenis_kendaraan', 'Motor')->count()
            )
                ->description('Kendaraan roda dua')
                ->icon('heroicon-o-bolt')
                ->color('success'),

            Stat::make(
                'Mobil',
                Kendaraan::where('jenis_kendaraan', 'Mobil')->count()
            )
                ->description('Kendaraan roda empat')
                ->icon('heroicon-o-truck') // ✅ ganti dari car
                ->color('warning'),

        ];
    }
}
