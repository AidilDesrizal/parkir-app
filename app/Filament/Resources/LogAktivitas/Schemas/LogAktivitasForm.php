<?php

namespace App\Filament\Resources\LogAktivitas\Schemas;

use Filament\Schemas\Schema;

class LogAktivitasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Log aktivitas dibuat otomatis oleh sistem
                // Tidak ada form input manual
            ]);
    }
}