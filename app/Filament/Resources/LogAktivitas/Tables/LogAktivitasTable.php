<?php

namespace App\Filament\Resources\LogAktivitas\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class LogAktivitasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->striped()
            ->defaultSort('created_at', 'desc')

            ->columns([

                // 👤 PETUGAS
                TextColumn::make('user.name')
                    ->label('Petugas')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-user')
                    ->weight('bold')
                    ->placeholder('-'),

                // ⚡ AKSI
                TextColumn::make('aksi')
                    ->label('Aksi')
                    ->searchable()
                    ->badge()
                    ->icon('heroicon-o-bolt')
                    ->color(fn ($state) => match (strtolower($state)) {
                        'login' => 'success',
                        'logout' => 'gray',
                        'create', 'tambah' => 'info',
                        'update', 'edit' => 'warning',
                        'delete', 'hapus' => 'danger',
                        default => 'primary',
                    }),

                // 📝 KETERANGAN
                TextColumn::make('keterangan')
                    ->label('Detail Aktivitas')
                    ->limit(60)
                    ->wrap()
                    ->tooltip(fn ($record) => $record->keterangan)
                    ->icon('heroicon-o-document-text'),

                // 🌐 IP
                TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->toggleable()
                    ->copyable()
                    ->icon('heroicon-o-globe-alt')
                    ->color('gray'),

                // 🕒 WAKTU
                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d M Y H:i')
                    ->since() // tampil "5 menit lalu"
                    ->sortable()
                    ->icon('heroicon-o-clock'),
            ])

            ->filters([
                // nanti bisa tambah filter aksi / petugas
            ])

            // 🔒 read only audit log
            ->recordActions([])

            ->toolbarActions([]);
    }
}
