<?php

namespace App\Filament\Resources\TarifParkirs\Pages;

use App\Filament\Resources\TarifParkirs\TarifParkirResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use App\Models\LogAktivitas;

class EditTarifParkir extends EditRecord
{
    protected static string $resource = TarifParkirResource::class;

    // ✅ Rename SAVE CHANGES
    protected function getSaveFormAction(): Action
    {
        return parent::getSaveFormAction()
            ->label('Update Tarif');
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
                        'aksi'       => 'Hapus Tarif Parkir',
                        'keterangan' => 'Menghapus data tarif parkir',
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
            'aksi'       => 'Edit Tarif Parkir',
            'keterangan' => 'Mengubah data tarif parkir',
            'ip_address' => request()->ip(),
        ]);
    }
}
