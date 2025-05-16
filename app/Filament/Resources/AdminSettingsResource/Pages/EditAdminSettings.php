<?php

namespace App\Filament\Resources\AdminSettingsResource\Pages;

use App\Filament\Resources\AdminSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdminSettings extends EditRecord
{
    protected static string $resource = AdminSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
