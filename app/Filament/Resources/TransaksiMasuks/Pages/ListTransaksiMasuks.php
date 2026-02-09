<?php

namespace App\Filament\Resources\TransaksiMasuks\Pages;

use App\Filament\Resources\TransaksiMasuks\TransaksiMasukResource;
use Filament\Actions\CreateAction;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Resources\Pages\ListRecords;
use App\Models\TransaksiMasuk;

class ListTransaksiMasuks extends ListRecords
{
    protected static string $resource = TransaksiMasukResource::class;

    /**
     * =========================
     * 💎 HEADER ACTIONS PREMIUM
     * =========================
     */
    protected function getHeaderActions(): array
    {
        return [

            CreateAction::make()
                ->label('Transaksi Masuk Baru')
                ->icon('heroicon-o-plus-circle')
                ->color('primary')
                ->size('lg'),

            ActionGroup::make([

                Action::make('refresh')
                    ->label('Refresh Data')
                    ->icon('heroicon-o-arrow-path')
                    ->action(fn () => $this->redirect(request()->header('Referer'))),

                Action::make('aktif')
                    ->label('Total Kendaraan Aktif')
                    ->icon('heroicon-o-truck')
                    ->color('gray')
                    ->disabled()
                    ->badge(
                        TransaksiMasuk::doesntHave('keluar')->count()
                    ),

            ])
            ->label('Tools')
            ->icon('heroicon-o-wrench-screwdriver')
            ->button(),

        ];
    }

    /**
     * =========================
     * 💎 HEADER WIDGETS
     * =========================
     */
    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\StatKendaraanMasuk::class,
        ];
    }
}
