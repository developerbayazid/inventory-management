<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function printPurchaseInvoice($id)
    {
        $purchase = Purchase::with(['provider', 'products'])->find($id);

        if ($purchase) {
            $pdf = Pdf::loadView('pdf.purchase-invoice', compact('purchase'));
            return $pdf->stream();
        } else {
            Notification::make()
                ->title('No purchase record found...')
                ->danger()
                ->send();
            return redirect()->back();
        }

    }
}
