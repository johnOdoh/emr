<?php

namespace App\Filament\Resources\Patients\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
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
                TextInput::make('weight')
                    ->required()
                    ->numeric(),
                TextInput::make('height')
                    ->required()
                    ->numeric(),
                TextInput::make('spo2')
                    ->required(),
                TextInput::make('blood_group')
                    ->required(),
                TextInput::make('genotype')
                    ->required(),
                TextInput::make('allergies'),
                TextInput::make('chronic_conditions'),
                TextInput::make('disability'),
                TextInput::make('current_medications'),
                TextInput::make('primary_diagnosis'),
                TextInput::make('secondary_diagnosis'),
                Textarea::make('complaints')
                    ->columnSpanFull(),
                TextInput::make('prescriptions'),
                DateTimePicker::make('dob')
                    ->required(),
            ]);
    }
}
