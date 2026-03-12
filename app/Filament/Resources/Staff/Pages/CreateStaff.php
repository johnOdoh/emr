<?php

namespace App\Filament\Resources\Staff\Pages;

use App\Enums\UserRole;
use App\Filament\Resources\Staff\StaffResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;

class CreateStaff extends CreateRecord
{
    protected static string $resource = StaffResource::class;

    protected function afterCreate(): void
    {
        if (!in_array($this->record->role, UserRole::toArray())) return;
        if (User::where('email', $this->record->email)->exists()) return;
        User::create([
            'name' => $this->record->fullname,
            'email' => $this->record->email,
            'role' => $this->record->role,
            'password' => bcrypt($this->record->email),
        ]);
    }
}