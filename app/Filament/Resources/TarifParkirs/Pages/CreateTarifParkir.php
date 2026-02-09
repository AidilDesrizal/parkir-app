<?php

namespace App\Filament\Resources\TarifParkirs\Pages;

use App\Filament\Resources\TarifParkirs\TarifParkirResource;
use App\Models\LogAktivitas;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateTarifParkir extends CreateRecord
{
    protected static string $resource = TarifParkirResource::class;

    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()
            ->label('Simpan Tarif');
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
            'aksi'       => 'Tambah Data Tarif Parkir',
            'keterangan' => 'Menambahkan data tarif parkir baru',
            'ip_address' => request()->ip(),
        ]);
    }

    // ✅ Redirect ke table setelah simpan
    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
