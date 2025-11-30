<?php

namespace App\Filament\Resources\Events\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->circular()
                    ->size(40)
                    ->defaultImageUrl(url('/images/placeholder.png'))
                    ->grow(false),
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->lineClamp(2)
                    ->grow()
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return $state;
                    }),
                TextColumn::make('organizer')
                    ->label('Penyelenggara')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->limit(20)
                    ->toggleable(),
                TextColumn::make('date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable()
                    ->alignCenter()
                    ->grow(false),
                TextColumn::make('start_time')
                    ->label('Waktu')
                    ->time('H:i')
                    ->sortable()
                    ->alignCenter()
                    ->grow(false)
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
                    ->sortable()
                    ->alignCenter()
                    ->grow(false),
                TextColumn::make('quota')
                    ->label('Kuota')
                    ->numeric()
                    ->sortable()
                    ->alignCenter()
                    ->grow(false)
                    ->toggleable(),
                TextColumn::make('attendees_count')
                    ->label('Peserta')
                    ->counts('attendees')
                    ->badge()
                    ->color('success')
                    ->icon('heroicon-o-users')
                    ->sortable()
                    ->alignCenter()
                    ->grow(false)
                    ->tooltip(function ($record): string {
                        $count = $record->attendees_count ?? 0;
                        $quota = $record->quota ?? 0;
                        if ($quota > 0) {
                            $percentage = round(($count / $quota) * 100);
                            return "{$count} dari {$quota} peserta ({$percentage}%)";
                        }
                        return "{$count} peserta terdaftar";
                    }),
                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable()
                    ->alignEnd()
                    ->grow(false)
                    ->toggleable(),
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
                    ->sortable()
                    ->alignCenter()
                    ->grow(false),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('excerpt')
                    ->label('Kutipan')
                    ->searchable()
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('location_address')
                    ->label('Alamat Lokasi')
                    ->searchable()
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('contact_email')
                    ->label('Email Kontak')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('contact_phone')
                    ->label('No. Telepon')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('date', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100]);
    }
}
