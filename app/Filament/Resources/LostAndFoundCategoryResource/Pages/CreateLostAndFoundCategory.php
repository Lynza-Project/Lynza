<?php

namespace App\Filament\Resources\LostAndFoundCategoryResource\Pages;

use App\Filament\Resources\LostAndFoundCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLostAndFoundCategory extends CreateRecord
{
    protected static string $resource = LostAndFoundCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
