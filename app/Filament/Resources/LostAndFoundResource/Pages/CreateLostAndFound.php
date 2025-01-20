<?php

namespace App\Filament\Resources\LostAndFoundResource\Pages;

use App\Filament\Resources\LostAndFoundResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLostAndFound extends CreateRecord
{
    protected static string $resource = LostAndFoundResource::class;

    protected static ?string $title = 'Formulaire de création';

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
