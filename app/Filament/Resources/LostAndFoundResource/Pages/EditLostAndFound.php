<?php

namespace App\Filament\Resources\LostAndFoundResource\Pages;

use App\Filament\Resources\LostAndFoundResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditLostAndFound extends EditRecord
{
    protected static string $resource = LostAndFoundResource::class;

    protected static ?string $title = 'Formulaire de modification';

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
