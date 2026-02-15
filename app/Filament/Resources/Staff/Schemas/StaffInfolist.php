<?php

namespace App\Filament\Resources\Staff\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class StaffInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('surname'),
                TextEntry::make('firstname'),
                TextEntry::make('middlename')
                    ->placeholder('-'),
                TextEntry::make('marital_status'),
                TextEntry::make('gender'),
                TextEntry::make('phone'),
                TextEntry::make('address'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('job_title'),
                TextEntry::make('department'),
                TextEntry::make('employment_status'),
                TextEntry::make('employment_type'),
                TextEntry::make('salary')
                    ->numeric(),
                TextEntry::make('payment_frequency'),
                TextEntry::make('employment_date')
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
