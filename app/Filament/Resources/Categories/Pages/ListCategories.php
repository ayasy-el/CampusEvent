<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use App\Models\Category;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Kategori')
                ->icon('heroicon-m-plus')
                ->form([
                    TextInput::make('name')
                        ->label('Nama Kategori')
                        ->required()
                        ->maxLength(255)
                        ->unique(table: Category::class, column: 'name')
                        ->placeholder('Contoh: Seminar, Workshop, Webinar, dll.')
                        ->helperText('Nama kategori harus unik')
                        ->autocomplete(false),
                ])
                ->modalHeading('Tambah Kategori Baru')
                ->modalSubmitActionLabel('Simpan')
                ->modalCancelActionLabel('Batal')
                ->modalWidth('md')
                ->successNotificationTitle('Kategori berhasil ditambahkan')
                ->createAnother(false),
        ];
    }
}
