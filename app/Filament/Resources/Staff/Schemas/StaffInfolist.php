<?php

namespace App\Filament\Resources\Staff\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StaffInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal Information')
                    ->description('Basic details about the staff member')
                    ->schema([
                        TextEntry::make('surname'),
                        TextEntry::make('firstname'),
                        TextEntry::make('middlename')
                            ->placeholder('N/A'),
                        TextEntry::make('gender'),
                        TextEntry::make('email')
                            ->label('Email address'),
                        TextEntry::make('phone'),
                        TextEntry::make('address'),
                        TextEntry::make('marital_status'),
                        TextEntry::make('emergency_contact_details')
                            ->label('Emergency Contact Name')
                            ->formatStateUsing(fn($state) => $state['name'] ?? 'N/A')
                            ->placeholder('N/A'),
                        TextEntry::make('emergency_contact_details')
                            ->label('Emergency Contact Phone Number')
                            ->formatStateUsing(fn($state) => $state['phone'] ?? 'N/A')
                            ->placeholder('N/A'),
                        TextEntry::make('emergency_contact_details')
                            ->label('Relationship to Emergency Contact')
                            ->formatStateUsing(fn($state) => $state['relationship'] ?? 'N/A')
                            ->placeholder('N/A'),
                    ]),
                Section::make('Employment Information')
                    ->description('Details about the staff member\'s employment')
                    ->schema([
                        TextEntry::make('job_title'),
                        TextEntry::make('department'),
                        TextEntry::make('role'),
                        TextEntry::make('employment_status'),
                        TextEntry::make('employment_type'),
                        TextEntry::make('employment_date')
                            ->dateTime('M d, Y'),
                        TextEntry::make('salary')
                            ->label('Salary (NGN)')
                            ->numeric(),
                        TextEntry::make('payment_frequency'),
                        RepeatableEntry::make('account_details')
                            ->schema([
                                TextEntry::make('bank_name'),
                                TextEntry::make('account_name'),
                                TextEntry::make('account_number')
                            ])
                    ]),
            ]);
    }
}
