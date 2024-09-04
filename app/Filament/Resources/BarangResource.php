<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangResource\Pages;
use App\Filament\Resources\BarangResource\RelationManagers;
use App\Models\Barang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;
    protected static ?string $navigationLabel = 'Pendataan Barang';
    protected static ?string $navigationIcon = 'heroicon-o-folder-plus';
    protected static ?string $activeNavigationIcon = 'heroicon-s-folder-plus';
    protected static ?string $navigationGroup = 'Pendataan';
    protected static ?int $navigationSort = -1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_barang')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('harga')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('kode_barang')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('stok')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('kategori')
                    ->required()
                    ->options([
                        'makanan_ringan' => 'Makanan Ringan',
                        'minuman' => 'Minuman',
                        'ice_cream' => 'Ice Cream',
                        'minuman_bubuk' => 'Minuman Bubuk',
                        'makanan_segar' => 'Makanan Segar',
                        'makanan_olahan_kemasan' => 'Makanan Olahan dan Kemasan',
                    ])
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}
