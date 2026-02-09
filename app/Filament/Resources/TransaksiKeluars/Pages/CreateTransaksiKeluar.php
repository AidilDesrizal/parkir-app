<?php

namespace App\Filament\Resources\TransaksiKeluars\Pages;

use App\Filament\Resources\TransaksiKeluars\TransaksiKeluarResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;
use App\Helpers\LogHelper;

class CreateTransaksiKeluar extends CreateRecord
{
    protected static string $resource = TransaksiKeluarResource::class;

    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()
            ->label('Proses Keluar');
    }

    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()
            ->label('Proses & Input Lagi');
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
            'Transaksi keluar diproses untuk tiket: ' . $this->record->transaksi_masuk_id
        );
    }

    // ✅ TAMBAH INI
    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
