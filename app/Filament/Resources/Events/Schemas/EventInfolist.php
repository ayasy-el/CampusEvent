<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;

class EventInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Header Section dengan Gambar dan Info Utama
                Section::make()
                    ->schema([
                        Flex::make([
                            ImageEntry::make('image')
                                ->label('Gambar Event')
                                ->defaultImageUrl(url('/images/placeholder.png'))
                                ->height(300)
                                ->grow(false),

                            Group::make([
                                TextEntry::make('title')
                                    ->label('Judul Event')
                                    ->weight(FontWeight::Bold)
                                    ->icon('heroicon-o-calendar')
                                    ->columnSpanFull(),

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
                                    ->icon('heroicon-o-building-office-2')
                                    ->weight(FontWeight::Medium),

                                TextEntry::make('excerpt')
                                    ->label('Kutipan')
                                    ->placeholder('Tidak ada kutipan')
                                    ->color('gray')
                                    ->columnSpanFull(),
                            ])
                                ->grow(true),
                        ]),
                    ])
                    ->columnSpan('full'),                // Informasi Waktu & Lokasi
                Section::make('Waktu & Lokasi')
                    ->icon('heroicon-o-clock')
                    ->description('Detail waktu dan tempat pelaksanaan event')
                    ->schema([
                        TextEntry::make('date')
                            ->label('Tanggal')
                            ->date('l, d F Y')
                            ->icon('heroicon-o-calendar-days')
                            ->weight(FontWeight::SemiBold)
                            ->color('primary'),

                        Group::make([
                            TextEntry::make('start_time')
                                ->label('Waktu Mulai')
                                ->time('H:i')
                                ->icon('heroicon-o-clock'),

                            TextEntry::make('end_time')
                                ->label('Waktu Selesai')
                                ->time('H:i')
                                ->placeholder('Belum ditentukan')
                                ->icon('heroicon-o-clock'),
                        ])->columns(2),

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
                            ->icon('heroicon-o-map-pin'),
                    ])
                    ->collapsible(),

                // Informasi Peserta & Harga
                Section::make('Kuota & Harga')
                    ->icon('heroicon-o-ticket')
                    ->description('Detail kuota peserta dan harga tiket')
                    ->schema([
                        Group::make([
                            TextEntry::make('quota')
                                ->label('Kuota Peserta')
                                ->numeric()
                                ->icon('heroicon-o-users')
                                ->weight(FontWeight::Bold)
                                ->color('success')
                                ->suffix(' peserta'),

                            TextEntry::make('price')
                                ->label('Harga Tiket')
                                ->money('IDR')
                                ->icon('heroicon-o-banknotes')
                                ->weight(FontWeight::Bold)
                                ->color('warning'),
                        ])->columns(2),
                    ])
                    ->collapsible(),

                // Deskripsi Event
                Section::make('Deskripsi Event')
                    ->icon('heroicon-o-document-text')
                    ->description('Informasi lengkap tentang event')
                    ->schema([
                        TextEntry::make('description')
                            ->label('')
                            ->placeholder('Tidak ada deskripsi')
                            ->markdown()
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(false),

                // Benefit
                Section::make('Benefit Peserta')
                    ->icon('heroicon-o-gift')
                    ->description('Manfaat yang akan didapatkan peserta')
                    ->schema([
                        TextEntry::make('benefits')
                            ->label('')
                            ->placeholder('Tidak ada benefit')
                            ->markdown()
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(),

                // Informasi Kontak
                Section::make('Informasi Kontak')
                    ->icon('heroicon-o-phone')
                    ->description('Hubungi penyelenggara untuk informasi lebih lanjut')
                    ->schema([
                        Group::make([
                            TextEntry::make('contact_email')
                                ->label('Email Kontak')
                                ->placeholder('Tidak ada email')
                                ->icon('heroicon-o-envelope')
                                ->copyable()
                                ->copyMessage('Email disalin!')
                                ->url(fn($state) => $state ? "mailto:{$state}" : null),

                            TextEntry::make('contact_phone')
                                ->label('No. Telepon')
                                ->placeholder('Tidak ada nomor telepon')
                                ->icon('heroicon-o-phone')
                                ->copyable()
                                ->copyMessage('Nomor telepon disalin!')
                                ->url(fn($state) => $state ? "tel:{$state}" : null),
                        ])->columns(2),
                    ])
                    ->collapsible(),

                // Informasi Teknis
                Section::make('Informasi Teknis')
                    ->icon('heroicon-o-cog')
                    ->description('Data teknis dan metadata event')
                    ->schema([
                        TextEntry::make('slug')
                            ->label('Slug URL')
                            ->icon('heroicon-o-link')
                            ->copyable()
                            ->copyMessage('Slug disalin!')
                            ->color('gray'),

                        Group::make([
                            TextEntry::make('created_at')
                                ->label('Dibuat Pada')
                                ->dateTime('d F Y, H:i')
                                ->icon('heroicon-o-plus-circle')
                                ->color('gray'),

                            TextEntry::make('updated_at')
                                ->label('Diperbarui Pada')
                                ->dateTime('d F Y, H:i')
                                ->icon('heroicon-o-arrow-path')
                                ->color('gray'),
                        ])->columns(2),
                    ])
                    ->collapsible()
                    ->collapsed(),
            ]);
    }
}
