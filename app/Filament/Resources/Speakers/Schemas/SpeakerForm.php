<?php

namespace App\Filament\Resources\Speakers\Schemas;

use App\Models\Speaker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SpeakerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('photo')
                    ->label('Foto Pembicara')
                    ->image()
                    ->disk('public')
                    ->imageEditor()
                    ->circleCropper()
                    ->directory('speakers')
                    ->maxSize(2048)
                    ->helperText('Maksimal 2MB. Format: JPG, PNG')
                    ->columnSpanFull(),

                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->placeholder('Contoh: Dr. Budi Santoso, M.T.')
                    ->required()
                    ->maxLength(255)
                    ->autocomplete(false),

                TextInput::make('title')
                    ->label('Jabatan/Gelar')
                    ->placeholder('Contoh: Dosen, CEO, Professor, dll.')
                    ->maxLength(255)
                    ->autocomplete(false),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->maxLength(255)
                    ->unique(table: Speaker::class, column: 'email', ignoreRecord: true)
                    ->placeholder('email@example.com')
                    ->helperText('Email harus unik (jika diisi)'),

                TextInput::make('phone')
                    ->label('Nomor Telepon')
                    ->tel()
                    ->maxLength(20)
                    ->placeholder('08xxxxxxxxxx')
                    ->helperText('Format: 08xxxxxxxxxx'),

                RichEditor::make('bio')
                    ->label('Biografi')
                    ->placeholder('Tuliskan biografi singkat pembicara...')
                    ->maxLength(65535)
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'link',
                        'bulletList',
                        'orderedList',
                        'h2',
                        'h3',
                    ])
                    ->helperText('Tulis biografi pembicara dengan detail pengalaman, keahlian, dll.'),
            ]);
    }
}
