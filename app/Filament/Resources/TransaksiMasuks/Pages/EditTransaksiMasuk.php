<?php

namespace App\Filament\Resources\TransaksiMasuks\Pages;

use App\Filament\Resources\TransaksiMasuks\TransaksiMasukResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use App\Helpers\LogHelper;

class EditTransaksiMasuk extends EditRecord
{
    protected static string $resource = TransaksiMasukResource::class;

    // ✅ Rename tombol save
    protected function getSaveFormAction(): Action
    {
        return parent::getSaveFormAction()
            ->label('Update Tiket');
    }

    // ✅ Rename cancel
    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('Kembali');
    }

    // ✅ Tambah tombol DELETE
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus Tiket')
                ->after(function () {
                    LogHelper::catat(
                        'DELETE',
                        'Hapus transaksi masuk tiket: ' . $this->record->kode_tiket
                    );
                }),
        ];
    }

    // ✅ Log setelah edit
    protected function afterSave(): void
    {
        LogHelper::catat(
            'UPDATE',
            'Edit transaksi masuk tiket: ' . $this->record->kode_tiket
        );
    }
}
