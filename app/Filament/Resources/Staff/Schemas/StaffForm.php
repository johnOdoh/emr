<?php

namespace App\Filament\Resources\Staff\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class StaffForm
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
                        TextInput::make('surname')
                            ->required(),
                        TextInput::make('firstname')
                            ->required(),
                        TextInput::make('middlename'),
                        Select::make('gender')
                            ->required()
                            ->options([
                                'Male' => 'Male',
                                'Female' => 'Female',
                            ]),
                        TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->required(),
                        TextInput::make('address')
                            ->required(),
                        TextInput::make('phone')
                            ->tel()
                            ->required(),
                        Select::make('marital_status')
                            ->required()
                            ->options([
                                'Single' => 'Single',
                                'Married' => 'Married',
                                'Divorced' => 'Divorced',
                                'Widowed' => 'Widowed',
                            ]),
                    ]),
                Fieldset::make('Emergency Contact Details')
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                    ])
                    ->schema([
                        Repeater::make('emergency_contact_details')
                            ->schema([
                                TextInput::make('name')->required(),
                                TextInput::make('phone')->tel()->required(),
                                Select::make('relationship')->required()->options([
                                    'Spouse' => 'Spouse',
                                    'Parent' => 'Parent',
                                    'Sibling' => 'Sibling',
                                    'Friend' => 'Friend',
                                    'Other' => 'Other',
                                ]),
                            ])
                            ->columns(3)
                            ->columnSpanFull()
                            ->defaultItems(1)
                            ->addable(false)
                            ->deletable(false)
                            ->reorderable(false)
                            ->required(),
                    ]),
                Fieldset::make('Employment Details')
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                    ])
                    ->schema([
                        TextInput::make('job_title')
                            ->required(),
                        TextInput::make('department')
                            ->required(),
                        Select::make('role')
                            ->required(),
                        Select::make('employment_status')
                            ->required()
                            ->options([
                                'Doctor' => 'Doctor',
                                'Nurse' => 'Nurse',
                                'HR' => 'HR',
                                'Receptionist' => 'Receptionist',
                                'Admin' => 'Administrator',
                            ]),
                        Select::make('employment_status')
                            ->required()
                            ->options([
                                'Active' => 'Active',
                                'On Leave' => 'On Leave',
                                'Terminated' => 'Terminated',
                            ]),
                        Select::make('employment_type')
                            ->required()
                            ->options([
                                'Full-time' => 'Full-time',
                                'Part-time' => 'Part-time',
                                'Contract' => 'Contract',
                            ]),
                        DatePicker::make('employment_date')
                            ->required(),
                    ]),
                Fieldset::make('Remuneration Details')
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                    ])
                    ->schema([
                        TextInput::make('salary')
                            ->label('Salary (NGN)')
                            ->required()
                            ->numeric(),
                        Select::make('payment_frequency')
                            ->required()
                            ->options([
                                'Daily' => 'Daily',
                                'Weekly' => 'Weekly',
                                'Monthly' => 'Monthly',
                            ]),
                        Repeater::make('account_details')
                            ->schema([
                                TextInput::make('bank_name')->required(),
                                TextInput::make('account_number')->required(),
                                TextInput::make('account_name')->required(),
                            ])
                            ->columns(3)
                            ->columnSpanFull()
                            ->defaultItems(0)
                            ->maxItems(1)
                            ->reorderable(false),
                    ]),
            ])->columns(1);
    }
}
