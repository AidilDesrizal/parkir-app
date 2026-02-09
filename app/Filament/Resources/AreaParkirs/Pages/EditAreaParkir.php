<?php

namespace App\Filament\Resources\AreaParkirs\Pages;

use App\Filament\Resources\AreaParkirs\AreaParkirResource;
use App\Models\LogAktivitas;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditAreaParkir extends EditRecord
{
    protected static string $resource = AreaParkirResource::class;

    // ✅ RENAME SAVE CHANGES
    protected function getSaveFormAction(): Action
    {
        return parent::getSaveFormAction()
            ->label('Update Area');
    }

    // ✅ RENAME CANCEL
    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('Batal');
    }

    // ✅ TOMBOL DELETE + LOG
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus') // ← sekalian rename delete
                ->after(function () {
                    LogAktivitas::create([
                        'user_id'    => auth()->id(),
                        'aksi'       => 'Hapus Area Parkir',
                        'keterangan' => 'Menghapus data area parkir',
                        'ip_address' => request()->ip(),
                    ]);
                }),
        ];
    }

    // ✅ LOG SAAT EDIT
    protected function afterSave(): void
    {
        LogAktivitas::create([
            'user_id'    => auth()->id(),
            'aksi'       => 'Edit Area Parkir',
            'keterangan' => 'Mengubah data area parkir',
            'ip_address' => request()->ip(),
        ]);
    }
}
