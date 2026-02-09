<?php

namespace App\Filament\Resources\AreaParkirs\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class AreaParkirsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->striped()
            ->defaultSort('nama_area')

            ->columns([

                // 📍 NAMA AREA
                TextColumn::make('nama_area')
                    ->label('Area Parkir')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('bold')
                    ->icon('heroicon-o-map-pin'),

                // 🚗 KAPASITAS
                TextColumn::make('kapasitas')
                    ->label('Kapasitas')
                    ->badge()
                    ->color('primary')
                    ->icon('heroicon-o-hashtag')
                    ->sortable(),
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
