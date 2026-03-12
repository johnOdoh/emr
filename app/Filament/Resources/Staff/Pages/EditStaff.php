<?php

namespace App\Filament\Resources\Staff\Pages;

use App\Filament\Resources\Staff\StaffResource;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditStaff extends EditRecord
{
    protected static string $resource = StaffResource::class;

    protected function afterSave(): void
    {
        if ($this->record->employment_status === 'Terminated') {
            User::where('email', $this->record->email)
                ->update(['is_active' => false]);
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}