<?php

namespace App\Filament\Resources\Users\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EventsRelationManager extends RelationManager
{
    protected static string $relationship = 'events';

    protected static ?string $title = 'Event yang Diikuti';

    protected static ?string $modelLabel = 'Event';

    protected static ?string $pluralModelLabel = 'Events';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->disk('public')
                    ->size(60)
                    ->defaultImageUrl(url('/images/placeholder.png')),

                TextColumn::make('title')
                    ->label('Judul Event')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->wrap()
                    ->limit(50),

                TextColumn::make('organizer')
                    ->label('Penyelenggara')
                    ->searchable()
                    ->limit(30)
                    ->toggleable(),

                TextColumn::make('date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('start_time')
                    ->label('Waktu')
                    ->time('H:i')
                    ->alignCenter()
                    ->toggleable(),

                TextColumn::make('location_type')
                    ->label('Tipe Lokasi')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'online' => 'info',
                        'offline' => 'success',
                        'hybrid' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => ucfirst($state))
                    ->alignCenter(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                        'cancelled' => 'danger',
                        'completed' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'cancelled' => 'Dibatalkan',
                        'completed' => 'Selesai',
                        default => ucfirst($state),
                    })
                    ->alignCenter(),

                TextColumn::make('created_at')
                    ->label('Terdaftar Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->description('Waktu user mendaftar event'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make()
                    ->label('Daftarkan ke Event')
                    ->preloadRecordSelect()
                    ->modalHeading('Daftarkan User ke Event')
                    ->modalSubmitActionLabel('Daftarkan')
                    ->successNotificationTitle('User berhasil didaftarkan ke event'),
            ])
            ->actions([
                DetachAction::make()
                    ->label('Hapus')
                    ->modalHeading('Hapus dari Event')
                    ->modalDescription('Apakah Anda yakin ingin menghapus user dari event ini?')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->successNotificationTitle('User berhasil dihapus dari event'),
            ])
            ->bulkActions([
                DetachBulkAction::make()
                    ->label('Hapus yang dipilih')
                    ->modalHeading('Hapus dari Event')
                    ->modalDescription('Apakah Anda yakin ingin menghapus user dari event yang dipilih?')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->successNotificationTitle('User berhasil dihapus dari event'),
            ])
            ->emptyStateHeading('Belum terdaftar event')
            ->emptyStateDescription('User ini belum mendaftar event apapun.')
            ->defaultSort('date', 'desc');
    }
}
