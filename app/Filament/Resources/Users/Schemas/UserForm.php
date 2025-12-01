<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('avatar_url')
                    ->label('Avatar')
                    ->image()
                    ->directory('avatars')
                    ->imageEditor()
                    ->circleCropper()
                    ->maxSize(2048)
                    ->helperText('Maksimal 2MB. Format: JPG, PNG')
                    ->afterStateHydrated(
                        fn(FileUpload $component, $state, ?User $record) =>
                        $component->state($record?->getRawOriginal('avatar_url'))
                    )
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
                    ->required(fn(string $operation) => $operation === 'create')
                    ->minLength(8)
                    ->maxLength(255)
                    ->placeholder('Minimal 8 karakter')
                    ->revealable()
                    ->dehydrateStateUsing(fn($state) => filled($state) ? Hash::make($state) : null)
                    ->dehydrated(fn(string $operation) => $operation === 'create')
                    ->helperText('Password minimal 8 karakter')
                    ->hidden(fn(?User $record, string $operation) => $operation === 'edit' || $record?->role === 'admin'),

                TextInput::make('password_confirmation')
                    ->label('Konfirmasi Password')
                    ->password()
                    ->required(fn(string $operation) => $operation === 'create')
                    ->minLength(8)
                    ->same('password')
                    ->placeholder('Ulangi password')
                    ->revealable()
                    ->dehydrated(false)
                    ->helperText('Harus sama dengan password')
                    ->hidden(fn(?User $record, string $operation) => $operation === 'edit' || $record?->role === 'admin'),

                TextInput::make('nrp')
                    ->label('NRP')
                    ->maxLength(20)
                    ->unique(table: User::class, column: 'nrp', ignoreRecord: true)
                    ->placeholder('Masukkan NRP')
                    ->hidden(fn(Get $get, ?User $record, string $operation) => ($operation === 'create' && $get('role') === 'admin') || $record?->role === 'admin'),

                TextInput::make('program_studi')
                    ->label('Program Studi')
                    ->maxLength(255)
                    ->placeholder('Contoh: Teknik Informatika')
                    ->hidden(fn(Get $get, ?User $record, string $operation) => ($operation === 'create' && $get('role') === 'admin') || $record?->role === 'admin'),

                TextInput::make('angkatan')
                    ->label('Angkatan')
                    ->numeric()
                    ->maxLength(4)
                    ->placeholder('Contoh: 2024')
                    ->hidden(fn(Get $get, ?User $record, string $operation) => ($operation === 'create' && $get('role') === 'admin') || $record?->role === 'admin'),

                TextInput::make('no_telepon')
                    ->label('No. Telepon')
                    ->tel()
                    ->maxLength(20)
                    ->placeholder('08xxxxxxxxxx')
                    ->hidden(fn(Get $get, ?User $record, string $operation) => ($operation === 'create' && $get('role') === 'admin') || $record?->role === 'admin'),

                TextInput::make('kota')
                    ->label('Kota')
                    ->maxLength(255)
                    ->placeholder('Masukkan nama kota')
                    ->hidden(fn(Get $get, ?User $record, string $operation) => ($operation === 'create' && $get('role') === 'admin') || $record?->role === 'admin'),

                Textarea::make('bio')
                    ->label('Biografi')
                    ->maxLength(65535)
                    ->rows(4)
                    ->placeholder('Tulis biografi singkat...')
                    ->columnSpanFull()
                    ->hidden(fn(Get $get, ?User $record, string $operation) => ($operation === 'create' && $get('role') === 'admin') || $record?->role === 'admin'),

                Select::make('role')
                    ->label('Role')
                    ->options([
                        'mahasiswa' => 'Mahasiswa',
                        'admin' => 'Admin',
                    ])
                    ->disabled()
                    ->required()
                    ->default(fn() => request()?->query('role', 'mahasiswa') ?? 'mahasiswa')
                    ->native(false)

                // DateTimePicker::make('email_verified_at')
                //     ->label('Email Terverifikasi')
                //     ->placeholder('Pilih tanggal verifikasi')
                //     ->helperText('Kosongkan jika belum terverifikasi'),
            ]);
    }
}
