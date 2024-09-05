<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Resources\KeranjangResource;

Route::get('/', function () {
    return redirect('admin');
});

Route::get('/keranjang', [KeranjangResource::class, 'getTableData']);