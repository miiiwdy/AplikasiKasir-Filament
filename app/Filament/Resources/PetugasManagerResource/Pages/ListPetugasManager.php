<?php

namespace App\Filament\Resources\PetugasManagerResource\Pages;

use App\Filament\Resources\PetugasManagerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPetugasManagers extends ListRecords
{
    protected static string $resource = PetugasManagerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
