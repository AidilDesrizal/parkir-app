<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\TransaksiKeluar;

class StatKendaraanKeluar extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make(
                'Keluar Hari Ini',
                TransaksiKeluar::whereDate('created_at', today())->count()
            )
                ->icon('heroicon-o-arrow-up-tray')
                ->color('danger'),

            Stat::make(
                'Total Hari Ini',
                'Rp ' . number_format(
                    TransaksiKeluar::whereDate('created_at', today())->sum('biaya'),
                    0, ',', '.'
                )
            )
                ->icon('heroicon-o-banknotes')
                ->color('success'),

        ];
    }
}
