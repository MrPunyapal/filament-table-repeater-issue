<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Repeater::make('dates')
                    ->table([
                        TableColumn::make('Start date'),
                        TableColumn::make('End date'),
                    ])
                    ->schema([
                        DateTimePicker::make('start_date')
                            ->label('Start Date')
                            ->afterStateUpdatedJs(<<<'JS'
                                if ($state && $get('end_date') === null) {
                                    $set('end_date', $state);
                                }
                            JS)
                            ->required(),
                        DateTimePicker::make('end_date')
                            ->label('End Date')
                            ->required(),
                    ])->columns(2)
                    ->columnSpan(2),
            ])->columns(3);
    }
}
