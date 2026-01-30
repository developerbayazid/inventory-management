<?php

namespace App\Filament\Resources\Purchases;

use App\Filament\Resources\Purchases\Pages\CreatePurchase;
use App\Filament\Resources\Purchases\Pages\EditPurchase;
use App\Filament\Resources\Purchases\Pages\ListPurchases;
use App\Filament\Resources\Purchases\Schemas\PurchaseForm;
use App\Filament\Resources\Purchases\Tables\PurchasesTable;
use App\Models\Purchase;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PurchaseResource extends Resource
{
    protected static ?string $model = Purchase::class;

    protected static string | UnitEnum | null $navigationGroup = 'Supply Chain';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return PurchaseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PurchasesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPurchases::route('/'),
            'create' => CreatePurchase::route('/create'),
            'edit' => EditPurchase::route('/{record}/edit'),
        ];
    }

    public static function updateFormData($get, $set)
    {
        $formData = $get('../../');
        $products = $formData['product'] ?? [];

        $grandTotal = 0;

        foreach ($products as $product)
        {
            $price      =  $product['price'] ?? 0;
            $quantity   =  $product['quantity'] ?? 1;
            $total      =  $price * $quantity;
            $grandTotal += $total;
        }


        $price    = $get('price') ?? 0;
        $quantity = $get('quantity') ?? 1;
        $total    = $quantity * $price;
        $set('total', $total);
        $set('../../total_amount', $grandTotal);
        $discount = $get('discount');
        $set('../../net_total', $grandTotal - $discount);

    }
}
