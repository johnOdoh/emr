<?php

namespace App\Filament\Resources\Patients\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

class PatientInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal Information')
                    ->description('Basic details about the patient')
                    ->collapsible()
                    ->schema([
                        TextEntry::make('patient_code'),
                        TextEntry::make('name'),
                        TextEntry::make('gender')->badge(),
                        TextEntry::make('address'),
                        TextEntry::make('phone'),
                        TextEntry::make('dob')
                            ->dateTime('M d, Y'),
                        TextEntry::make('age')
                            ->suffix(' years')
                            ->getStateUsing(fn($record) => round($record->dob->diffInYears(now()))),
                        TextEntry::make('weight')
                            ->label('Weight (kg)')
                            ->numeric(),
                        TextEntry::make('height')
                            ->label('Height (cm)')
                            ->numeric(),
                        TextEntry::make('created_at')
                            ->dateTime('M d, Y h:i A')
                            ->label('Date Registered'),
                    ]),
                Section::make('Medical Information')
                    ->description('Patient\'s medical details and history')
                    ->collapsible()
                    ->schema([
                        TextEntry::make('spo2')
                            ->label('SpO2 (%)')
                            ->numeric(),
                        TextEntry::make('blood_group'),
                        TextEntry::make('genotype'),
                        TextEntry::make('disability')
                            ->placeholder('N/A'),
                        TextEntry::make('primary_diagnosis')
                            ->placeholder('N/A'),
                        TextEntry::make('complaints')
                            ->placeholder('N/A'),
                        TextEntry::make('medical_history')
                            ->placeholder('N/A'),
                        TextEntry::make('chronic_conditions')
                            ->placeholder('N/A')
                            ->label('Chronic Conditions')
                            ->formatStateUsing(function ($state) {
                                return collect($state)
                                    ->implode(', ');
                            }),
                        TextEntry::make('allergies')
                            ->placeholder('N/A')
                            ->label('Allergies')
                            ->formatStateUsing(function ($state) {
                                return collect($state)
                                    ->implode(', ');
                            }),
                        TextEntry::make('current_medications')
                            ->placeholder('N/A')
                            ->label('Current Medications')
                            ->formatStateUsing(function ($state) {
                                return collect($state)
                                    ->implode(', ');
                            }),
                        TextEntry::make('lab_results')
                            ->label('Lab Results')
                            ->placeholder('N/A')
                            ->color('primary')
                            ->formatStateUsing(function ($state) {
                                return collect($state)
                                    ->map(fn($url) => '<a href="' . Storage::url($url) . '" target="_blank" class="text-blue-600 underline">' . 'View file' . '</a>')
                                    ->implode(' | ');
                            })
                            ->html(),
                    ]),
            ]);
    }
}