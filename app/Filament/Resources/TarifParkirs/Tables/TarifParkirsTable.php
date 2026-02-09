<?php

namespace App\Filament\Resources\TarifParkirs\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class TarifParkirsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->striped()
            ->defaultSort('harga', 'desc')

            ->columns([

                // 🚗 JENIS
                TextColumn::make('jenis_kendaraan')
                    ->label('Jenis Kendaraan')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-o-truck')
                    ->weight('bold'),

                // 💰 HARGA
                TextColumn::make('harga')
                    ->label('Tarif')
                    ->money('IDR', locale: 'id')
                    ->sortable()
                    ->icon('heroicon-o-banknotes')
                    ->weight('bold'),
            ])

            ->filters([
                //
            ])

            ->recordActions([
                EditAction::make()
                    ->icon('heroicon-o-pencil-square'),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
