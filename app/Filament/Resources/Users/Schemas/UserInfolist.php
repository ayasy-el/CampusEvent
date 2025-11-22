<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('avatar_url')
                    ->label('Avatar')
                    ->circular()
                    ->defaultImageUrl(url('/images/default-avatar.png'))
                    ->size(120),

                TextEntry::make('name')
                    ->label('Nama Lengkap')
                    ->icon('heroicon-m-user')
                    ->weight('bold')
                    ->color('primary'),

                TextEntry::make('email')
                    ->label('Email')
                    ->icon('heroicon-m-envelope')
                    ->copyable()
                    ->copyMessage('Email disalin!')
                    ->color('info'),

                TextEntry::make('role')
                    ->label('Role')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'admin' => 'danger',
                        'moderator' => 'warning',
                        'mahasiswa' => 'success',
                        'user' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'admin' => 'Admin',
                        'moderator' => 'Moderator',
                        'mahasiswa' => 'Mahasiswa',
                        'user' => 'User',
                        default => ucfirst($state),
                    })
                    ->icon('heroicon-m-shield-check'),

                TextEntry::make('email_verified_at')
                    ->label('Status Email')
                    ->badge()
                    ->formatStateUsing(fn($state): string => $state ? 'Terverifikasi ✓' : 'Belum Terverifikasi')
                    ->color(fn($state): string => $state ? 'success' : 'warning')
                    ->dateTime('d M Y H:i')
                    ->placeholder('Belum Terverifikasi'),

                TextEntry::make('nrp')
                    ->label('NRP')
                    ->placeholder('-')
                    ->copyable()
                    ->icon('heroicon-m-identification'),

                TextEntry::make('program_studi')
                    ->label('Program Studi')
                    ->placeholder('-')
                    ->icon('heroicon-m-book-open'),

                TextEntry::make('angkatan')
                    ->label('Angkatan')
                    ->placeholder('-')
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-m-calendar'),

                TextEntry::make('no_telepon')
                    ->label('No. Telepon')
                    ->placeholder('-')
                    ->copyable()
                    ->icon('heroicon-m-phone')
                    ->url(fn($state): ?string => $state ? "tel:{$state}" : null),

                TextEntry::make('kota')
                    ->label('Kota')
                    ->placeholder('-')
                    ->icon('heroicon-m-map-pin'),

                TextEntry::make('bio')
                    ->label('Biografi')
                    ->placeholder('Belum ada biografi')
                    ->markdown()
                    ->columnSpanFull(),

                TextEntry::make('created_at')
                    ->label('Terdaftar Pada')
                    ->dateTime('d M Y, H:i')
                    ->icon('heroicon-m-calendar-days')
                    ->color('success'),

                TextEntry::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->icon('heroicon-m-clock')
                    ->color('warning'),
            ])
            ->columns(2);
    }
}
