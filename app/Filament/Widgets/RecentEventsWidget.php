<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentEventsWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Event::query()
                    ->with(['categories', 'speakers'])
                    ->withCount('attendees')
                    ->latest()
                    ->limit(5)
            )
            ->heading('Event Terbaru')
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->size(60)
                    ->circular(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Event')
                    ->searchable()
                    ->sortable()
                    ->limit(40)
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('categories.name')
                    ->label('Kategori')
                    ->badge()
                    ->color('info')
                    ->separator(','),

                Tables\Columns\TextColumn::make('speakers.name')
                    ->label('Pembicara')
                    ->icon('heroicon-m-user')
                    ->separator(',')
                    ->limit(30),

                Tables\Columns\TextColumn::make('date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('start_time')
                    ->label('Waktu Mulai')
                    ->time('H:i'),

                Tables\Columns\TextColumn::make('location_address')
                    ->label('Lokasi')
                    ->icon('heroicon-m-map-pin')
                    ->limit(30)
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('attendees_count')
                    ->label('Peserta')
                    ->badge()
                    ->color('success')
                    ->icon('heroicon-m-users')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'published' => 'Published',
                        'draft' => 'Draft',
                        default => ucfirst($state),
                    }),
            ]);
    }
}
