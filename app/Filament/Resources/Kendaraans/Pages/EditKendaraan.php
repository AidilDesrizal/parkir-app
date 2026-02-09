<?php

namespace App\Filament\Resources\Kendaraans\Pages;

use App\Filament\Resources\Kendaraans\KendaraanResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use App\Models\LogAktivitas;

class EditKendaraan extends EditRecord
{
    protected static string $resource = KendaraanResource::class;

    // ✅ Rename SAVE CHANGES
    protected function getSaveFormAction(): Action
    {
        return parent::getSaveFormAction()
            ->label('Update Kendaraan');
    }

    // ✅ Rename CANCEL
    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('Batal');
    }

    // ✅ Delete + rename + log
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus')
                ->after(function () {
                    LogAktivitas::create([
                        'user_id'    => auth()->id(),
                        'aksi'       => 'Hapus Data Kendaraan',
                        'keterangan' => 'Menghapus data kendaraan',
                        'ip_address' => request()->ip(),
                    ]);
                }),
        ];
    }

    // ✅ Log saat edit
    protected function afterSave(): void
    {
        LogAktivitas::create([
            'user_id'    => auth()->id(),
            'aksi'       => 'Edit Data Kendaraan',
            'keterangan' => 'Mengubah data kendaraan',
            'ip_address' => request()->ip(),
        ]);
    }
}
