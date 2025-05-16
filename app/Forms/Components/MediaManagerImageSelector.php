<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\ComponentContainer;
use Filament\Forms;

class MediaManagerImageSelector extends ComponentContainer
{
    protected $name = 'media-manager-image-selector';

    protected function setUp()
    {
        $this->schema([
            Forms\Components\Button::make('open_media_manager')
                ->label('Select Image')
                ->onClick(fn () => $this->emit('openMediaManager')), // Emit an event to open the media manager
                Forms\Components\Hidden::make('selected_image'), // Hidden field to store the URL of the selected image
                Forms\Components\Image::make('preview_image')->label('Selected Image')->if(fn () => $this->getValue('selected_image')), // Display the selected image if one is selected
        ]);
    }
}