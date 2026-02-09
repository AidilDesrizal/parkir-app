<?php

namespace App\Filament\Resources\Kendaraans\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class KendaraansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->striped()
            ->defaultSort('no_plat')

            ->columns([

                // 🚗 PLAT
                TextColumn::make('no_plat')
                    ->label('Nomor Plat')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('bold')
                    ->icon('heroicon-o-identification'),

                // 🚙 JENIS
                TextColumn::make('jenis_kendaraan')
                    ->label('Jenis')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'Motor' => 'success',
                        'Mobil' => 'info',
                        default => 'gray',
                    })
                    ->icon('heroicon-o-truck')
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
