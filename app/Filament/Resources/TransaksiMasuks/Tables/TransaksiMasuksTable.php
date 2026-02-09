<?php

namespace App\Filament\Resources\TransaksiMasuks\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;

class TransaksiMasuksTable
{
    public static function configure(Table $table): Table
    {
        return $table

            ->striped()
            ->defaultSort('waktu_masuk', 'desc')

            ->modifyQueryUsing(fn ($query) =>
                $query->with([
                    'kendaraan',
                    'areaParkir',
                    'tarifParkir',
                    'user',
                    'keluar',
                ])
            )

            ->columns([

                // 🎫 KODE TIKET
                TextColumn::make('kode_tiket')
                    ->label('Kode Tiket')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('bold')
                    ->icon('heroicon-o-ticket'),

                // 🚗 PLAT
                TextColumn::make('kendaraan.no_plat')
                    ->label('Plat')
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->default('-'),

                // 🚙 JENIS
                TextColumn::make('kendaraan.jenis_kendaraan')
                    ->label('Jenis')
                    ->badge()
                    ->color('success')
                    ->default('-'),

                // 📍 AREA
                TextColumn::make('areaParkir.nama_area')
                    ->label('Area')
                    ->badge()
                    ->color('warning')
                    ->default('-'),

                // 💰 TARIF
                TextColumn::make('tarifParkir.jenis_kendaraan')
                    ->label('Tarif')
                    ->badge()
                    ->color('primary')
                    ->default('-'),

                // 👤 PETUGAS
                TextColumn::make('user.name')
                    ->label('Petugas')
                    ->icon('heroicon-o-user')
                    ->default('-'),

                // ⏰ MASUK
                TextColumn::make('waktu_masuk')
                    ->label('Masuk')
                    ->dateTime('d M Y • H:i')
                    ->sortable()
                    ->icon('heroicon-o-arrow-down-circle'),

                // 🚪 KELUAR — STATUS STYLE
                TextColumn::make('keluar.waktu_keluar')
                    ->label('Keluar')
                    ->dateTime('d M Y • H:i')
                    ->badge()
                    ->color(fn ($state) => $state ? 'danger' : 'gray')
                    ->formatStateUsing(fn ($state) => $state ? $state : 'Masih Parkir'),

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
