<?php

namespace App\Filament\Clusters\Products\Resources\SalesTagResource\Pages;

use App\Filament\Clusters\Products\Resources\SalesTagResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSalesTags extends ListRecords
{
    protected static string $resource = SalesTagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
