<?php

namespace App\Filament\Clusters\Products\Resources\SalesTagResource\Pages;

use App\Filament\Clusters\Products\Resources\SalesTagResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSalesTag extends EditRecord
{
    protected static string $resource = SalesTagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
