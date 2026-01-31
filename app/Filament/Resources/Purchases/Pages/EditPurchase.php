<?php

namespace App\Filament\Resources\Purchases\Pages;

use App\Filament\Resources\Purchases\PurchaseResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditPurchase extends EditRecord
{
    protected static string $resource = PurchaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Prevent Filament from saving repeater into purchases table
        unset($data['product']);

        return $data;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Load products from the relationship
        $data['products'] = $this->record->products->map(fn($p) => [
            'product_id' => $p->product_id,
            'price'      => $p->price,
            'quantity'   => $p->quantity,
            'total'      => $p->price * $p->quantity,
        ])->toArray();

        return $data;
    }


    protected function handleRecordUpdate(Model $record, array $data): Model
    {

            $record->update([
                'provider_id'    => $data['provider_id'],
                'invoice_number' => $data['invoice_number'],
                'purchase_date'  => $data['purchase_date'],
                'total'          => $data['total'],
                'discount'       => $data['discount'],
                'net_total'      => $data['net_total'],
            ]);

            $record->products()->delete();

            $products = $data['products'] ?? [];

            foreach ($products as $product) {
                $record->products()->create([
                    'product_id' => $product['product_id'],
                    'quantity'   => $product['quantity'],
                    'price'      => $product['price'],
                ]);
            }

            return $record;

    }

}
