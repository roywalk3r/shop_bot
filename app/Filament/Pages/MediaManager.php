<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class MediaManager extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static string $view = 'filament.pages.media-manager';
}