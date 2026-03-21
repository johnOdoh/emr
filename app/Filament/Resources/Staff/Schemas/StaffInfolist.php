<?php

namespace App\Filament\Resources\Staff\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\RepeatableEntry\TableColumn;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Joaopaulolndev\FilamentPdfViewer\Infolists\Components\PdfViewerEntry;

class StaffInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns([
                'default' => 1,
                'md' => 2,
                'lg' => 2,
            ])
            ->components([
                Section::make('Personal Information')
                    ->description('Basic details about the staff member')
                    ->collapsible()
                    ->schema([
                        TextEntry::make('fullname')
                            ->label('Name'),
                        TextEntry::make('email')
                            ->label('Email address'),
                        TextEntry::make('phone')
                            ->label('Phone Number'),
                        TextEntry::make('address'),
                        TextEntry::make('gender')
                            ->color('primary')
                            ->badge(),
                        TextEntry::make('marital_status')
                            ->color('primary')
                            ->badge(),
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
                            ->placeholder('N/A')
                            ->color('warning')
                            ->badge(),
                        TextEntry::make('cv')
                            ->label('CV')
                            ->formatStateUsing(fn($state) => $state ? 'View CV' : 'No file')
                            ->url(fn($state) => $state ? Storage::url($state) : 'N/A', true)
                            ->color('primary'),
                        TextEntry::make('id_document')
                            ->label('ID')
                            ->formatStateUsing(fn($state) => $state ? 'View ID Document' : 'No file')
                            ->url(fn($state) => $state ? Storage::url($state) : 'N/A', true)
                            ->color('primary'),
                        // PdfViewerEntry::make(name: 'cv')
                        //     ->label('View the PDF')
                        //     ->minHeight('40svh')
                        //     ->disk('public'),
                    ]),
                Section::make('Employment Information')
                    ->description('Details about the staff member\'s employment')
                    ->collapsible()
                    ->schema([
                        TextEntry::make('job_title'),
                        TextEntry::make('department'),
                        TextEntry::make('employment_status')
                            ->color(fn($state) => match ($state) {
                                'Active'   => 'success',
                                'On Leave' => 'warning',
                                'Terminated'  => 'danger'
                            })
                            ->badge(),
                        TextEntry::make('employment_type')
                            ->color('primary')
                            ->badge(),
                        TextEntry::make('employment_date')
                            ->dateTime('M d, Y'),
                        TextEntry::make('salary')
                            ->label('Salary (NGN)')
                            ->numeric()
                            ->color('success')
                            ->badge(),
                        TextEntry::make('payment_frequency')
                            ->color('primary')
                            ->badge(),
                        RepeatableEntry::make('account_details')
                            ->schema([
                                TextEntry::make('bank_name'),
                                TextEntry::make('account_name'),
                                TextEntry::make('account_number')
                            ])
                            ->placeholder('N/A')
                            ->columns([
                                'default' => 3,
                                'md' => 2,
                                'lg' => 3,
                            ]),
                        RepeatableEntry::make('annual_leave')
                            ->schema([
                                TextEntry::make('start_date')
                                    ->dateTime('M d, Y'),
                                TextEntry::make('end_date')
                                    ->dateTime('M d, Y'),
                            ])
                            ->placeholder('N/A')
                            ->columns([
                                'default' => 2
                            ]),
                        RepeatableEntry::make('sick_leave')
                            ->schema([
                                TextEntry::make('start_date')
                                    ->dateTime('M d, Y'),
                                TextEntry::make('end_date')
                                    ->dateTime('M d, Y'),
                            ])
                            ->placeholder('N/A')
                            ->columns([
                                'default' => 2
                            ])
                    ]),
                Section::make('Performance & Development')
                    ->description('Performance & Development details related to the staff member')
                    ->collapsible()
                    ->schema([
                        RepeatableEntry::make('performance_reviews')
                            ->schema([
                                TextEntry::make('review'),
                                TextEntry::make('date')
                                    ->dateTime('M d, Y'),
                            ])
                            ->placeholder('N/A')
                            ->columns([
                                'default' => 2
                            ]),
                        RepeatableEntry::make('training_records')
                            ->schema([
                                TextEntry::make('title'),
                                TextEntry::make('start_date')
                                    ->dateTime('M d, Y'),
                                TextEntry::make('end_date')
                                    ->dateTime('M d, Y'),
                            ])
                            ->placeholder('N/A')
                            ->columns([
                                'default' => 3
                            ]),
                        RepeatableEntry::make('promotion_history')
                            ->schema([
                                TextEntry::make('new_position'),
                                TextEntry::make('date')
                                    ->label('Promotion Date')
                                    ->dateTime('M d, Y'),
                            ])
                            ->placeholder('N/A')
                            ->columns([
                                'default' => 2
                            ]),
                        TextEntry::make('skills')
                            ->placeholder('N/A')
                            ->formatStateUsing(function ($state) {
                                return collect($state)
                                    ->implode(', ');
                            })
                            ->color('warning')
                            ->badge(),
                    ]),
                Section::make('Compliance & Legal Information')
                    ->description('Compliance and legal details related to the staff member')
                    ->collapsible()
                    ->schema([
                        TextEntry::make('background_check_status')
                            ->color(fn($state) => match ($state) {
                                'Completed' => 'success',
                                'Pending' => 'warning',
                                'Ongoing' => 'primary',
                            })
                            ->badge(),
                        TextEntry::make('employment_contract')
                            ->placeholder('N/A')
                            ->formatStateUsing(fn($state) => $state ? 'View File' : 'No file')
                            ->url(fn($state) => $state ? Storage::url($state) : 'N/A', true)
                            ->color('primary'),
                        TextEntry::make('nda')
                            ->label('NDA')
                            ->placeholder('N/A')
                            ->formatStateUsing(fn($state) => $state ? 'View File' : 'No file')
                            ->url(fn($state) => $state ? Storage::url($state) : 'N/A', true)
                            ->color('primary'),
                        TextEntry::make('work_authorization')
                            ->label('Work Authorization Documents')
                            ->placeholder('N/A')
                            ->color('primary')
                            ->formatStateUsing(function ($state) {
                                return collect($state)
                                    ->map(fn($url) => '<a href="' . Storage::url($url) . '" target="_blank" class="text-blue-600 underline">' . 'View file' . '</a>')
                                    ->implode(' | ');
                            })
                            ->html(),
                        TextEntry::make('certifications')
                            ->label('Certifications & Licenses')
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