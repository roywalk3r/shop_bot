<?php

namespace App\Filament\Clusters\Products\Resources\WeeklyBestSellerResource\Pages;

use App\Filament\Clusters\Products\Resources\WeeklyBestSellerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWeeklyBestSeller extends CreateRecord
{
    protected static string $resource = WeeklyBestSellerResource::class;
}
