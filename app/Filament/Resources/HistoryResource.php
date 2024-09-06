<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\History;
use App\Models\Checkout;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\HistoryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\HistoryResource\RelationManagers;

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
                Filter::make('date_range')
                    ->form([
                        DatePicker::make('start_date')
                            ->label('Start Date')
                            ->required(),
                        DatePicker::make('end_date')
                            ->label('End Date')
                            ->required(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['start_date'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date)
                            )
                            ->when(
                                $data['end_date'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date)
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->color('primary')
                    ->button()
                    ->modalContent(fn($record) => (new static)->getItemsTable($record)),
            ])
            ->bulkActions([
                ExportBulkAction::make()
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
