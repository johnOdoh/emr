<?php

namespace App\Filament\Resources\Patients\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VitalsRelationManager extends RelationManager
{
    protected static string $relationship = 'vitals';
    protected static ?string $modelLabel = 'Vital Sign';


    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('temperature')
                    ->label('Temperature (°C)')
                    ->required()
                    ->numeric(),
                TextInput::make('heart_rate')
                    ->label('Heart Rate (bpm)')
                    ->required()
                    ->numeric(),
                TextInput::make('sugar_level')
                    ->label('Sugar Level (mg/dL)')
                    ->required()
                    ->numeric(),
                TextInput::make('blood_pressure_systolic')
                    ->label('Blood Pressure (Systolic mmHg)')
                    ->required()
                    ->numeric(),
                TextInput::make('blood_pressure_diastolic')
                    ->label('Blood Pressure (Diastolic mmHg)')
                    ->required()
                    ->numeric(),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('temperature')
                    ->suffix('°C')
                    ->numeric(),
                TextEntry::make('heart_rate')
                    ->suffix('bpm')
                    ->numeric(),
                TextEntry::make('sugar_level')
                    ->suffix('mg/dL')
                    ->numeric(),
                TextEntry::make('blood_pressure_systolic')
                    ->suffix('mmHg')
                    ->numeric(),
                TextEntry::make('blood_pressure_diastolic')
                    ->suffix('mmHg')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-')
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('index')
                    ->rowIndex()
                    ->label('#'),
                TextColumn::make('temperature')
                    ->label('Temperature (°C)')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('heart_rate')
                    ->label('Heart Rate (bpm)')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sugar_level')
                    ->label('Sugar Level (mg/dL)')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('blood_pressure_systolic')
                    ->label('Blood Pressure (Systolic mmHg)')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('blood_pressure_diastolic')
                    ->label('Blood Pressure (Diastolic mmHg)')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                // AssociateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                // DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
