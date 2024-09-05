<?php

use App\Models\Checkout;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;
use App\Filament\Resources\KeranjangResource;

Route::get('/', function () {
    return redirect('admin');
});

//getdatakeranjang
Route::get('/keranjang', [KeranjangResource::class, 'getTableData']);

//endpoin buat checkout detail
// Route::get('/api/checkout-details/{kode_transaksi}', function ($kode_transaksi) {
//     $checkout = Checkout::where('kode_transaksi', $kode_transaksi)->first();
//     return response()->json($checkout);
// });

// Filament::routes();