<?php

namespace App\Filament\Resources\Records\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class RecordForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Patient Name')
                    ->required(),
                TextInput::make('condition')
                    ->label('Medical Condition')
                    ->required(),
                TextInput::make('address')
                    ->required(),
                TextInput::make('phone')
                    ->label('Phone Number')
                    ->tel()
                    ->required(),
                TextInput::make('nurse')
                    ->label('Nurse In charge')
                    ->required(),
                Textarea::make('complaints')
                    ->label('Complaints')
                    ->required(),
                Textarea::make('follow_up')
                    ->label('Follow-up Instructions')
                    ->columnSpanFull(),
            ]);
    }
}
