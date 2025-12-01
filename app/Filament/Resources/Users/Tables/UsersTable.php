<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\CreateAction;
use App\Filament\Resources\Users\UserResource;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Table;
use App\Models\User;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn($query) => $query->where('role', '!=', 'admin'))
            ->heading('Mahasiswa')
            ->columns([
                ImageColumn::make('avatar_url')
                    ->label('Avatar')
                    ->circular()
                    ->defaultImageUrl(Storage::url('default-avatar.png'))
                    ->size(40),

                TextColumn::make('name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->size('sm'),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-m-envelope')
                    ->copyable()
                    ->size('sm'),

                TextColumn::make('nrp')
                    ->label('NRP')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->size('sm'),

                TextColumn::make('program_studi')
                    ->label('Program Studi')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->wrap()
                    ->limit(30)
                    ->size('sm'),

                TextColumn::make('angkatan')
                    ->label('Angkatan')
                    ->searchable()
                    ->sortable()
                    ->alignCenter()
                    ->toggleable()
                    ->size('sm'),

                TextColumn::make('no_telepon')
                    ->label('No. Telepon')
                    ->searchable()
                    ->icon('heroicon-m-phone')
                    ->toggleable()
                    ->size('sm'),

                TextColumn::make('kota')
                    ->label('Kota')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->size('sm'),

                TextColumn::make('role')
                    ->label('Role')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'admin' => 'danger',
                        'user' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => ucfirst($state))
                    ->alignCenter()
                    ->size('sm'),

                TextColumn::make('events_count')
                    ->label('Event Diikuti')
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-m-ticket')
                    ->counts('events')
                    ->alignCenter()
                    ->sortable()
                    ->size('sm'),

                TextColumn::make('email_verified_at')
                    ->label('Email Terverifikasi')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->placeholder('Belum terverifikasi')
                    ->size('sm'),

                TextColumn::make('created_at')
                    ->label('Terdaftar Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->size('sm'),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
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
                        FileUpload::make('avatar_url')
                            ->label('Avatar')
                            ->image()
                            ->directory('avatars')
                            ->imageEditor()
                            ->circleCropper()
                            ->maxSize(2048)
                            ->helperText('Maksimal 2MB. Format: JPG, PNG'),

                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Masukkan nama lengkap'),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(table: User::class, column: 'email', ignoreRecord: true)
                            ->placeholder('email@example.com'),

                        TextInput::make('nrp')
                            ->label('NRP')
                            ->maxLength(20)
                            ->placeholder('Masukkan NRP'),

                        TextInput::make('program_studi')
                            ->label('Program Studi')
                            ->maxLength(255)
                            ->placeholder('Contoh: Teknik Informatika'),

                        TextInput::make('angkatan')
                            ->label('Angkatan')
                            ->numeric()
                            ->maxLength(4)
                            ->placeholder('Contoh: 2024'),

                        TextInput::make('no_telepon')
                            ->label('No. Telepon')
                            ->tel()
                            ->maxLength(20)
                            ->placeholder('08xxxxxxxxxx'),

                        TextInput::make('kota')
                            ->label('Kota')
                            ->maxLength(255)
                            ->placeholder('Masukkan nama kota'),

                        Select::make('role')
                            ->label('Role')
                            ->options([
                                'user' => 'User',
                                'admin' => 'Admin',
                            ])
                            ->required()
                            ->default('user')
                            ->native(false),
                    ])
                    ->modalHeading('Edit Pengguna')
                    ->modalSubmitActionLabel('Simpan')
                    ->modalCancelActionLabel('Batal')
                    ->modalWidth('3xl')
                    ->successNotificationTitle('Pengguna berhasil diperbarui'),
                DeleteAction::make()
                    ->label('Hapus')
                    ->icon('heroicon-m-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Pengguna')
                    ->modalDescription('Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalCancelActionLabel('Batal')
                    ->successNotificationTitle('Pengguna berhasil dihapus'),
            ])
            ->headerActions([
                CreateAction::make('newMahasiswa')
                    ->label('New Mahasiswa')
                    ->icon('heroicon-m-user-plus')
                    ->url(fn(): string => UserResource::getUrl('create', ['role' => 'mahasiswa'])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->striped()
            ->defaultSort('created_at', 'desc');
    }
}
