<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    // ✅ Rename SAVE CHANGES
    protected function getSaveFormAction(): Action
    {
        return parent::getSaveFormAction()
            ->label('Update User');
    }

    // ✅ Rename CANCEL
    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('Batal');
    }

    // ✅ Rename DELETE
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus'),
        ];
    }
}
