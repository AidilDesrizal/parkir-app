<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\AreaParkir;

class StatAreaParkir extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make(
                'Total Area',
                AreaParkir::count()
            )
                ->icon('heroicon-o-map')
                ->color('primary'),

            Stat::make(
                'Total Kapasitas',
                AreaParkir::sum('kapasitas')
            )
                ->icon('heroicon-o-square-3-stack-3d')
                ->color('success'),

        ];
    }
}
