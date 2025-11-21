<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Nama Kategori')
                    ->size('lg')
                    ->weight('bold'),

                TextEntry::make('events_count')
                    ->label('Jumlah Event')
                    ->default(0)
                    ->badge()
                    ->color('success'),

                TextEntry::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y, H:i')
                    ->placeholder('-'),

                TextEntry::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime('d M Y, H:i')
                    ->placeholder('-'),
            ]);
    }
}
