<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;

class StatUserOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make(
                'Total User',
                User::count()
            )
                ->icon('heroicon-o-users')
                ->color('primary'),

            Stat::make(
                'Owner',
                User::where('role', 'owner')->count()
            )
                ->icon('heroicon-o-shield-check')
                ->color('success'),

            Stat::make(
                'Petugas',
                User::where('role', 'petugas')->count()
            )
                ->icon('heroicon-o-identification')
                ->color('warning'),

        ];
    }
}
