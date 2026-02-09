<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\TransaksiKeluar;
use Illuminate\Support\Facades\DB;

class PemasukanChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected ?string $heading = 'Pemasukan Parkir Per Bulan';

    protected function getData(): array
    {
        $rawData = TransaksiKeluar::select(
                DB::raw('MONTH(waktu_keluar) as bulan'),
                DB::raw('SUM(biaya) as total')
            )
            ->whereNotNull('waktu_keluar')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        // isi default 0 untuk 12 bulan
        $monthlyData = array_fill(1, 12, 0);

        foreach ($rawData as $bulan => $total) {
            $monthlyData[$bulan] = $total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pemasukan (Rp)',
                    'data' => array_values($monthlyData),
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59,130,246,0.2)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => [
                'Jan','Feb','Mar','Apr','Mei','Jun',
                'Jul','Agu','Sep','Okt','Nov','Des',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
