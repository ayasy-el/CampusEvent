<?php

namespace App\Filament\Resources\Speakers\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SpeakerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('photo')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(url('/images/default-avatar.png'))
                    ->size(120),

                TextEntry::make('name')
                    ->label('Nama Lengkap')
                    ->size('lg')
                    ->weight('bold'),

                TextEntry::make('title')
                    ->label('Jabatan/Gelar')
                    ->placeholder('Belum diisi'),

                TextEntry::make('bio')
                    ->label('Biografi')
                    ->placeholder('Belum diisi')
                    ->columnSpanFull()
                    ->markdown(),

                TextEntry::make('events_count')
                    ->label('Total Event')
                    ->default(0)
                    ->badge()
                    ->color('primary'),

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
