<?php

namespace App\Filament\Resources\Staff\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StaffForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('surname')
                    ->required(),
                TextInput::make('firstname')
                    ->required(),
                TextInput::make('middlename'),
                TextInput::make('marital_status')
                    ->required(),
                TextInput::make('gender')
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                TextInput::make('address')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('emergency_contact_details')
                    ->required(),
                TextInput::make('job_title')
                    ->required(),
                TextInput::make('department')
                    ->required(),
                TextInput::make('employment_status')
                    ->required(),
                TextInput::make('employment_type')
                    ->required(),
                TextInput::make('salary')
                    ->required()
                    ->numeric(),
                TextInput::make('account_details'),
                TextInput::make('payment_frequency')
                    ->required()
                    ->default('Monthly'),
                DateTimePicker::make('employment_date')
                    ->required(),
            ]);
    }
}
