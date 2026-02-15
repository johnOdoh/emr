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

class LabResultsRelationManager extends RelationManager
{
    protected static string $relationship = 'labResults';
    protected static ?string $modelLabel = 'Lab Result';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('urinalysis'),
                TextInput::make('fbc'),
                TextInput::make('hiv'),
                TextInput::make('Hepatitis_B'),
                TextInput::make('Hepatitis_C'),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('urinalysis')
                    ->placeholder('-'),
                TextEntry::make('fbc')
                    ->placeholder('-'),
                TextEntry::make('hiv')
                    ->placeholder('-'),
                TextEntry::make('Hepatitis_B')
                    ->placeholder('-'),
                TextEntry::make('Hepatitis_C')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
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
                TextColumn::make('urinalysis')
                    ->searchable(),
                TextColumn::make('fbc')
                    ->searchable(),
                TextColumn::make('hiv')
                    ->searchable(),
                TextColumn::make('Hepatitis_B')
                    ->searchable(),
                TextColumn::make('Hepatitis_C')
                    ->searchable(),
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