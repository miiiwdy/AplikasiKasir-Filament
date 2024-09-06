<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'aksi',
        'kode_transaksi',
        'total_harga_all_barang',
    ];

}
