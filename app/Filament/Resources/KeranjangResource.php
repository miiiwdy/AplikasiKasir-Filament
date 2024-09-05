<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Keranjang;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KeranjangResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KeranjangResource\RelationManagers;
use Filament\Resources\Pages\Page;

class KeranjangResource extends Resource
{
    protected static ?string $model = Keranjang::class;

    protected static ?string $navigationLabel = 'Keranjang';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $activeNavigationIcon = 'heroicon-s-shopping-cart';
    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?int $navigationSort = -1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('quantity')
                // ->label('Quantity')
                // ->numeric()
                // ->reactive() 
                // ->afterStateUpdated(function ($state, callable $set, $get) {
                //     $set('total_harga', $get('harga') * $state);
                // }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_barang')
                    ->label('Nama Barang'),
                Tables\Columns\TextColumn::make('total_harga')
                    ->label('Harga')
                    ->money('IDR'),
                Tables\Columns\TextColumn::make('kode_barang')
                    ->label('Kode Barang'),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Jumlah'),
                Tables\Columns\TextColumn::make('kategori')
                    ->label('Kategori'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('delete')
                    ->requiresConfirmation()
                    ->action(fn(Keranjang $record) => $record->delete())
                    ->color('danger')
                    ->icon('heroicon-c-trash'),
            ]);
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKeranjangs::route('/'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
