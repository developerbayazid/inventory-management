<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // TextInput::make('warehouse_id')
                //     ->required()
                //     ->numeric(),
                TextInput::make('name')
                    ->label('Product Name')
                    ->required(),
                Select::make('category_id')
                    ->required()
                    ->relationship('category', 'name'),
                TextInput::make('sku')
                    ->label('Product Code')
                    ->unique(ignoreRecord: true)
                    ->helperText('Unique identifier for this product.')
                    ->required(),
                TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->default(1.0),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->default(0.0)
                    ->prefix('$'),
                TextInput::make('safety_stock')
                    ->required()
                    ->numeric()
                    ->helperText('Safety stock level to trigger restocking')
                    ->default(0),
                Textarea::make('description')
                    ->columnSpanFull(),
                Select::make('unit_id')
                    ->required()
                    ->relationship('unit', 'name'),
                DatePicker::make('expiry_date'),
                KeyValue::make('data')
                    ->columnSpanFull(),
            ]);
    }
}
