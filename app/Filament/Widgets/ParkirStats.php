<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Kendaraan;
use App\Models\TransaksiKeluar;

class ParkirStats extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [

            Stat::make('Total Kendaraan', Kendaraan::count())
                ->icon('heroicon-o-truck')
                ->description('Kendaraan Terdaftar')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make(
                'Total Transaksi Selesai',
                TransaksiKeluar::count()
            )
                ->icon('heroicon-o-arrow-path')
                ->description('Transaksi Keluar')
                ->descriptionIcon('heroicon-o-document-text')
                ->color('info'),

            Stat::make(
                'Total Pemasukan',
                'Rp ' . number_format(
                    TransaksiKeluar::sum('biaya'),
                    0,
                    ',',
                    '.'
                )
            )
                ->icon('heroicon-o-banknotes')
                ->description('Pendapatan Parkir')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('warning'),

        ];
    }
}
