<?php

namespace App\Filament\Resources\Staff\Pages;

use App\Enums\UserRole;
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
        $user = User::where('email', $this->record->email)->first();
        if ($this->record->employment_status === 'Terminated') {
            $user->is_active = false;
        }
        if (!in_array($this->record->department->value, UserRole::toArray())) {
            $user->is_active = false;
        } else {
            $user->is_active = true;
            $user->role = $this->record->department;
        }
        $user->save();
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
