<?php

namespace App\Filament\Widgets;

use App\Models\Patient;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PatientStatWidget extends StatsOverviewWidget
{
    protected array|string|int $columnSpan = 1;
    protected function getStats(): array
    {
        return [
            Stat::make('Patient Count', Patient::count())
                ->color('success'),
        ];
    }

    public static function canView(): bool
    {
        return auth()->user()->can('viewAny', Patient::class);
    }
}
