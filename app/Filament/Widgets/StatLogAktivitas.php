<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\LogAktivitas;

class StatLogAktivitas extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make(
                'Total Log',
                LogAktivitas::count()
            )
                ->icon('heroicon-o-clipboard-document-list')
                ->color('primary'),

            Stat::make(
                'Hari Ini',
                LogAktivitas::whereDate('created_at', today())->count()
            )
                ->icon('heroicon-o-clock')
                ->color('warning'),

            Stat::make(
                'User Aktif',
                LogAktivitas::distinct('user_id')->count()
            )
                ->icon('heroicon-o-users')
                ->color('success'),

        ];
    }
}
