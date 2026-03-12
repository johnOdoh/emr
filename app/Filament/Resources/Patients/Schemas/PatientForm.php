<?php

namespace App\Filament\Resources\Patients\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Operation;

class PatientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make('Personal Details')
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                    ])
                    ->schema([
                        TextInput::make('name')
                            ->hiddenOn(Operation::Edit)
                            ->required(),
                        Select::make('gender')
                            ->options([
                                'Male' => 'Male',
                                'Female' => 'Female',
                            ])
                            ->required(),
                        TextInput::make('address')
                            ->required(),
                        TextInput::make('phone')
                            ->tel()
                            ->required(),
                        DateTimePicker::make('dob')
                            ->required(),
                        TextInput::make('weight')
                            ->label('Weight (kg)')
                            ->required()
                            ->numeric(),
                        TextInput::make('height')
                            ->label('Height (cm)')
                            ->required()
                            ->numeric(),
                    ]),
                Fieldset::make('Medical Information')
                    ->columns([
                        'default' => 1,
                        'md' => 2
                    ])
                    ->schema([
                        TextInput::make('spo2')
                            ->label('SpO2 (%)')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->required(),
                        Select::make('blood_group')
                            ->options([
                                'A+' => 'A+',
                                'A-' => 'A-',
                                'B+' => 'B+',
                                'B-' => 'B-',
                                'AB+' => 'AB+',
                                'AB-' => 'AB-',
                                'O+' => 'O+',
                                'O-' => 'O-',
                            ])
                            ->required(),
                        Select::make('genotype')
                            ->options([
                                'AA' => 'AA',
                                'AS' => 'AS',
                                'SS' => 'SS',
                            ])
                            ->required(),
                        // TextInput::make('allergies'),
                        TextInput::make('disability')
                            ->placeholder('blind, lame, etc.'),
                        TextInput::make('primary_diagnosis'),
                        Textarea::make('complaints'),
                        Textarea::make('medical_history')
                            ->columnSpanFull(),
                        Fieldset::make('Chronic Conditions')
                            ->schema([
                                Repeater::make('chronic_conditions')
                                    ->schema([
                                        TextInput::make('condition_name')
                                            ->required(),
                                    ])
                                    ->defaultItems(0)
                                    ->grid(2)
                                    ->columnSpanFull(),
                            ])->columnSpanFull(),
                        Fieldset::make('Known Allergies')
                            ->schema([
                                Repeater::make('allergies')
                                    ->schema([
                                        TextInput::make('allergy_name')
                                            ->required(),
                                    ])
                                    ->defaultItems(0)
                                    ->grid(2)
                                    ->columnSpanFull(),
                            ])->columnSpanFull(),
                        Fieldset::make('Medications')
                            ->schema([
                                Repeater::make('current_medications')
                                    ->schema([
                                        TextInput::make('medication_name')
                                            ->required(),
                                    ])
                                    ->defaultItems(0)
                                    ->grid(2)
                                    ->columnSpanFull(),
                            ])->columnSpanFull(),
                        FileUpload::make('lab_results')
                            ->disk('public')
                            ->directory('patients/lab_results')
                            ->visibility('public')
                            ->multiple()
                            ->maxParallelUploads(3)
                            ->moveFiles()
                            ->maxSize(5124)
                            ->acceptedFileTypes(['application/pdf']),
                    ])
            ])->columns(1);
    }
}
