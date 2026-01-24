<?php

namespace App\Filament\Resources\Units\Schemas;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // TextInput::make('warehouse_id')
                //     ->required()
                //     ->numeric(),
                TextInput::make('name')
                    ->required()
                    ->label('Unit Name')
                    ->helperText('e.g., Kilogram, Liter, Piece')
                    ->columnSpanFull(),
                TextInput::make('key')
                    ->required()
                    ->helperText('e.g., kg, l, pc')
                    ->label('Unit Key')
                    ->unique(ignoreRecord: true)
                    ->columnSpanFull(),
                KeyValue::make('data')
                    ->columnSpanFull(),
            ]);
    }
}
