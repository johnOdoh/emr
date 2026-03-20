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
                                TextInput::make('number_of_hours')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1),
                                TextInput::make('hourly_rate')
                                    ->prefix('₦')
                                    ->required()
                                    ->numeric()
                                    ->step(0.0),
                                TextInput::make('total_amount')
                                    ->prefix('₦')
                                    ->required()
                                    ->numeric()
                                    ->step(0.0)
                            ])
                            ->minItems(1)
                            ->columns(2),
                    ]),
            ]);
    }
}