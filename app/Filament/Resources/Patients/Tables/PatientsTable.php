<?php

namespace App\Filament\Resources\Patients\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PatientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->rowIndex()
                    ->label('#'),
                TextColumn::make('patient_code')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('gender')
                    ->badge()
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('dob')
                    ->dateTime('d M, Y')
                    ->sortable(),
                TextColumn::make('blood_group')
                    ->searchable(),
                TextColumn::make('genotype')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
