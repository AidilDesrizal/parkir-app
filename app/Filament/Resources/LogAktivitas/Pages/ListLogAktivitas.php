<?php

namespace App\Filament\Resources\LogAktivitas\Pages;

use App\Filament\Resources\LogAktivitas\LogAktivitasResource;
use Filament\Resources\Pages\ListRecords;

class ListLogAktivitas extends ListRecords
{
    protected static string $resource = LogAktivitasResource::class;

    // ✅ Title modern
    public function getTitle(): string
    {
        return 'Audit Log Sistem';
    }

    public function getSubheading(): ?string
    {
        return 'Riwayat aktivitas pengguna dan jejak aksi sistem';
    }

    // ✅ tetap kosong — read only
    protected function getHeaderActions(): array
    {
        return [];
    }

    // ✅ Widget statistik log
    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\StatLogAktivitas::class,
        ];
    }
}
