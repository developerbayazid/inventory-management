<?php

namespace App\Filament\Resources\Purchases\Pages;

use App\Filament\Resources\Purchases\PurchaseResource;
use App\Models\Purchase;
use Filament\Actions\Action;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class Invoice extends Page
{
    use InteractsWithRecord;

    public $purchase;

    protected static string $resource = PurchaseResource::class;

    protected string $view = 'filament.resources.purchases.pages.invoice';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->purchase = Purchase::with(['provider', 'products'])->find($record);
    }

    public function getHeaderActions(): array
    {
        return [
            Action::make('print')
                ->label('Print')
                ->icon('heroicon-o-printer')
                ->requiresConfirmation()
        ];
    }
}
