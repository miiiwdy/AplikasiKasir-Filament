<?php

namespace App\Filament\Resources;

use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Session;
use App\Filament\Resources\TransaksiResource\Pages;
use App\Filament\Resources\TransaksiResource\RelationManagers;
use App\Models\Barang;
use App\Models\Keranjang;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransaksiResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $activeNavigationIcon = 'heroicon-s-shopping-cart';
    protected static ?string $navigationLabel = 'List Barang & Transaksi';
    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_barang')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('harga')
                    ->numeric()
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('kode_barang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('stok')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kategori')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('addToCart')
                    ->label('Add')
                    ->button()
                    ->form([
                        TextInput::make('quantity')->label('Quantity')->required()->numeric()->minValue(1),
                    ])
                    ->action(function ($record, $data) {
                        Keranjang::create([
                            'nama_barang' => $record->nama_barang,
                            'harga' => $record->harga,
                            'total_harga' => $record->harga * $data['quantity'],
                            'kode_barang' => $record->kode_barang,
                            'stok' => $record->stok,
                            'kategori' => $record->kategori,
                            'quantity' => $data['quantity'],
                        ]);
                        Notification::make()
                            ->title('Barang Dimasukkan ke Keranjang')
                            ->icon('heroicon-s-shopping-bag')
                            ->iconColor('success')
                            ->send();
                    })
                    ->icon('heroicon-s-plus-circle'),
            ]);
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransaksis::route('/'),
            // 'edit' => Pages\EditTransaksi::route('/{record}/edit')--
        ];
    }
}
