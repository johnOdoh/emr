<?php

namespace App\Filament\Widgets;

use App\Models\Staff;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StaffStatWidget extends StatsOverviewWidget
{
    protected array|string|int $columnSpan = 1;
    protected function getStats(): array
    {
        return [
            Stat::make('Staff Count', Staff::count())
                ->color('success'),
        ];
    }

    public static function canView(): bool
    {
        return auth()->user()->can('viewAny', Staff::class);
    }
}
