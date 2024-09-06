<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HistoryResource\Pages;
use App\Filament\Resources\HistoryResource\RelationManagers;
use App\Models\Checkout;
use App\Models\History;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HistoryResource extends Resource
{
    protected static ?string $model = History::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $activeNavigationIcon = 'heroicon-s-clipboard-document-list';
    protected static ?string $navigationGroup = 'Admin Room';
    protected static ?int $navigationSort = 3;

    protected function getItemsTable($record)
    {
        $items = Checkout::where('kode_transaksi', $record->kode_transaksi)->get();

        return view('filament.components.items-checkout-table', [
            'items' => $items,
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('aksi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kode_transaksi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_harga_all_barang')
                    ->label('Total Harga')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->color('primary')
                    ->button()
                    ->modalContent(fn($record) => (new static)->getItemsTable($record)),
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
            'index' => Pages\ListHistories::route('/'),
            // 'view' => Pages\ViewHistory::route('/{record}/detail'),
        ];
    }
}
