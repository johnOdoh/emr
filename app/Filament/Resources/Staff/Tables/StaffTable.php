<?php

namespace App\Filament\Resources\Staff\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StaffTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->rowIndex()
                    ->label('#'),
                TextColumn::make('fullname')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('job_title')
                    ->searchable(),
                TextColumn::make('department')
                    ->searchable(),
                TextColumn::make('employment_status')
                    ->color(fn($state) => match ($state) {
                        'Active'   => 'success',
                        'On Leave' => 'warning',
                        'Terminated'  => 'danger'
                    })
                    ->badge()
                    ->searchable(),
                TextColumn::make('employment_type')
                    ->badge()
                    ->searchable(),
                TextColumn::make('employment_date')
                    ->dateTime('d M Y')
                    ->sortable(),
                TextColumn::make('salary')
                    ->label('Salary (₦)')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('payment_frequency')
                    ->badge()
                    ->searchable(),
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
