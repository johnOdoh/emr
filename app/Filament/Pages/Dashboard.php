<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\WelcomeWidget::class,
            \App\Filament\Widgets\StaffStatWidget::class,
            \App\Filament\Widgets\PatientStatWidget::class,
            \App\Filament\Widgets\RecordStatWidget::class,
        ];
    }
}