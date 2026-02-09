<?php

namespace App\Filament\Resources\TransaksiMasuks\Pages;

use App\Filament\Resources\TransaksiMasuks\TransaksiMasukResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;
use App\Helpers\LogHelper;

class CreateTransaksiMasuk extends CreateRecord
{
    protected static string $resource = TransaksiMasukResource::class;

    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()
            ->label('Simpan Tiket');
    }

    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()
            ->label('Simpan & Input Lagi');
    }

    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('Kembali');
    }

    protected function afterCreate(): void
    {
        LogHelper::catat(
            'CREATE',
            'Transaksi masuk dibuat dengan tiket: ' . $this->record->kode_tiket
        );
    }

    // ✅ TAMBAH INI
    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
