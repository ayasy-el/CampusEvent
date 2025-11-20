<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('nrp'),
                TextInput::make('program_studi'),
                TextInput::make('angkatan'),
                TextInput::make('no_telepon')
                    ->tel(),
                TextInput::make('kota'),
                Textarea::make('bio')
                    ->columnSpanFull(),
                TextInput::make('role')
                    ->required()
                    ->default('mahasiswa'),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->required(),
            ]);
    }
}
