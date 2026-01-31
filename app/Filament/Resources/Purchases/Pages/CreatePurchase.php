<?php

namespace App\Filament\Resources\Purchases\Pages;

use App\Filament\Resources\Purchases\PurchaseResource;
use App\Models\Purchase;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePurchase extends CreateRecord
{
    protected static string $resource = PurchaseResource::class;

    public function handleRecordCreation(array $data): Model
    {
        $purchase = Purchase::create([
            'provider_id'    => $data['provider_id'],
            'invoice_number' => $data['invoice_number'],
            'purchase_date'  => $data['purchase_date'],
            'total'          => $data['total'],
            'net_total'      => $data['net_total'],
            'discount'       => $data['discount'],
        ]);

        $products = $data['product'];

        foreach ($products as $product) {
            $purchase->products()->create([
                'product_id' => $product['product_id'],
                'price'      => $product['price'],
                'quantity'   => $product['quantity'],
            ]);
        }


        return $purchase;
    }
}
