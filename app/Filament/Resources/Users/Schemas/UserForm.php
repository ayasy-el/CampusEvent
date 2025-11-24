<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('avatar_url')
                    ->label('Avatar')
                    ->image()
                    ->disk('public')
                    ->directory('avatars')
                    ->imageEditor()
                    ->circleCropper()
                    ->maxSize(2048)
                    ->helperText('Maksimal 2MB. Format: JPG, PNG')
                    ->columnSpanFull(),

                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Masukkan nama lengkap'),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(table: User::class, column: 'email', ignoreRecord: true)
                    ->placeholder('email@example.com')
                    ->helperText('Email harus unik dan belum terdaftar'),

                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required()
                    ->minLength(8)
                    ->maxLength(255)
                    ->placeholder('Minimal 8 karakter')
                    ->revealable()
                    ->helperText('Password minimal 8 karakter'),

                TextInput::make('nrp')
                    ->label('NRP')
                    ->maxLength(20)
                    ->placeholder('Masukkan NRP'),

                TextInput::make('program_studi')
                    ->label('Program Studi')
                    ->maxLength(255)
                    ->placeholder('Contoh: Teknik Informatika'),

                TextInput::make('angkatan')
                    ->label('Angkatan')
                    ->numeric()
                    ->maxLength(4)
                    ->placeholder('Contoh: 2024'),

                TextInput::make('no_telepon')
                    ->label('No. Telepon')
                    ->tel()
                    ->maxLength(20)
                    ->placeholder('08xxxxxxxxxx'),

                TextInput::make('kota')
                    ->label('Kota')
                    ->maxLength(255)
                    ->placeholder('Masukkan nama kota'),

                Textarea::make('bio')
                    ->label('Biografi')
                    ->maxLength(65535)
                    ->rows(4)
                    ->placeholder('Tulis biografi singkat...')
                    ->columnSpanFull(),

                Select::make('role')
                    ->label('Role')
                    ->options([
                        'mahasiswa' => 'Mahasiswa',
                        'user' => 'User',
                        'moderator' => 'Moderator',
                        'admin' => 'Admin',
                    ])
                    ->required()
                    ->default('mahasiswa')
                    ->native(false),

                DateTimePicker::make('email_verified_at')
                    ->label('Email Terverifikasi')
                    ->placeholder('Pilih tanggal verifikasi')
                    ->helperText('Kosongkan jika belum terverifikasi'),
            ]);
    }
}
