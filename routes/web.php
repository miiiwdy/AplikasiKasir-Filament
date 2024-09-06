<?php

use App\Models\Checkout;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReceiptController;
use App\Filament\Resources\KeranjangResource;

Route::get('/', function () {
    return redirect('admin');
});

//getdatakeranjang
Route::get('/keranjang', [KeranjangResource::class, 'getTableData'])->name('keranjang');


//receipt
Route::get('/download-receipt', [ReceiptController::class, 'downloadReceipt'])->name('download.receipt');