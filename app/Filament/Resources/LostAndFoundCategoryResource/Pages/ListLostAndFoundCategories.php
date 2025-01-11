<?php

namespace App\Filament\Resources\LostAndFoundCategoryResource\Pages;

use App\Filament\Resources\LostAndFoundCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLostAndFoundCategories extends ListRecords
{
    protected static string $resource = LostAndFoundCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
