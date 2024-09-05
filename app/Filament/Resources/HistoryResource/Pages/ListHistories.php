<?php

namespace App\Filament\Resources\HistoryResource\Pages;

use App\Filament\Resources\HistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\CheckoutResource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class ListHistories extends ListRecords
{
    // protected static string $resource = HistoryResource::class;

    // public function table(Tables\Table $table): Tables\Table
    // {
    //     return $table
    //         ->columns([
    //             Tables\Columns\TextColumn::make('kode_transaksi')
    //                 ->label('Transaction Code')
    //                 ->sortable()
    //                 ->searchable()
    //                 ->unique()
    //                 ->getRawValue(fn($record) => $record->kode_transaksi),
    //         ])
    //         ->actions([
    //             Tables\Actions\Action::make('view')
    //                 ->label('View Details')
    //                 ->icon('heroicon-o-eye')
    //                 ->action(fn($record) => $this->dispatchBrowserEvent('show-modal', ['kode_transaksi' => $record->kode_transaksi])),
    //         ]);
    // }

    public function mount(): void
    {
        $this->dispatchBrowserEvent('init');
    }
}
