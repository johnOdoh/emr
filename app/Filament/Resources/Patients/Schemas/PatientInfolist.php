<?php

namespace App\Filament\Resources\Patients\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PatientInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('patient_code'),
                TextEntry::make('name'),
                TextEntry::make('gender'),
                TextEntry::make('address'),
                TextEntry::make('phone'),
                TextEntry::make('weight')
                    ->numeric(),
                TextEntry::make('height')
                    ->numeric(),
                TextEntry::make('spo2'),
                TextEntry::make('blood_group'),
                TextEntry::make('genotype'),
                TextEntry::make('disability')
                    ->placeholder('-'),
                TextEntry::make('primary_diagnosis')
                    ->placeholder('-'),
                TextEntry::make('secondary_diagnosis')
                    ->placeholder('-'),
                TextEntry::make('complaints')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('dob')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
