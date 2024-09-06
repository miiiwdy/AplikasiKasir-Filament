<?php

namespace App\Filament\Resources\KeranjangResource\Pages;

use Filament\Actions;
use App\Models\Checkout;
use App\Models\Keranjang;
use Filament\Support\RawJs;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\KeranjangResource;
use App\Models\History;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Blade;

class ListKeranjangs extends ListRecords
{
    protected static string $resource = KeranjangResource::class;

    function RandomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 10; $i++) {
            $randstring .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randstring;
    }
    protected function getItemsTable()
    {
        $items = Keranjang::all();

        return view('filament.components.items-table', [
            'items' => $items,
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('delete_keranjang')->label('Hapus Keranjang')->button()->color('danger')
                ->action(function () {
                    Keranjang::truncate();
                    Notification::make()
                        ->title('Keranjang dihapus')
                        ->icon('heroicon-s-shopping-bag')
                        ->iconColor('danger')
                        ->send();
                }),
            Action::make('addToCart')
                ->label('Checkout Barang')
                ->button()
                ->form(function () {
                    $totalhrg = Keranjang::sum('total_harga');
                    return [
                        TextInput::make('total_harga')
                            ->label('Total Price')
                            ->disabled()
                            ->default($totalhrg)
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric(),
                        Select::make('payment')
                            ->options([
                                'cash' => 'Cash',
                                'debit' => 'Debit',
                                'qris' => 'Qris',
                            ])->label('Payment Method')->required(),
                    ];
                })
                ->modalContent(fn() => $this->getItemsTable())
                ->action(function ($record, $data) {
                    $rd = $this->RandomString();

                    $keranjangItems = Keranjang::all();

                    $total_harga_all_barang = 0;

                    foreach ($keranjangItems as $item) {
                        $total_harga_all_barang += $item->harga * $item->quantity;
                    }

                    foreach ($keranjangItems as $item) {
                        Checkout::create([
                            'kode_transaksi' => $rd,
                            'nama_barang' => $item->nama_barang,
                            'total_harga' => $item->harga * $item->quantity,
                            'kode_barang' => $item->kode_barang,
                            'quantity' => $item->quantity,
                            'payment' => $data['payment'],
                            'total_harga_all_barang' => $total_harga_all_barang,
                        ]);
                    }
                    History::create([
                        'aksi' => 'Checkout',
                        'kode_transaksi' => $rd,
                        'total_harga_all_barang' => $total_harga_all_barang,
                        'nama_barang' => null,
                        'harga' => null,
                        'kode_barang' => null,
                        'stok' => null,
                        'kategori' => null,
                        'name' => null,
                        'email' => null,
                    ]);

                    Keranjang::truncate();

                    Notification::make()
                        ->title('Transaksi Sukses')
                        ->icon('heroicon-s-shopping-bag')
                        ->iconColor('success')
                        ->send();

                    session(['purchaseData' => $keranjangItems->map(function ($item) {
                        return [
                            'kode_transaksi' => $item->kode_transaksi,
                            'nama_barang' => $item->nama_barang,
                            'total_harga' => $item->harga * $item->quantity,
                            'kode_barang' => $item->kode_barang,
                            'quantity' => $item->quantity,
                            'payment' => $item->payment,
                            'total_harga_all_barang' => $item->total_harga_all_barang,
                        ];
                    })]);

                    return redirect()->route('download.receipt');
                }),
        ];
    }
}
