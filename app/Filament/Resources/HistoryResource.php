<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HistoryResource\Pages;
use App\Filament\Resources\HistoryResource\RelationManagers;
use App\Models\History;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HistoryResource extends Resource
{
    protected static ?string $model = History::class;

    protected static ?string $navigationLabel = 'Laporan';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $activeNavigationIcon = 'heroicon-s-clipboard-document-list';
    protected static ?string $navigationGroup = 'Admin Room';
    protected static ?int $navigationSort = 3;
    
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

    public static function canCreate(): bool
    {
        return false;
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHistories::route('/'),
            // 'create' => Pages\CreateHistory::route('/create'),
            // 'edit' => Pages\EditHistory::route('/{record}/edit'),
        ];
    }
}
