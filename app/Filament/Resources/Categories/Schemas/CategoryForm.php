<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Models\Category;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Kategori')
                    ->placeholder('Contoh: Seminar, Workshop, Webinar, dll.')
                    ->required()
                    ->maxLength(255)
                    ->unique(table: Category::class, column: 'name', ignoreRecord: true)
                    ->autocomplete(false)
                    ->helperText('Nama kategori harus unik'),
            ]);
    }
}
