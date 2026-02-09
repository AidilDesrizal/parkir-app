<?php

namespace App\Filament\Resources\AreaParkirs\Pages;

use App\Filament\Resources\AreaParkirs\AreaParkirResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAreaParkirs extends ListRecords
{
    protected static string $resource = AreaParkirResource::class;

    // ✅ Judul premium
    public function getTitle(): string
    {
        return 'Manajemen Area Parkir';
    }

    public function getSubheading(): ?string
    {
        return 'Kelola zona, kapasitas, dan struktur area parkir';
    }

    // ✅ Tombol modern
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Area')
                ->icon('heroicon-o-map-pin')
                ->color('primary')
                ->size('lg'),
        ];
    }

    // ✅ Widget statistik
    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\StatAreaParkir::class,
        ];
    }
}
