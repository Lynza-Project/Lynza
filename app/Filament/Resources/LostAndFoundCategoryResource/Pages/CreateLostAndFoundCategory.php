<?php

namespace App\Filament\Resources\LostAndFoundCategoryResource\Pages;

use App\Filament\Resources\LostAndFoundCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLostAndFoundCategory extends CreateRecord
{
    protected static string $resource = LostAndFoundCategoryResource::class;

    protected static ?string $title = 'Formulaire de création';

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
