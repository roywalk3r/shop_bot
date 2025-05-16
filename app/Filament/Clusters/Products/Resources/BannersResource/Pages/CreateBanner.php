<?php

namespace App\Filament\Clusters\Products\Resources\BannersResource\Pages;

use App\Filament\Clusters\Products\Resources\BannersResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBanner extends CreateRecord
{
    protected static string $resource = BannersResource::class;
    protected static ?string $title ="Create a new Banner";
}