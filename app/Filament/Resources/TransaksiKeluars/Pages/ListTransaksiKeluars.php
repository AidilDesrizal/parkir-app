<?php

namespace App\Filament\Resources\TransaksiKeluars\Pages;

use App\Filament\Resources\TransaksiKeluars\TransaksiKeluarResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTransaksiKeluars extends ListRecords
{
    protected static string $resource = TransaksiKeluarResource::class;

    // ✅ Judul & Subjudul modern
    public function getTitle(): string
    {
        return 'Transaksi Keluar Kendaraan';
    }

    public function getSubheading(): ?string
    {
        return 'Kelola kendaraan keluar, hitung biaya, dan cetak struk';
    }

    // ✅ Header Action Premium
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Transaksi Keluar')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('danger')
                ->size('lg'),
        ];
    }

    // ✅ Widget Statistik di atas tabel
    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\StatKendaraanKeluar::class,
        ];
    }
}
