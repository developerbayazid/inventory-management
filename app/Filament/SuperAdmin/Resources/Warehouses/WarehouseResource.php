<?php

namespace App\Filament\SuperAdmin\Resources\Warehouses;

use App\Filament\SuperAdmin\Resources\Warehouses\Pages\CreateWarehouse;
use App\Filament\SuperAdmin\Resources\Warehouses\Pages\EditWarehouse;
use App\Filament\SuperAdmin\Resources\Warehouses\Pages\ListWarehouses;
use App\Filament\SuperAdmin\Resources\Warehouses\RelationManagers\UsersRelationManager;
use App\Filament\SuperAdmin\Resources\Warehouses\Schemas\WarehouseForm;
use App\Filament\SuperAdmin\Resources\Warehouses\Tables\WarehousesTable;
use App\Models\Warehouse;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WarehouseResource extends Resource
{
    protected static ?string $model = Warehouse::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Warehouse';

    public static function form(Schema $schema): Schema
    {
        return WarehouseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WarehousesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWarehouses::route('/'),
            'create' => CreateWarehouse::route('/create'),
            'edit' => EditWarehouse::route('/{record}/edit'),
        ];
    }
}
