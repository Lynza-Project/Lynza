<?php

namespace App\Filament\Resources\LostAndFoundResource\Pages;

use App\Filament\Resources\LostAndFoundResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLostAndFounds extends ListRecords
{
    protected static string $resource = LostAndFoundResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
