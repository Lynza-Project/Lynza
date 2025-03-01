<?php

namespace App\Filament\Resources\TicketMessageResource\Pages;

use App\Filament\Resources\TicketMessageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTicketMessage extends CreateRecord
{
    protected static string $resource = TicketMessageResource::class;

    protected static ?string $title = 'Formulaire de création';

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
