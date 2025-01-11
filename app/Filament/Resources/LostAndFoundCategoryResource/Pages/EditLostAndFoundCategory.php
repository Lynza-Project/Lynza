<?php

namespace App\Filament\Resources\LostAndFoundCategoryResource\Pages;

use App\Filament\Resources\LostAndFoundCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditLostAndFoundCategory extends EditRecord
{
    protected static string $resource = LostAndFoundCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
