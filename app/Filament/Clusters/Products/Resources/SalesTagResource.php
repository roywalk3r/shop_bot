<?php

namespace App\Filament\Clusters\Products\Resources;

use App\Filament\Clusters\Products;
use App\Filament\Clusters\Products\Resources\SalesTagResource\Pages;
use App\Filament\Clusters\Products\Resources\SalesTagResource\RelationManagers;
use App\Models\SalesTag;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SalesTagResource extends Resource
{
    protected static ?string $model = SalesTag::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $cluster = Products::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->columnSpan('full')->label('create a sales tag')
                ->helperText('examples "hot","sale","new" ')
                ->maxLength(255)
                        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Sales Tags')
                ->searchable(isIndividual: true)
                ->sortable(),            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListSalesTags::route('/'),
            'create' => Pages\CreateSalesTag::route('/create'),
            'edit' => Pages\EditSalesTag::route('/{record}/edit'),
        ];
    }
}