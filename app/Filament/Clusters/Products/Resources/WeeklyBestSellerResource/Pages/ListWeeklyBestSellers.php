<?php

namespace App\Filament\Clusters\Products\Resources\WeeklyBestSellerResource\Pages;

use App\Filament\Clusters\Products\Resources\WeeklyBestSellerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWeeklyBestSellers extends ListRecords
{
    protected static string $resource = WeeklyBestSellerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
