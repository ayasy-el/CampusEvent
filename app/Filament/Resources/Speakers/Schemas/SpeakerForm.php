<?php

namespace App\Filament\Resources\Speakers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
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
                    ->columnSpanFull(),

                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->placeholder('Contoh: Dr. Budi Santoso, M.T.')
                    ->required()
                    ->maxLength(255)
                    ->autocomplete(false),

                TextInput::make('title')
                    ->label('Jabatan/Gelar')
                    ->placeholder('Contoh: Dosen Universitas Indonesia')
                    ->maxLength(255)
                    ->autocomplete(false),

                MarkdownEditor::make('bio')
                    ->label('Biografi')
                    ->placeholder('Tuliskan biografi singkat pembicara...')
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'bulletList',
                        'orderedList',
                    ]),
            ]);
    }
}
