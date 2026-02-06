<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/invoice-print/{record}', [InvoiceController::class, 'printPurchaseInvoice'])->name('print.purchase-invoice');
