<?php

namespace App\Filament\Resources\PetugasManagerResource\Pages;

use App\Filament\Resources\PetugasManagerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPetugasManager extends EditRecord
{
    protected static string $resource = PetugasManagerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
