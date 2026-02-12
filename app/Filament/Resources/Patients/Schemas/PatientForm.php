<?php

namespace App\Filament\Resources\Patients\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PatientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('patient_code')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('gender')
                    ->required(),
                TextInput::make('address')
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                DateTimePicker::make('dob')
                    ->required(),
            ]);
    }
}
