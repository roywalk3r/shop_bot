<?php

namespace App\Filament\Clusters\Products\Resources\WeeklyBestSellerResource\Pages;

use App\Filament\Clusters\Products\Resources\WeeklyBestSellerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWeeklyBestSeller extends EditRecord
{
    protected static string $resource = WeeklyBestSellerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
