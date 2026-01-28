<?php

namespace App\Filament\Resources\Purchases\Schemas;

use App\Filament\Resources\Customers\CustomerResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use App\Models\Warehouse;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

use function Pest\Laravel\options;

class PurchaseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Purchase Information')
                    ->columns(3)
                    ->components([
                        Select::make('provider_id')
                            ->required()
                            ->relationship('provider', 'name')
                            ->createOptionForm(function (Schema $schema) {
                                return $schema
                                    ->columns(1)
                                    ->components(CustomerResource::getCustomerSchema());
                                }),
                        TextInput::make('invoice_number')
                            ->required(),
                        DatePicker::make('purchase_date')
                            ->required(),

                    ]),
                Section::make('Product Details')
                        ->components([
                            Repeater::make('product')
                                ->label('Products')
                                ->columns(4)
                                ->components([
                                    Select::make('product_id')
                                        ->label('Product')
                                        ->required()
                                        ->options(function () {
                                            return Product::pluck('name', 'id')->toArray();
                                        })
                                        ->searchable()
                                        ->createOptionForm(function (Schema $schema) {
                                            return $schema
                                                ->columns(1)
                                                ->components([
                                                    TextInput::make('name')
                                                    ->label('Product Name')
                                                    ->required(),
                                                    Select::make('category_id')
                                                        ->options(function () {
                                                            return Category::pluck('name', 'id')->toArray();
                                                        })
                                                        ->label('select Category')
                                                        ->required(),
                                                    TextInput::make('sku')
                                                        ->label('Product Code')
                                                        ->unique(
                                                            table: 'products',
                                                            column: 'sku',
                                                            ignoreRecord: true
                                                        )
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
                                                    Select::make('unit_id')
                                                        ->label('Select Unit')
                                                        ->options(function () {
                                                            return Unit::pluck('name', 'id')->toArray();
                                                        })
                                                        ->required(),
                                                ]);


                                        }),

                                        TextInput::make('price')
                                            ->required()
                                            ->numeric()
                                            ->default(0.0)
                                            ->prefix('$')
                                            ->reactive()
                                            ->afterStateUpdated(function(callable $get, callable $set) {
                                                $price = $get('price') ?? 0;
                                                $quantity = $get('quantity') ?? 1;
                                                $total = $quantity * $price;
                                                $set('total', $total);
                                            }),
                                        TextInput::make('quantity')
                                            ->required()
                                            ->numeric()
                                            ->default(1.0)
                                            ->reactive()
                                            ->afterStateUpdated(function(callable $get, callable $set) {
                                                $price = $get('price') ?? 0;
                                                $quantity = $get('quantity') ?? 1;
                                                $total = $quantity * $price;
                                                $set('total', $total);
                                            }),
                                        TextInput::make('total')
                                            ->required()
                                            ->numeric()
                                            ->default(0.0)
                                            ->prefix('$')
                                            ->disabled(),

                                    ]),


                    ]),
            ]);
    }
}
