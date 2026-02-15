<?php

namespace App\Filament\Resources\Patients\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;

class PatientInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal Information')
                    ->description('Basic details about the patient')
                    ->schema([
                        TextEntry::make('patient_code'),
                        TextEntry::make('name'),
                        TextEntry::make('gender'),
                        TextEntry::make('address'),
                        TextEntry::make('phone'),
                        TextEntry::make('dob')
                            ->dateTime('M d, Y'),
                        TextEntry::make('age')
                            ->suffix(' years')
                            ->getStateUsing(fn ($record) => round($record->dob->diffInYears(now()))),
                        TextEntry::make('weight')
                            ->label('Weight (kg)')
                            ->numeric(),
                        TextEntry::make('height')
                            ->label('Height (cm)')
                            ->numeric(),
                    ]),
                Section::make('Medical Information')
                    ->description('Patient\'s medical details and history')
                    ->schema([
                        TextEntry::make('spo2'),
                        TextEntry::make('blood_group'),
                        TextEntry::make('genotype'),
                        TextEntry::make('disability')
                            ->placeholder('N/A'),
                        TextEntry::make('primary_diagnosis')
                            ->placeholder('-'),
                        TextEntry::make('complaints')
                            ->placeholder('-'),
                        TextEntry::make('medical_history')
                            ->placeholder('-'),
                        TextEntry::make('chronic_conditions')
                            ->placeholder('-')
                            ->label('Chronic Conditions')
                            ->formatStateUsing(function ($state) {
                                return collect($state)
                                    ->implode(', ');
                            }),
                        TextEntry::make('allergies')
                            ->placeholder('-')
                            ->label('Allergies')
                            ->formatStateUsing(function ($state) {
                                return collect($state)
                                    ->implode(', ');
                            }),
                        TextEntry::make('current_medications')
                            ->placeholder('-')
                            ->label('Current Medications')
                            ->formatStateUsing(function ($state) {
                                return collect($state)
                                    ->implode(', ');
                            }),
                        TextEntry::make('created_at')
                            ->dateTime('M d, Y h:i A')
                            ->label('Date Registered'),
                    ]),
            ]);
    }
}