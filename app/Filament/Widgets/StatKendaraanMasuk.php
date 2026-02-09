<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\TransaksiMasuk;

class StatKendaraanMasuk extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make(
                'Masuk Hari Ini',
                TransaksiMasuk::whereDate('created_at', today())->count()
            )
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success'),

            Stat::make(
                'Sedang Parkir',
                TransaksiMasuk::doesntHave('keluar')->count()
            )
                ->icon('heroicon-o-truck')
                ->color('warning'),

        ];
    }
}
