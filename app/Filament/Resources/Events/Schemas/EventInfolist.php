<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EventInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('image')
                    ->label('Gambar Event')
                    ->defaultImageUrl(url('/images/placeholder.png'))
                    ->columnSpanFull(),

                TextEntry::make('title')
                    ->label('Judul Event')
                    ->icon('heroicon-o-calendar')
                    ->columnSpanFull(),

                TextEntry::make('slug')
                    ->label('Slug')
                    ->icon('heroicon-o-link')
                    ->copyable()
                    ->copyMessage('Slug disalin!')
                    ->color('gray'),

                TextEntry::make('status')
                    ->label('Status')
                    ->badge()
                    ->icon('heroicon-o-flag')
                    ->color(fn(string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                        'cancelled' => 'danger',
                        'completed' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'draft' => 'Draft',
                        'published' => 'Terbit',
                        'cancelled' => 'Dibatalkan',
                        'completed' => 'Selesai',
                        default => ucfirst($state),
                    }),

                TextEntry::make('organizer')
                    ->label('Penyelenggara')
                    ->icon('heroicon-o-building-office-2'),

                TextEntry::make('excerpt')
                    ->label('Kutipan')
                    ->placeholder('Tidak ada kutipan')
                    ->columnSpanFull(),

                TextEntry::make('description')
                    ->label('Deskripsi')
                    ->placeholder('Tidak ada deskripsi')
                    ->markdown()
                    ->columnSpanFull(),

                TextEntry::make('date')
                    ->label('Tanggal')
                    ->date('l, d F Y')
                    ->icon('heroicon-o-calendar-days'),

                TextEntry::make('start_time')
                    ->label('Waktu Mulai')
                    ->time('H:i')
                    ->icon('heroicon-o-clock'),

                TextEntry::make('end_time')
                    ->label('Waktu Selesai')
                    ->time('H:i')
                    ->placeholder('Belum ditentukan')
                    ->icon('heroicon-o-clock'),

                TextEntry::make('location_type')
                    ->label('Tipe Lokasi')
                    ->badge()
                    ->icon('heroicon-o-map')
                    ->color(fn(string $state): string => match ($state) {
                        'online' => 'info',
                        'offline' => 'success',
                        'hybrid' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => ucfirst($state)),

                TextEntry::make('location_address')
                    ->label('Alamat Lokasi')
                    ->placeholder('Tidak ada alamat')
                    ->icon('heroicon-o-map-pin')
                    ->columnSpanFull(),

                TextEntry::make('quota')
                    ->label('Kuota Peserta')
                    ->numeric()
                    ->icon('heroicon-o-users'),

                TextEntry::make('price')
                    ->label('Harga Tiket')
                    ->money('IDR')
                    ->icon('heroicon-o-banknotes'),

                TextEntry::make('benefits')
                    ->label('Benefit untuk Peserta')
                    ->placeholder('Tidak ada benefit')
                    ->markdown()
                    ->columnSpanFull(),

                TextEntry::make('contact_email')
                    ->label('Email Kontak')
                    ->placeholder('Tidak ada email')
                    ->icon('heroicon-o-envelope')
                    ->copyable()
                    ->copyMessage('Email disalin!'),

                TextEntry::make('contact_phone')
                    ->label('No. Telepon')
                    ->placeholder('Tidak ada nomor telepon')
                    ->icon('heroicon-o-phone')
                    ->copyable()
                    ->copyMessage('Nomor telepon disalin!'),

                TextEntry::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d F Y, H:i')
                    ->icon('heroicon-o-plus-circle'),

                TextEntry::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime('d F Y, H:i')
                    ->icon('heroicon-o-arrow-path'),
            ])
            ->columns(2);
    }
}
