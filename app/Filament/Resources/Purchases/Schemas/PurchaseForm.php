<?php

namespace App\Filament\Resources\Purchases\Schemas;

use App\Filament\Resources\Customers\CustomerResource;
use App\Filament\Resources\Products\ProductResource;
use App\Filament\Resources\Purchases\PurchaseResource;
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
use Livewire\Component as Livewire;

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
                                ->cloneable()
                                ->afterStateUpdated(fn(Livewire $livewire) => PurchaseResource::updateFormData($livewire))
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
                                                ->components(ProductResource::getProductSchema());

                                        })
                                        ->createOptionUsing(function(array $data){
                                            return Product::create($data)->id;
                                        }),

                                        TextInput::make('price')
                                            ->required()
                                            ->numeric()
                                            ->default(0.0)
                                            ->prefix('$')
                                            ->reactive()
                                            ->afterStateUpdated(fn(Livewire $livewire) => PurchaseResource::updateFormData($livewire)),
                                        TextInput::make('quantity')
                                            ->required()
                                            ->numeric()
                                            ->default(1.0)
                                            ->reactive()
                                           ->afterStateUpdated(fn(Livewire $livewire) => PurchaseResource::updateFormData($livewire)),
                                        TextInput::make('total')
                                            ->required()
                                            ->numeric()
                                            ->default(0.0)
                                            ->prefix('$')
                                            ->disabled(),

                                    ]),


                    ]),

                    Section::make()
                        ->heading('Total Details')
                        ->columns(3)
                        ->components([
                            TextInput::make('total_amount')
                                ->required()
                                ->disabled()
                                ->label('Sub Total'),
                            TextInput::make('discount')
                                ->required()
                                ->label('Discount')
                                ->default(0)
                                ->prefix('$')
                                ->reactive()
                                ->afterStateUpdated(function($get, $set){
                                    $sub_total = $get('total_amount') ?? 0;
                                    $discount  = $get('discount') ?? 0;
                                    $set('net_total', $sub_total - $discount);
                                }),
                            TextInput::make('net_total')
                                ->label('Total')
                                ->disabled()
                                ->required(),
                        ])

            ]);
    }
}
