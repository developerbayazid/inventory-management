<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryForm
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
                    ->label('Category Name'),
                TextInput::make('slug')
                    ->required()
                    ->label('Category Slug')
                    ->unique(ignoreRecord: true),
                Textarea::make('description')
                    ->columnSpanFull(),
                KeyValue::make('data')
                    ->columnSpanFull(),
            ]);
    }
}
