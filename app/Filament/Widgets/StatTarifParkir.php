<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\TarifParkir;

class StatTarifParkir extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make(
                'Total Tarif',
                TarifParkir::count()
            )
                ->icon('heroicon-o-currency-dollar')
                ->color('primary')
                ->description('Jenis tarif terdaftar'),

            Stat::make(
                'Tarif Termahal',
                'Rp ' . number_format(
                    TarifParkir::max('harga') ?? 0,
                    0, ',', '.'
                )
            )
                ->icon('heroicon-o-arrow-trending-up')
                ->color('danger')
                ->description('Harga tertinggi'),

            Stat::make(
                'Tarif Termurah',
                'Rp ' . number_format(
                    TarifParkir::min('harga') ?? 0,
                    0, ',', '.'
                )
            )
                ->icon('heroicon-o-arrow-trending-down')
                ->color('success')
                ->description('Harga terendah'),

        ];
    }
}
