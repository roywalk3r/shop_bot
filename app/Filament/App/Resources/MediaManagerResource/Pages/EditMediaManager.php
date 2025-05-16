<?php

namespace App\Filament\App\Resources\MediaManagerResource\Pages;

use App\Filament\App\Resources\MediaManagerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMediaManager extends EditRecord
{
    protected static string $resource = MediaManagerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
