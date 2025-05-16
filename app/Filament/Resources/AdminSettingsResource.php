<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminSettingsResource\Pages;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Models\AdminSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
class AdminSettingsResource extends Resource implements HasMedia
{
    use InteractsWithMedia;

    protected static ?string $model = AdminSettings::class;
    protected static ?string $title = "Admins";

    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';

    public static function form(Form $form): Form
    {
        return $form
                      ->schema([
                    
                                RichEditor::make('short_des')
                                    ->required()
                                    ->label('Short Description for footer')
                                    ->maxLength(65535)
                                    ->columnSpan('full'),
                                RichEditor::make('description')
                                    ->required()
                                    ->label('Description for about us')
                                    ->maxLength(65535)
                                    ->columnSpan('full'),
                                Forms\Components\Section::make('Images')
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('logo')
                                            ->collection('logo')
                                            ->label('Footer Logo')
                                            ->hiddenLabel()
                                            ->image()
                                            ->imageEditor()
                                            ->visibility('public')
                                            ->columnSpan('full'),
                                    ])
                                    ->collapsible()
                                      ->columnSpan('full'),
                                      Forms\Components\Section::make('Images')
                                      ->schema([
                                          SpatieMediaLibraryFileUpload::make('photo')
                                              ->collection('blog')
                                              ->label('Footer Logo')
                                              ->hiddenLabel()
                                              ->image()
                                              ->imageEditor()
                                              ->visibility('public')
                                              ->columnSpan('full'),
                                      ])
                                      ->collapsible()
                                        ->columnSpan('full'),
                         TextInput::make('address')->required()->columnSpan('full'),
                        TextInput::make('Email')->required()->email()->columnSpan('full'),
                        TextInput::make('phone')->required()->tel()->columnSpan('full')
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),            
                                    ]);
                 
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('photo')
                    ->label('blog photo')
                    ->collection('blog'),
                    Tables\Columns\SpatieMediaLibraryImageColumn::make('logo')
                    ->label('footer logo')
                    ->collection('logo'),

                Tables\Columns\TextColumn::make('email')
                    ->label('email')
                    ->searchable()
                     ->sortable(),

                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->sortable()
                     ->toggleable(),
                     Tables\Columns\TextColumn::make('address')
                     ->searchable()
                     ->sortable()
                      ->toggleable(),
 
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Publish Date')
                    ->date()
                    ->sortable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Update')
                    ->date()
                    ->sortable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
            ])
            ->filters([
                 
                // Tables\Filters\TrashedFilter::make(),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->placeholder(fn ($state): string => 'Dec 18, ' . now()->subYear()->format('Y')),
                        Forms\Components\DatePicker::make('created_until')
                            ->placeholder(fn ($state): string => now()->format('M d, Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators['created_from'] = 'Order from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'Order until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])          
             ->groupedBulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->action(function () {
                        //
                    }),
            ]);
    }


    public static function getRelations(): array
    {
        return [
            // Define your relations here
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdminSettings::route('/'),
            'create' => Pages\CreateAdminSettings::route('/create'),
            'edit' => Pages\EditAdminSettings::route('/{record}/edit'),
        ];
    }
}