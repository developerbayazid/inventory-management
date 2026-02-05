<?php

namespace App\Filament\Resources\Purchases\Pages;

use App\Filament\Resources\Purchases\PurchaseResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class Invoice extends Page
{
    use InteractsWithRecord;

    protected static string $resource = PurchaseResource::class;

    protected string $view = 'filament.resources.purchases.pages.invoice';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }
}
