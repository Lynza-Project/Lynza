<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LostAndFoundResource\Pages;
use App\Models\LostAndFound;
use App\Models\LostAndFoundCategory;
use App\Models\Organization;
use Exception;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LostAndFoundResource extends Resource
{
    protected static ?string $model = LostAndFound::class;

    protected static ?string $slug = 'lost-and-founds';

    protected static ?string $breadcrumb = 'Objets perdus/trouvés';

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    protected static ?string $navigationLabel = 'Objets perdus/trouvés';

    protected static ?string $label = 'Gestion des objets perdus/trouvés';

    public static function getNavigationBadge(): ?string
    {
        return LostAndFound::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('organization_id')
                    ->label('Organisation')
                    ->relationship('organization', 'name')
                    ->searchable()
                    ->options(
                        fn() => Organization::all()->pluck('name', 'id')->toArray()
                    )
                    ->required(),

                TextInput::make('title')
                    ->label('Titre')
                    ->required(),

                TextInput::make('description')
                    ->label('Description')
                    ->required(),

                Select::make('lost_and_found_category_id')
                    ->label('Catégorie')
                    ->relationship('lostAndFoundCategory', 'name')
                    ->searchable()
                    ->options(
                        fn() => LostAndFoundCategory::all()->pluck('name', 'id')->toArray()
                    )
                    ->required(),

                TextInput::make('location')
                    ->label('Lieu')
                    ->required(),

                Select::make('status')
                    ->label('Statut')
                    ->options([
                        'lost' => 'Perdu',
                        'found' => 'Trouvé',
                    ])
                    ->required(),

                Section::make('Informations')
                    ->columns()
                    ->schema([
                        Placeholder::make('created_at')
                            ->label('Créé le')
                            ->content(fn(?LostAndFound $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                        Placeholder::make('updated_at')
                            ->label('Mis à jour le')
                            ->content(fn(?LostAndFound $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
                    ]),
            ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('organization.name')
                    ->label('Organisation')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description')->label('Description'),

                TextColumn::make('lostAndFoundCategory.name')
                    ->label('Catégorie')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('location')->label('Lieu'),

                TextColumn::make('status')->label('Statut')
                    ->badge()
                    ->colors([
                        'success' => 'found',
                        'danger' => 'lost',
                    ])
                    ->formatStateUsing(function (string $state): string {
                        return match ($state) {
                            'found' => 'Trouvé',
                            'lost' => 'Perdu',
                            default => $state,
                        };
                    },
                    ),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLostAndFounds::route('/'),
            'create' => Pages\CreateLostAndFound::route('/create'),
            'edit' => Pages\EditLostAndFound::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['organization', 'lostAndFoundCategory']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'organization.name', 'lostAndFoundCategory.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->organization) {
            $details['Organization'] = $record->organization->name;
        }

        if ($record->lostAndFoundCategory) {
            $details['LostAndFoundCategory'] = $record->lostAndFoundCategory->name;
        }

        return $details;
    }
}
