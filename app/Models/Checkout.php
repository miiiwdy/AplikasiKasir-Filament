<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_transaksi',
        'nama_barang',
        'harga',
        'total_harga',
        'kode_barang',
        'stok',
        'kategori',
        'quantity',
        'payment',
        'total_harga_all_barang',
    ];
    public function checkout()
    {
        return $this->hasMany(Checkout::class);
    }
}
