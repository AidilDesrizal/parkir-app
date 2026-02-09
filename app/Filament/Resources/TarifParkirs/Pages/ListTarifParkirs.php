<?php

namespace App\Filament\Resources\TarifParkirs\Pages;

use App\Filament\Resources\TarifParkirs\TarifParkirResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTarifParkirs extends ListRecords
{
    protected static string $resource = TarifParkirResource::class;

    // ✅ Title modern
    public function getTitle(): string
    {
        return 'Manajemen Tarif Parkir';
    }

    public function getSubheading(): ?string
    {
        return 'Kelola struktur tarif berdasarkan jenis kendaraan dan durasi';
    }

    // ✅ Header action premium
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Tarif')
                ->icon('heroicon-o-plus-circle')
                ->color('success')
                ->button(),
        ];
    }

    // ✅ Widget statistik tarif
    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\StatTarifParkir::class,
        ];
    }
}
