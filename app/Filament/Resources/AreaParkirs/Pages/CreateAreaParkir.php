<?php

namespace App\Filament\Resources\AreaParkirs\Pages;

use App\Filament\Resources\AreaParkirs\AreaParkirResource;
use App\Models\LogAktivitas;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateAreaParkir extends CreateRecord
{
    protected static string $resource = AreaParkirResource::class;

    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()
            ->label('Simpan Area');
    }

    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()
            ->label('Simpan & Tambah Lagi');
    }

    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('Batal');
    }

    protected function afterCreate(): void
    {
        LogAktivitas::create([
            'user_id'    => auth()->id(),
            'aksi'       => 'Tambah Area Parkir',
            'keterangan' => 'Menambahkan area parkir baru',
            'ip_address' => request()->ip(),
        ]);
    }

    // ✅ Redirect ke table setelah simpan
    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
