<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\TransaksiKeluar;

class TotalPemasukan extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $total = TransaksiKeluar::sum('biaya');

        return [
            Stat::make(
                'Total Uang Masuk',
                'Rp ' . number_format($total ?? 0, 0, ',', '.')
            )
                ->description('Akumulasi semua transaksi keluar')
                ->color('success'),
        ];
    }

    public static function canView(): bool
    {
        return request()->routeIs('filament.admin.pages.rekap-transaksi');
    }
}
