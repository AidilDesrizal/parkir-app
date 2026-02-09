<?php

namespace App\Filament\Resources\TransaksiKeluars\Pages;

use App\Filament\Resources\TransaksiKeluars\TransaksiKeluarResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use App\Helpers\LogHelper;

class EditTransaksiKeluar extends EditRecord
{
    protected static string $resource = TransaksiKeluarResource::class;

    // ✅ Rename tombol save
    protected function getSaveFormAction(): Action
    {
        return parent::getSaveFormAction()
            ->label('Update Transaksi');
    }

    // ✅ Rename cancel
    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('Kembali');
    }

    // ✅ Tombol delete + log
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus Transaksi')
                ->after(function () {
                    LogHelper::catat(
                        'DELETE',
                        'Hapus transaksi keluar ID: ' . $this->record->id
                    );
                }),
        ];
    }

    // ✅ Log setelah edit
    protected function afterSave(): void
    {
        LogHelper::catat(
            'UPDATE',
            'Edit transaksi keluar ID: ' . $this->record->id
        );
    }
}
