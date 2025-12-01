<?php

namespace App\Filament\Resources\Users\Widgets;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class AdminUsersTable extends TableWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static string $resource = UserResource::class;

    protected static bool $isLazy = false;


    public function table(Table $table): Table
    {
        return $table
            ->query(fn(): Builder => User::query()->where('role', 'admin'))
            ->heading('Admin')
            ->recordUrl(fn(User $record): string => UserResource::getUrl('view', ['record' => $record]))
            ->columns([
                ImageColumn::make('avatar_url')
                    ->label('Avatar')
                    ->circular()
                    ->defaultImageUrl(url('/images/default-avatar.png'))
                    ->size(48),
                TextColumn::make('name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),
                TextColumn::make('email')
                    ->label('Email')
                    ->icon('heroicon-m-envelope')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                TextColumn::make('role')
                    ->label('Role')
                    ->badge()
                    ->sortable()
                    ->formatStateUsing(fn(string $state) => ucfirst($state))
                    ->color(fn(string $state): string => match ($state) {
                        'admin' => 'danger',
                        'mahasiswa' => 'success',
                        default => 'gray',
                    })
                    ->alignCenter(),
            ])
            ->headerActions([
                CreateAction::make('newAdmin')
                    ->label('New Admin')
                    ->icon('heroicon-m-shield-check')
                    ->color('primary')
                    ->url(fn(): string => UserResource::getUrl('create', ['role' => 'admin'])),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Lihat')
                    ->icon('heroicon-m-eye')
                    ->color('info')
                    ->url(fn(User $record): string => UserResource::getUrl('view', ['record' => $record])),
                EditAction::make()
                    ->label('Edit')
                    ->icon('heroicon-m-pencil-square')
                    ->color('primary')
                    ->url(fn(User $record): string => UserResource::getUrl('edit', ['record' => $record])),
                DeleteAction::make()
                    ->label('Hapus')
                    ->icon('heroicon-m-trash')
                    ->color('danger'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])

            ->paginated([10, 25, 50])
            ->defaultSort('name');
    }
}
