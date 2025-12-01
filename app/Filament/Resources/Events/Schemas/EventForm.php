<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Tabs::make('Event Form')
                    ->tabs([
                        // Tab 1: Info Dasar
                        Tabs\Tab::make('Informasi Dasar')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Section::make()
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('Judul Event')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state)))
                                            ->placeholder('Masukan judul event')
                                            ->columnSpan(2),

                                        TextInput::make('slug')
                                            ->label('Slug URL')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true)
                                            ->helperText('default Otomatis dari judul')
                                            ->dehydrated()
                                            ->columnSpan(1),

                                        Select::make('status')
                                            ->label('Status')
                                            ->required()
                                            ->options([
                                                'draft' => 'Draft',
                                                'published' => 'Published',
                                            ])
                                            ->default('published')
                                            ->native(false)
                                            ->columnSpan(1),

                                        TextInput::make('excerpt')
                                            ->label('Ringkasan Singkat')
                                            ->maxLength(255)
                                            ->placeholder('Masukan ringkasan singkat tentang event ini')
                                            ->columnSpanFull(),

                                        Textarea::make('description')
                                            ->label('Deskripsi Lengkap')
                                            ->required()
                                            ->rows(6)
                                            ->placeholder('Masukan deskripsi event')
                                            ->columnSpanFull(),

                                        TextInput::make('organizer')
                                            ->label('Penyelenggara')
                                            ->required()
                                            ->maxLength(255)
                                            ->placeholder('Nama organisasi atau penyelenggara')
                                            ->columnSpan(1),

                                        FileUpload::make('image')
                                            ->label('Gambar Event')
                                            ->image()
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                '16:9',
                                                '4:3',
                                            ])
                                            ->maxSize(2048)
                                            ->directory('events')
                                            ->helperText('Max 2MB, rasio 16:9 recommended')
                                            ->columnSpan(1),

                                        Textarea::make('benefits')
                                            ->label('Manfaat Mengikuti Event')
                                            ->rows(4)
                                            ->placeholder("• Benefit 1\n• Benefit 2\n• Benefit 3")
                                            ->helperText('Masukan benefit yang akan didapat peserta')
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                            ]),

                        // Tab 2: Jadwal & Agenda
                        Tabs\Tab::make('Jadwal & Agenda')
                            ->icon('heroicon-o-calendar')
                            ->schema([
                                Section::make('Waktu Pelaksanaan')
                                    ->schema([
                                        DatePicker::make('start_date')
                                            ->label('Tanggal Mulai')
                                            ->required()
                                            ->helperText('Pilih tanggal mulai event')
                                            ->native(false)
                                            ->displayFormat('d F Y')
                                            ->minDate(now())
                                            ->live()
                                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                                $endDate = $get('end_date');
                                                if ($endDate && $state && $endDate < $state) {
                                                    $set('end_date', $state);
                                                }
                                            })
                                            ->columnSpan(1),

                                        DatePicker::make('end_date')
                                            ->label('Tanggal Selesai')
                                            ->helperText('Kosongkan jika event hanya 1 hari')
                                            ->native(false)
                                            ->displayFormat('d F Y')
                                            ->minDate(fn(callable $get) => $get('start_date') ?? now())
                                            ->columnSpan(1),

                                        TimePicker::make('start_time')
                                            ->label('Waktu Mulai')
                                            ->helperText('Pilih waktu mulai event')
                                            ->required()
                                            ->native(false)
                                            ->seconds(false)
                                            ->columnSpan(1),

                                        TimePicker::make('end_time')
                                            ->label('Waktu Selesai')
                                            ->helperText('Pilih waktu selesai event')
                                            ->native(false)
                                            ->seconds(false)
                                            ->columnSpan(1),
                                    ])
                                    ->columns(2),

                                Section::make('Rundown Acara')
                                    ->description('Susun agenda acara secara detail')
                                    ->schema([
                                        Repeater::make('agenda')
                                            ->label('')
                                            ->schema([
                                                TimePicker::make('time')
                                                    ->label('Jam')
                                                    ->helperText('Pilih jam untuk agenda')
                                                    ->required()
                                                    ->native(false)
                                                    ->seconds(false)
                                                    ->columnSpan(1),

                                                TextInput::make('title')
                                                    ->label('Kegiatan')
                                                    ->helperText('Masukan nama kegiatan')
                                                    ->required()
                                                    ->columnSpan(2),

                                                Textarea::make('description')
                                                    ->label('Detail')
                                                    ->rows(2)
                                                    ->helperText('Masukan detail kegiatan')
                                                    ->columnSpanFull(),
                                            ])
                                            ->columns(3)
                                            ->defaultItems(1)
                                            ->addActionLabel('+ Tambah Agenda')
                                            ->collapsible()
                                            ->collapsed()
                                            ->cloneable()
                                            ->reorderable()
                                            ->reorderableWithButtons()
                                            ->itemLabel(
                                                fn(array $state): ?string =>
                                                isset($state['time']) && isset($state['title'])
                                                    ? ' ' . $state['time'] . ' — ' . $state['title']
                                                    : ' ' . ($state['title'] ?? 'Agenda baru')
                                            ),
                                    ]),
                            ]),

                        // Tab 3: Lokasi & Biaya
                        Tabs\Tab::make('Lokasi & Biaya')
                            ->icon('heroicon-o-map-pin')
                            ->schema([
                                Section::make('Lokasi Pelaksanaan')
                                    ->schema([
                                        Radio::make('location_type')
                                            ->label('Tipe Lokasi')
                                            ->required()
                                            ->options([
                                                'offline' => 'Offline (Tatap Muka)',
                                                'online' => 'Online (Virtual)',
                                                'hybrid' => 'Hybrid (Offline + Online)',
                                            ])
                                            ->default('online')
                                            ->inline()
                                            ->helperText('Pilih tipe lokasi event')
                                            ->columnSpanFull(),

                                        TextInput::make('location_address')
                                            ->label('Alamat / Link Meeting')
                                            ->maxLength(255)
                                            ->placeholder('Gedung ABC Lt. 3 atau https://meet.google.com/xxx')
                                            ->helperText('Untuk online: masukkan link Zoom/Google Meet/Teams')
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(1),

                                Section::make('Kuota & Biaya')
                                    ->schema([
                                        TextInput::make('quota')
                                            ->label('Kuota Peserta')
                                            ->required()
                                            ->numeric()
                                            ->minValue(0)
                                            ->default(100)
                                            ->suffix('peserta')
                                            ->helperText('Kosongkan atau isi 0 untuk unlimited')
                                            ->columnSpan(1),

                                        TextInput::make('price')
                                            ->label('Harga Tiket')
                                            ->required()
                                            ->numeric()
                                            ->minValue(0)
                                            ->default(0)
                                            ->prefix('Rp')
                                            ->helperText('Isi 0 untuk event gratis')
                                            ->columnSpan(1),
                                    ])
                                    ->columns(2),

                                Section::make('Kontak Person')
                                    ->description('Kontak yang dapat dihubungi peserta')
                                    ->schema([
                                        TextInput::make('contact_email')
                                            ->label('Email')
                                            ->email()
                                            ->maxLength(255)
                                            ->placeholder('contact@event.com')
                                            ->helperText('Masukkan email yang dapat dihubungi peserta')
                                            ->columnSpan(1),

                                        TextInput::make('contact_phone')
                                            ->label('Nomor Telepon')
                                            ->tel()
                                            ->maxLength(20)
                                            ->placeholder('08123456789')
                                            ->helperText('Masukkan nomor telepon yang dapat dihubungi peserta')
                                            ->columnSpan(1),
                                    ])
                                    ->columns(2),
                            ]),

                        // Tab 4: Kategori & Pembicara
                        Tabs\Tab::make('Kategori & Pembicara')
                            ->icon('heroicon-o-user-group')
                            ->schema([
                                Section::make('Kategori Event')
                                    ->description('Pilih kategori yang sesuai untuk event ini')
                                    ->schema([
                                        Select::make('categories')
                                            ->label('Kategori')
                                            ->relationship('categories', 'name')
                                            ->multiple()
                                            ->preload()
                                            ->searchable()
                                            ->createOptionForm([
                                                TextInput::make('name')
                                                    ->label('Nama Kategori')
                                                    ->required()
                                                    ->unique()
                                                    ->placeholder('Contoh: Workshop, Seminar, Webinar'),
                                            ])
                                            ->helperText('Bisa pilih lebih dari satu kategori'),
                                    ]),

                                Section::make('Narasumber / Pembicara')
                                    ->description('Tambahkan pembicara untuk event ini')
                                    ->schema([
                                        Select::make('speakers')
                                            ->label('Pembicara')
                                            ->relationship('speakers', 'name')
                                            ->multiple()
                                            ->preload()
                                            ->searchable()
                                            ->helperText('Pilih satu atau lebih pembicara'),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
            ]);
    }
}
