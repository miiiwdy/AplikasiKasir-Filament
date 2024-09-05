<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HistoryResource\Pages;
use App\Models\History;
use Filament\Resources\Resource;
use Filament\Tables;

// class HistoryResource extends Resource
// {
//     protected static ?string $model = History::class;

//     public static function table(Tables\Table $table): Tables\Table
//     {
//         return $table
//             ->columns([
//                 Tables\Columns\TextColumn::make('kode_transaksi')
//                     ->label('Transaction Code')
//                     ->sortable()
//                     ->searchable(),
//                 // Add other columns as needed
//             ])
//             ->actions([
//                 Tables\Actions\Action::make('view')
//                     ->label('View Details')
//                     ->icon('heroicon-o-eye')
//                     ->action(function ($record) {
//                         $this->emit('openModal', $record->id);
//                     }),
//             ]);
//     }
// }
