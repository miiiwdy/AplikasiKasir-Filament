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
