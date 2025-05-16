<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\MediaManagerResource\Pages;
use App\Filament\App\Resources\MediaManagerResource\RelationManagers;
use App\Models\MediaManager;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MediaManagerResource extends Resource
{
    protected static ?string $model = MediaManager::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMediaManagers::route('/'),
            'create' => Pages\CreateMediaManager::route('/create'),
            'view' => Pages\ViewMediaManager::route('/{record}'),
            'edit' => Pages\EditMediaManager::route('/{record}/edit'),
        ];
    }
}
