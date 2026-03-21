<?php

namespace App\Filament\Widgets;

use App\Models\Record;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RecordStatWidget extends StatsOverviewWidget
{
    protected array|string|int $columnSpan = 1;
    protected function getStats(): array
    {
        return [
            Stat::make('Record Count', Record::count())
                ->color('success'),
        ];
    }

    public static function canView(): bool
    {
        return auth()->user()->can('create', Record::class);
    }
}
