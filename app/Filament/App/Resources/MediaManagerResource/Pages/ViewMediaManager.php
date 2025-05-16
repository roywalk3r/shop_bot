<?php

namespace App\Filament\App\Resources\MediaManagerResource\Pages;

use App\Filament\App\Resources\MediaManagerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMediaManager extends ViewRecord
{
    protected static string $resource = MediaManagerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
