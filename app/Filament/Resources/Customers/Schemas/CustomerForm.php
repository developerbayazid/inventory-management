<?php

namespace App\Filament\Resources\Customers\Schemas;

use App\Filament\Resources\Customers\CustomerResource;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components(CustomerResource::getCustomerSchema());
    }
}
