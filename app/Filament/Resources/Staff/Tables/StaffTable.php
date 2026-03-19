<?php

namespace App\Filament\Resources\Staff\Tables;

use App\Enums\Departments;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
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
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('job_title')
                    ->searchable(),
                TextColumn::make('department')
                    ->sortable()
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
                SelectFilter::make('employment_status')
                    ->multiple()
                    ->options([
                        'Active' => 'Active',
                        'On Leave' => 'On Leave',
                        'Terminated' => 'Terminated',
                    ]),
                SelectFilter::make('department')
                    ->multiple()
                    ->options(Departments::toOptions()),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('generate_payslip')
                    ->color('info')
                    ->url(fn($record): string => route('filament.user.resources.payslips.create', ['id' => $record->id]))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-document-text'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}