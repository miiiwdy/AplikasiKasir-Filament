<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PetugasManagerResource\Pages;
use App\Filament\Resources\PetugasManagerResource\RelationManagers;

class PetugasManagerResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationLabel = 'Pendataan User';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $activeNavigationIcon = 'heroicon-s-user-group';
    protected static ?string $navigationGroup = 'Pendataan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->required()
                    ->revealable()
                    ->password(),
                Forms\Components\Select::make('roles')
                    ->relationship('roles', 'name')
                    ->preload(),
                Forms\Components\Toggle::make('is_admin'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('roles.name'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
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
            'index' => Pages\ListPetugasManagers::route('/'),
            'create' => Pages\CreatePetugasManager::route('/create'),
            'edit' => Pages\EditPetugasManager::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        if (Auth::user()->is_admin) {
            return parent::getEloquentQuery()->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])->orderBy('id', 'desc');
        } else {
            return parent::getEloquentQuery()->where('is_admin', 'false')->withoutGlobalScopes([
                SoftDeletingScope::class
            ])->orderBy('id', 'desc');
        }
    }
}
