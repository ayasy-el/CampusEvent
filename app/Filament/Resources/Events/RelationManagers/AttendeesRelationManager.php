<?php

namespace App\Filament\Resources\Events\RelationManagers;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\AttachAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AttendeesRelationManager extends RelationManager
{
    protected static string $relationship = 'attendees';

    protected static ?string $relatedResource = UserResource::class;

    protected static ?string $title = 'Peserta Event';

    protected static ?string $modelLabel = 'Peserta';

    protected static ?string $pluralModelLabel = 'Peserta';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar_url')
                    ->label('Avatar')
                    ->disk('public')
                    ->circular()
                    ->defaultImageUrl(url('/images/default-avatar.png'))
                    ->size(40),

                TextColumn::make('name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->wrap(),

                TextColumn::make('nrp')
                    ->label('NRP')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->icon('heroicon-m-identification'),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->icon('heroicon-m-envelope')
                    ->copyable()
                    ->toggleable(),

                TextColumn::make('program_studi')
                    ->label('Program Studi')
                    ->searchable()
                    ->wrap()
                    ->limit(30),

                TextColumn::make('angkatan')
                    ->label('Angkatan')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->alignCenter(),

                TextColumn::make('no_telepon')
                    ->label('No. Telepon')
                    ->searchable()
                    ->icon('heroicon-m-phone')
                    ->toggleable(),

                TextColumn::make('pivot.created_at')
                    ->label('Terdaftar Pada')
                    ->dateTime('d M Y H:i')
                    ->description('Waktu peserta mendaftar')
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make()
                    ->label('Tambah Peserta')
                    ->preloadRecordSelect()
                    ->modalHeading('Tambah Peserta Event')
                    ->modalSubmitActionLabel('Tambah')
                    ->modalWidth('md')
                    ->color('success'),
            ])
            ->recordActions([
                DetachAction::make()
                    ->label('Hapus')
                    ->modalHeading('Hapus Peserta dari Event')
                    ->modalSubmitActionLabel('Hapus')
                    ->color('danger'),
            ])
            ->bulkActions([
                DetachBulkAction::make()
                    ->label('Hapus Peserta Terpilih')
                    ->modalHeading('Hapus Peserta dari Event')
                    ->modalSubmitActionLabel('Hapus')
                    ->color('danger'),
            ])
            ->defaultSort('name', 'asc')
            ->emptyStateHeading('Belum ada peserta')
            ->emptyStateDescription('Tambahkan peserta untuk event ini menggunakan tombol di atas.')
            ->emptyStateIcon('heroicon-o-users');
    }
}
