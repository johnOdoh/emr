<?php

namespace App\Filament\Resources\Invoices\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class InvoiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Fieldset::make('Client Information')
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                        'lg' => 2,
                    ])
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')
                            ->required(),
                        TextInput::make('phone')
                            ->required(),
                        DatePicker::make('invoice_due_date')
                            ->required(),
                        TextInput::make('address')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('state')
                            ->required(),
                        TextInput::make('zip_code')
                            ->required(),
                    ]),
                Fieldset::make('Invoice Items')
                    ->columns(1)
                    ->schema([
                        Repeater::make('items')
                            ->schema([
                                TextInput::make('item_name')
                                    ->required(),
                                TextInput::make('rate')
                                    ->label('Rate per unit/hour')
                                    ->prefix('₦')
                                    ->required()
                                    ->numeric()
                                    ->step(0.0),
                                TextInput::make('units')
                                    ->label('Number of units/hours')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1),
                                TextInput::make('total_amount')
                                    ->prefix('₦')
                                    ->required()
                                    ->numeric()
                                    ->step(0.1)
                            ])
                            ->minItems(1)
                            ->required()
                            ->columns(2),
                    ]),
                Fieldset::make('Taxes')
                    ->columns(1)
                    ->schema([
                        Repeater::make('taxes')
                            ->schema([
                                TextInput::make('tax_name')
                                    ->required(),
                                TextInput::make('tax_amount')
                                    ->prefix('₦')
                                    ->required()
                                    ->numeric()
                                    ->step(0.1)
                            ])
                            ->defaultItems(0)
                            ->columns(2),
                    ]),
            ]);
    }
}