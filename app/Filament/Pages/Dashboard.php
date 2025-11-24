<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard\Concerns\HasFiltersForm;

class Dashboard extends \Filament\Pages\Dashboard
{
    use HasFiltersForm;

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\StatsOverviewWidget::class,
            \App\Filament\Widgets\EventsChartWidget::class,
            \App\Filament\Widgets\UsersOverviewWidget::class,
            \App\Filament\Widgets\RecentEventsWidget::class,
        ];
    }
}
