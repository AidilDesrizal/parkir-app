<?php

namespace App\Filament\Resources\Kendaraans\Pages;

use App\Filament\Resources\Kendaraans\KendaraanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKendaraans extends ListRecords
{
    protected static string $resource = KendaraanResource::class;

    // ✅ Title modern
    public function getTitle(): string
    {
        return 'Data Kendaraan';
    }

    public function getSubheading(): ?string
    {
        return 'Kelola data kendaraan yang terdaftar di sistem parkir';
    }

    // ✅ Tombol premium
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Kendaraan')
                ->icon('heroicon-o-truck')
                ->color('primary')
                ->size('lg'),
        ];
    }

    // ✅ Widget statistik
    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\StatKendaraan::class,
        ];
    }
}
