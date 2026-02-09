<?php

namespace App\Filament\Resources\TransaksiKeluars\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;

class TransaksiKeluarsTable
{
    public static function configure(Table $table): Table
    {
        return $table

            ->striped()
            ->defaultSort('waktu_keluar', 'desc')

            // ✅ preload relasi
            ->modifyQueryUsing(fn ($query) =>
                $query->with([
                    'masuk.kendaraan',
                    'masuk.areaParkir',
                    'masuk.tarifParkir',
                ])
            )

            ->columns([

                // 🚗 PLAT
                TextColumn::make('masuk.kendaraan.no_plat')
                    ->label('Plat')
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->placeholder('-'),

                // 🚙 JENIS
                TextColumn::make('masuk.kendaraan.jenis_kendaraan')
                    ->label('Jenis')
                    ->badge()
                    ->color('success')
                    ->placeholder('-'),

                // 🎫 KODE TIKET
                TextColumn::make('masuk.kode_tiket')
                    ->label('Kode Tiket')
                    ->searchable()
                    ->copyable()
                    ->weight('bold')
                    ->icon('heroicon-o-ticket')
                    ->placeholder('-'),

                // 📍 AREA
                TextColumn::make('masuk.areaParkir.nama_area')
                    ->label('Area')
                    ->badge()
                    ->color('warning')
                    ->placeholder('-'),

                // ⏰ MASUK
                TextColumn::make('masuk.waktu_masuk')
                    ->label('Masuk')
                    ->dateTime('d M Y • H:i')
                    ->icon('heroicon-o-arrow-down-circle'),

                // 🚪 KELUAR
                TextColumn::make('waktu_keluar')
                    ->label('Keluar')
                    ->dateTime('d M Y • H:i')
                    ->icon('heroicon-o-arrow-up-circle'),

                // 🕒 DURASI
                TextColumn::make('durasi_menit')
                    ->label('Durasi')
                    ->badge()
                    ->color('primary')
                    ->formatStateUsing(fn ($state) =>
                        $state ? ceil($state / 60) . ' jam' : '-'
                    ),

                // 💰 BIAYA
                TextColumn::make('biaya')
                    ->label('Biaya')
                    ->money('IDR', locale: 'id')
                    ->sortable()
                    ->icon('heroicon-o-banknotes')
                    ->weight('bold'),

                // 🗓 DIBUAT
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->since(),
            ])

            ->recordActions([

                EditAction::make()
                    ->icon('heroicon-o-pencil-square'),

                Action::make('cetak')
                    ->label('Cetak Struk')
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    ->url(fn ($record) =>
                        route('transaksi.cetak', $record->id)
                    )
                    ->openUrlInNewTab(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
