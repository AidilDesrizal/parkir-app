<?php

namespace App\Filament\Pages;

use BackedEnum;
use UnitEnum;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RekapTransaksiExport;
use App\Models\TransaksiKeluar;
use Illuminate\Support\Facades\Auth;

class RekapTransaksi extends Page implements HasTable
{
    use InteractsWithTable;

    /* =========================
       🎨 NAVIGATION PREMIUM
    ========================== */

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';

    protected static string|UnitEnum|null $navigationGroup = 'Laporan & Analitik';

    protected static ?string $navigationLabel = 'Rekap Transaksi';

    protected static ?string $title = 'Dashboard Rekap Transaksi';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return TransaksiKeluar::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }

    /**
     * 🔐 Navigation → hanya Owner
     */
    public static function shouldRegisterNavigation(): bool
    {
        return Auth::check() && Auth::user()->role === 'owner';
    }

    /**
     * 🔐 Guard akses halaman langsung
     */
    public function mount(): void
    {
        if (!Auth::check() || Auth::user()->role !== 'owner') {
            abort(403);
        }
    }

    public function getView(): string
    {
        return 'filament.pages.rekap-transaksi';
    }

    /* =========================
       📊 WIDGET
    ========================== */

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\TotalPemasukan::class,
        ];
    }

    /* =========================
       🚀 HEADER ACTIONS MODERN
    ========================== */

    protected function getHeaderActions(): array
    {
        return [

            ActionGroup::make([

                Action::make('exportPdf')
                    ->label('Export PDF')
                    ->icon('heroicon-o-document')
                    ->color('danger')
                    ->action(function () {
                        $data = $this->getFilteredTableQuery()->get();

                        $pdf = Pdf::loadView('pdf.rekap-transaksi', [
                            'transaksi' => $data,
                        ])->setPaper('a4', 'landscape');

                        return response()->streamDownload(
                            fn () => print($pdf->output()),
                            'rekap-transaksi.pdf'
                        );
                    }),

                Action::make('exportExcel')
                    ->label('Export Excel')
                    ->icon('heroicon-o-table-cells')
                    ->color('success')
                    ->action(function () {
                        $data = $this->getFilteredTableQuery()->get();

                        return Excel::download(
                            new RekapTransaksiExport($data),
                            'rekap-transaksi.xlsx'
                        );
                    }),

                Action::make('print')
                    ->label('Cetak Laporan')
                    ->icon('heroicon-o-printer')
                    ->color('gray')
                    ->url(fn () => route('rekap.transaksi.print', [
                        'dari' => request('tableFilters.tanggal.dari'),
                        'sampai' => request('tableFilters.tanggal.sampai'),
                    ]), true),

            ])
            ->label('Export & Cetak')
            ->icon('heroicon-o-arrow-down-tray')
            ->color('primary')
            ->button(),

        ];
    }

    /* =========================
       🧠 QUERY
    ========================== */

    protected function getTableQuery(): Builder
    {
        return TransaksiKeluar::query()
            ->with([
                'masuk.kendaraan',
                'masuk.areaParkir',
                'masuk.tarifParkir',
            ])
            ->latest();
    }

    /* =========================
       📋 COLUMNS PREMIUM
    ========================== */

    protected function getTableColumns(): array
    {
        return [

            Tables\Columns\TextColumn::make('no')
                ->label('#')
                ->rowIndex(),

            Tables\Columns\TextColumn::make('masuk.kendaraan.no_plat')
                ->label('Plat Nomor')
                ->searchable()
                ->badge()
                ->color('primary'),

            Tables\Columns\TextColumn::make('masuk.areaParkir.nama_area')
                ->label('Area')
                ->badge()
                ->color('gray'),

            Tables\Columns\TextColumn::make('masuk.kendaraan.jenis_kendaraan')
                ->label('Jenis')
                ->badge()
                ->color('info'),

            Tables\Columns\TextColumn::make('durasi_menit')
                ->label('Durasi Parkir')
                ->formatStateUsing(function ($state) {
                    if (!$state) return '-';

                    $jam = floor($state / 60);
                    $menit = $state % 60;

                    return "{$jam}j {$menit}m";
                })
                ->sortable(),

            Tables\Columns\TextColumn::make('biaya')
                ->label('Total Bayar')
                ->money('IDR', locale: 'id')
                ->sortable()
                ->weight('bold'),

            Tables\Columns\TextColumn::make('waktu_keluar')
                ->label('Waktu Keluar')
                ->dateTime('d M Y • H:i')
                ->sortable(),

        ];
    }

    /* =========================
       🎯 FILTER MODERN
    ========================== */

    protected function getTableFilters(): array
    {
        return [

            Tables\Filters\Filter::make('tanggal')
                ->label('Filter Tanggal')
                ->form([
                    \Filament\Forms\Components\DatePicker::make('dari')
                        ->label('Dari Tanggal'),

                    \Filament\Forms\Components\DatePicker::make('sampai')
                        ->label('Sampai Tanggal'),
                ])
                ->query(function (Builder $query, array $data) {
                    return $query
                        ->when(
                            $data['dari'] ?? null,
                            fn ($q) => $q->whereDate('created_at', '>=', $data['dari'])
                        )
                        ->when(
                            $data['sampai'] ?? null,
                            fn ($q) => $q->whereDate('created_at', '<=', $data['sampai'])
                        );
                }),

        ];
    }
}
