<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    // ✅ Title modern
    public function getTitle(): string
    {
        return 'Manajemen Pengguna';
    }

    public function getSubheading(): ?string
    {
        return 'Kelola akun, role, dan hak akses sistem parkir';
    }

    // ✅ Header action premium
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah User')
                ->icon('heroicon-o-user-plus')
                ->color('primary')
                ->button(),
        ];
    }

    // ✅ Tambah widget statistik
    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\StatUserOverview::class,
        ];
    }
}
