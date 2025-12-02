<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use App\Models\User;
use App\Models\Category;
use App\Models\Speaker;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverviewWidget extends BaseWidget
{
    protected static bool $isLazy = false;

    protected function getStats(): array
    {
        $totalEvents = Event::count();
        $today = now()->toDateString();
        $upcomingEvents = Event::where('start_date', '>', $today)->count();
        $ongoingEvents = Event::where('start_date', '<=', $today)
            ->where(function ($q) use ($today) {
                $q->whereNull('end_date')
                    ->orWhere('end_date', '>=', $today);
            })
            ->count();
        $completedEvents = Event::where(function ($q) use ($today) {
            $q->where('end_date', '<', $today)
                ->orWhere(function ($q2) use ($today) {
                    $q2->whereNull('end_date')
                        ->where('start_date', '<', $today);
                });
        })->count();

        $totalUsers = User::count();
        $newUsersThisMonth = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $totalCategories = Category::count();
        $totalSpeakers = Speaker::count();

        $totalRegistrations = DB::table('events_user')->count();

        return [
            Stat::make('Total Event', $totalEvents)
                ->description('Semua event')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary')
                ->chart([7, 12, 15, 10, 18, 22, $totalEvents]),

            Stat::make('Event Mendatang', $upcomingEvents)
                ->description('Belum dimulai')
                ->descriptionIcon('heroicon-m-clock')
                ->color('info'),

            Stat::make('Event Berlangsung', $ongoingEvents)
                ->description('Sedang berjalan')
                ->descriptionIcon('heroicon-m-play')
                ->color('warning'),

            Stat::make('Event Selesai', $completedEvents)
                ->description('Sudah berakhir')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Total Pengguna', $totalUsers)
                ->description($newUsersThisMonth . ' pengguna baru bulan ini')
                ->descriptionIcon('heroicon-m-users')
                ->color('success')
                ->chart([50, 55, 60, 65, 70, 75, $totalUsers]),

            Stat::make('Total Registrasi', $totalRegistrations)
                ->description('Pendaftaran event')
                ->descriptionIcon('heroicon-m-ticket')
                ->color('info'),

            Stat::make('Kategori', $totalCategories)
                ->description('Total kategori event')
                ->descriptionIcon('heroicon-m-tag')
                ->color('warning'),

            Stat::make('Pembicara', $totalSpeakers)
                ->description('Total pembicara')
                ->descriptionIcon('heroicon-m-microphone')
                ->color('danger'),
        ];
    }

    protected function getColumns(): int
    {
        return 4;
    }
}
