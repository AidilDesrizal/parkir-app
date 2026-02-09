<?php

namespace App\Filament\Resources\Kendaraans\Pages;

use App\Filament\Resources\Kendaraans\KendaraanResource;
use App\Models\LogAktivitas;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateKendaraan extends CreateRecord
{
    protected static string $resource = KendaraanResource::class;

    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()
            ->label('Simpan Kendaraan');
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
            'aksi'       => 'Tambah Data Kendaraan',
            'keterangan' => 'Menambahkan data kendaraan baru',
            'ip_address' => request()->ip(),
        ]);
    }

    // ✅ Redirect ke table setelah simpan
    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
