<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KeranjangResource\Pages;
use App\Filament\Resources\KeranjangResource\RelationManagers;
use App\Models\Keranjang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'create' => Pages\CreateKeranjang::route('/create'),
            'edit' => Pages\EditKeranjang::route('/{record}/edit'),
        ];
    }
}
