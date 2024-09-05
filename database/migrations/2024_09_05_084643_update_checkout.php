<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('checkouts', function (Blueprint $table) {
            if (!Schema::hasTable('checkouts')) {
                $table->bigIncrements('id');
                $table->string('kode_transaksi');
                $table->string('nama_barang');
                $table->decimal('total_harga', 10, 2);
                $table->string('kode_barang');
                $table->integer('quantity');
                $table->string('payment');
                $table->decimal('total_harga_all_barang', 10, 2);
                $table->timestamps();
            }
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
