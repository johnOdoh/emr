<?php

namespace App\Filament\Resources\Payslips\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class PayslipForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make('Employee details Details')
                    ->columns([
                        'default' => 1,
                        'md' => 3,
                        'lg' => 3,
                    ])
                    ->schema([
                        TextInput::make('name')
                            ->readOnly(),
                        // ->default('John Doe'),
                        TextInput::make('job_title')
                            ->readOnly(),
                        // ->default('Software Engineer'),
                        TextInput::make('department')
                            ->readOnly(),
                        // ->default('Engineering'),
                    ]),
                Fieldset::make('Payslip Date')
                    ->columns(1)
                    ->schema([
                        DatePicker::make('date')
                            ->required()
                            ->displayFormat('F, Y'),
                        // ->native(false),
                    ]),
                Fieldset::make('Salary Earnings')
                    ->schema([
                        Repeater::make('earnings')
                            ->schema([
                                TextInput::make('description')
                                    ->required(),
                                TextInput::make('amount')
                                    ->prefix('₦')
                                    ->required()
                                    ->numeric()
                                    ->step(0.01,)
                            ])
                            ->default([
                                ['description' => '', 'amount' => ''],
                            ])
                            ->minItems(1)
                            ->columns(2)
                            ->columnSpanFull(),
                    ]),
                Fieldset::make('Salary Deductions')
                    ->schema([
                        Repeater::make('deductions')
                            ->schema([
                                TextInput::make('description')
                                    ->required(),
                                TextInput::make('amount')
                                    ->prefix('₦')
                                    ->required()
                                    ->numeric()
                                    ->step(0.01,)
                            ])
                            ->defaultItems(1)
                            ->columns(2)
                            ->columnSpanFull(),
                    ])
            ])
            ->columns(1);
    }
}