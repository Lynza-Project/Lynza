<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganizationResource\Pages;
use App\Models\Address;
use App\Models\Organization;
use App\Models\Theme;
use Filament\Forms\Components\FileUpload;
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
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class OrganizationResource extends Resource
{
    protected static ?string $model = Organization::class;

    protected static ?string $slug = 'organizations';

    protected static ?string $breadcrumb = 'Organisations';

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Organisations';

    protected static ?string $label = 'Gestion des organisations';

    public static function getNavigationBadge(): ?string
    {
        return Organization::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nom')
                    ->required(),

                Select::make('address_id')
                    ->label('Adresse')
                    ->relationship('address', 'name')
                    ->searchable()
                    ->options(
                        fn() => Address::all()->pluck('name', 'id')->toArray()
                    )
                    ->required(),

                Select::make('theme_id')
                    ->label('Thème')
                    ->relationship('theme', 'title')
                    ->searchable()
                    ->options(
                        fn() => Theme::all()->pluck('title', 'id')->toArray()
                    )
                    ->required(),

                Select::make('type')
                    ->label('Type')
                    ->options([
                        'school' => 'École',
                        'company' => 'Entreprise',
                        'association' => 'Association',
                    ])
                    ->required(),

                FileUpload::make('logo')
                    ->label('Logo')
                    ->placeholder('Sélectionner une photo')
                    ->image()
                    ->disk('minio')
                    ->directory('organization_logo')
                    ->visibility('private')
                    ->deleteUploadedFileUsing(function ($file, $record) {
                        if ($record && $record->logo) {
                            Storage::disk('minio')->delete($record->logo);
                        }
                    }),

                Section::make('Informations')
                    ->columns()
                    ->schema([
                        Placeholder::make('created_at')
                            ->label('Créé le')
                            ->content(fn(?Organization $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                        Placeholder::make('updated_at')
                            ->label('Mis à jour le')
                            ->content(fn(?Organization $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('address.name')
                    ->label('Adresse')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('theme.title')
                    ->label('Thème')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('type')->label('Type')
                    ->badge()
                    ->colors([
                        'success' => 'school',
                        'danger' => 'company',
                    ])
                    ->formatStateUsing(function (string $state): string {
                        return match ($state) {
                            'school' => 'École',
                            'company' => 'Entreprise',
                            'association' => 'Association',
                            default => $state,
                        };
                    },
                    ),

                ImageColumn::make('logo_url')
                    ->label('Logo')
                    ->disk('minio')
                    ->sortable(),
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
            'index' => Pages\ListOrganizations::route('/'),
            'create' => Pages\CreateOrganization::route('/create'),
            'edit' => Pages\EditOrganization::route('/{record}/edit'),
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
        return parent::getGlobalSearchEloquentQuery()->with(['address', 'theme']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'address.name', 'theme.title'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->address) {
            $details['Address'] = $record->address->name;
        }

        if ($record->theme) {
            $details['Theme'] = $record->theme->title;
        }

        return $details;
    }
}
