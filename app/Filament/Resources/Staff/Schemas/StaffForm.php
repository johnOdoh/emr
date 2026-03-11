<?php

namespace App\Filament\Resources\Staff\Schemas;

use App\Enums\Departments;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Laravel\SerializableClosure\Serializers\Native;

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
                        FileUpload::make('id_document')
                            ->label('ID Document')
                            ->disk('public')
                            ->directory('staff/ids')
                            ->visibility('public')
                            ->moveFiles()
                            ->maxSize(2048)
                            ->acceptedFileTypes(['application/pdf']),
                        FileUpload::make('cv')
                            ->label('CV')
                            ->disk('public')
                            ->directory('staff/cv')
                            ->visibility('public')
                            ->moveFiles()
                            ->maxSize(2048)
                            ->acceptedFileTypes(['application/pdf']),
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
                        Select::make('department')
                            ->required()
                            ->options(Departments::toOptions()),
                        Select::make('employment_type')
                            ->required()
                            ->options([
                                'Full-time' => 'Full-time',
                                'Part-time' => 'Part-time',
                                'Contract' => 'Contract',
                            ]),
                        DatePicker::make('employment_date')
                            ->required(),
                        Select::make('employment_status')
                            ->required()
                            ->options([
                                'Active' => 'Active',
                                'On Leave' => 'On Leave',
                                'Terminated' => 'Terminated',
                            ])
                            ->hint(new HtmlString(Blade::render('<x-filament::loading-indicator class="h-5 w-5" wire:loading wire:target="data.employment_status" />')))
                            ->live(),
                        DatePicker::make('termination_date')
                            ->required()
                            ->visible(fn($get) => $get('employment_status') === 'Terminated'),
                        TextInput::make('termination_reason')
                            ->label(('Reason for Termination'))
                            ->required()
                            ->visible(fn($get) => $get('employment_status') === 'Terminated'),
                    ]),
                Fieldset::make('Remuneration Details')
                    ->columns([
                        'default' => 1,
                        'md' => 3,
                        'lg' => 3,
                    ])
                    ->schema([
                        TextInput::make('tin')
                            ->label('TIN')
                            ->required(),
                        TextInput::make('salary')
                            ->label('Salary (NGN)')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->prefix('₦'),
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
                Fieldset::make('Leave Details')
                    ->columns([
                        'default' => 1,
                        'md' => 3,
                    ])
                    ->schema([
                        Repeater::make('annual_leave')
                            ->schema([
                                DatePicker::make('start_date')->required(),
                                DatePicker::make('end_date')->required(),
                            ])
                            ->columns(2)
                            ->defaultItems(0),
                        Repeater::make('sick_leave')
                            ->schema([
                                DatePicker::make('start_date')->required(),
                                DatePicker::make('end_date')->required(),
                            ])
                            ->columns(2)
                            ->defaultItems(0),
                    ]),
                Fieldset::make('Compliance & Legal Information')
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                    ])
                    ->schema([
                        FileUpload::make('employment_contract')
                            ->disk('public')
                            ->directory('staff/contracts')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->acceptedFileTypes(['application/pdf']),
                        FileUpload::make('nda')
                            ->disk('public')
                            ->directory('staff/nda')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->acceptedFileTypes(['application/pdf']),
                        FileUpload::make('work_authorization')
                            ->label('Work Authorization Documents')
                            ->disk('public')
                            ->directory('staff/work_authorization_documents')
                            ->visibility('public')
                            ->multiple()
                            ->maxParallelUploads(3)
                            ->moveFiles()
                            ->maxSize(5124)
                            ->acceptedFileTypes(['application/pdf']),
                        FileUpload::make('certifications')
                            ->label('Certifications & Licenses')
                            ->disk('public')
                            ->directory('staff/certifications')
                            ->visibility('public')
                            ->multiple()
                            ->maxParallelUploads(3)
                            ->moveFiles()
                            ->maxSize(5124)
                            ->acceptedFileTypes(['application/pdf']),
                        Select::make('background_check_status')
                            ->required()
                            ->options([
                                'Pending' => 'Pending',
                                'Ongoing' => 'Ongoing',
                                'Completed' => 'Completed',
                            ]),
                    ]),
                Fieldset::make('Performance & Development')
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                    ])
                    ->schema([
                        Repeater::make('performance_reviews')
                            ->schema([
                                Textarea::make('review')->required(),
                                DatePicker::make('date')
                                    ->label('Date of Review')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->columnSpanFull()
                            ->defaultItems(0)
                            ->reorderable(false),
                        Repeater::make('training_records')
                            ->schema([
                                TextInput::make('title')->required(),
                                DatePicker::make('start_date')
                                    ->required(),
                                DatePicker::make('end_date')
                                    ->required(),
                            ])
                            ->columns(3)
                            ->columnSpanFull()
                            ->defaultItems(0)
                            ->reorderable(false),
                        Repeater::make('promotion_history')
                            ->schema([
                                TextInput::make('new_position')->required(),
                                DatePicker::make('date')->required(),
                            ])
                            ->columns(2)
                            ->columnSpanFull()
                            ->defaultItems(0)
                            ->reorderable(false),
                        Repeater::make('skills')
                            ->schema([
                                TextInput::make('name')->required()
                            ])
                            ->defaultItems(0),
                        FileUpload::make('disciplinary_records')
                            ->disk('public')
                            ->directory('staff/disciplinary_records')
                            ->visibility('public')
                            ->multiple()
                            ->maxParallelUploads(3)
                            ->moveFiles()
                            ->maxSize(5124)
                            ->acceptedFileTypes(['application/pdf']),
                    ]),
            ])->columns(1);
    }
}
