<?php

namespace App\Filament\Resources\LostAndFoundResource\Pages;

use App\Filament\Resources\LostAndFoundResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLostAndFound extends CreateRecord
{
    protected static string $resource = LostAndFoundResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
