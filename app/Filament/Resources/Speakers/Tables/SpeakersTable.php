<?php

namespace App\Filament\Resources\Speakers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SpeakersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(url('/images/default-avatar.png'))
                    ->size(50),

                TextColumn::make('name')
                    ->label('Nama Pembicara')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->size('sm'),

                TextColumn::make('title')
                    ->label('Jabatan/Gelar')
                    ->searchable()
                    ->sortable()
                    ->default('Belum diisi')
                    ->placeholder('Belum diisi')
                    ->size('sm'),

                TextColumn::make('events_count')
                    ->label('Jumlah Event')
                    ->counts('events')
                    ->sortable()
                    ->alignCenter()
                    ->badge()
                    ->color('primary'),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->size('sm'),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->size('sm'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Lihat')
                    ->icon('heroicon-m-eye')
                    ->color('info'),
                EditAction::make()
                    ->label('Edit')
                    ->icon('heroicon-m-pencil-square')
                    ->color('primary')
                    ->form([
                        FileUpload::make('photo')
                            ->label('Foto')
                            ->image()
                            ->directory('speakers')
                            ->imageEditor()
                            ->circleCropper()
                            ->maxSize(2048)
                            ->helperText('Maksimal 2MB. Format: JPG, PNG'),

                        TextInput::make('name')
                            ->label('Nama Pembicara')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Masukkan nama pembicara'),

                        TextInput::make('title')
                            ->label('Jabatan/Gelar')
                            ->maxLength(255)
                            ->placeholder('Contoh: CEO, Professor, Dr., dll.'),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255)
                            ->placeholder('email@example.com'),

                        TextInput::make('phone')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->maxLength(20)
                            ->placeholder('08xxxxxxxxxx'),

                        RichEditor::make('bio')
                            ->label('Biografi')
                            ->maxLength(65535)
                            ->columnSpanFull()
                            ->placeholder('Tulis biografi pembicara...'),
                    ])
                    ->modalHeading('Edit Pembicara')
                    ->modalSubmitActionLabel('Simpan')
                    ->modalCancelActionLabel('Batal')
                    ->modalWidth('3xl')
                    ->successNotificationTitle('Pembicara berhasil diperbarui'),
                DeleteAction::make()
                    ->label('Hapus')
                    ->icon('heroicon-m-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Pembicara')
                    ->modalDescription('Apakah Anda yakin ingin menghapus pembicara ini?')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalCancelActionLabel('Batal')
                    ->successNotificationTitle('Pembicara berhasil dihapus'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->striped()
            ->defaultSort('name', 'asc');
    }
}
