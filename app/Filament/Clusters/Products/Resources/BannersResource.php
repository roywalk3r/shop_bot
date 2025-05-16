<?php

namespace App\Filament\Clusters\Products\Resources;

use App\Filament\Clusters\Products;
use App\Filament\Clusters\Products\Resources\BannersResource\Pages;
use App\Filament\Clusters\Products\Resources\BannersResource\RelationManagers;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

use App\Models\Banners;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
 class BannersResource extends Resource implements HasMedia
{
    use InteractsWithMedia;

    protected static ?string $model = Banners::class;
     protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $title ="Banners";
    protected static ?string $cluster = Products::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required()->columnSpan('full')
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

            Forms\Components\TextInput::make('slug')
                ->disabled()
                ->dehydrated()
                ->required()
                ->maxLength(255)->columnSpan('full')
                ->unique(Banners::class, 'slug', ignoreRecord: true),
                RichEditor::make('description')
                ->required()
                ->label('description for banner')
                ->maxLength(65535)
                ->columnSpan('full'),
                Forms\Components\Section::make('Images')
                                      ->schema([
                                          SpatieMediaLibraryFileUpload::make('photo')
                                              ->collection('banners')
                                              ->label('Banner')
                                              ->hiddenLabel()
                                              ->image()
                                              ->imageEditor()
                                              ->visibility('public')
                                              ->required()
                                              ->columnSpan('full'),
                                      ])
                                      ->collapsible()
                                        ->columnSpan('full'),
                                        Forms\Components\Group::make()
                                        ->schema([
                                            Forms\Components\Section::make('Status')
                                                ->schema([
                                                   
                                                    Forms\Components\DatePicker::make('updated_at')
                                                        ->label('Update At')
                                                        ->default(now())
                                                        ->required(),

                                                Forms\Components\Select::make('position')
                                                ->label('Title position')
                                                ->options([
                                                    'top' => 'top',
                                                    'right' => 'right',
                                                    'center'=>'center',
                                                    'left' => 'left',
                                                    'bottom' => 'bottom',
                                                ])
                                                ->default('center')
                                                ->native(false)                                                ->required(),
                                            ]),
                     
                                        ])
                                        ->columnSpan(['lg' => 1]),    
                                        Forms\Components\Group::make()
                                        ->schema([
                                            Forms\Components\Section::make('Status')
                                                ->schema([
                                                    Forms\Components\Select::make('status')
                                                    ->options([
                                                        'active' => 'Active',
                                                        'inactive' => 'Inactive',
                                                    ])  ->native(false)
                                                        ->default('inactive')
                                                       ->required(),

                    
                                                    Forms\Components\DatePicker::make('created_at')
                                                        ->label('Availability')
                                                        ->default(now())
                                                        ->required(),
                                                ]),
                     
                                        ])
                                        ->columnSpan(['lg' => 1]),                       
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                ->label('Title')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                ->label('Slug')
                ->searchable()
                ->sortable(),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('photo')
                ->label('banner')
                ->collection('banners'),
                Tables\Columns\TextColumn::make('status')
                ->label('Status')
                ->searchable()
                ->sortable(),
                ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                ->options([
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                 ])->native(false),
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
                    }),            ])
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanners::route('/{record}/edit'),
        ];
    }
}