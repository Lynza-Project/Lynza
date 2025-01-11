<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LostAndFoundResource\Pages;
use App\Models\LostAndFound;
use Filament\Forms\Components\Placeholder;
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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('organization_id')
                    ->relationship('organization', 'name')
                    ->searchable()
                    ->required(),

                TextInput::make('title')
                    ->required(),

                TextInput::make('description')
                    ->required(),

                Select::make('lost_and_found_category_id')
                    ->relationship('lostAndFoundCategory', 'name')
                    ->searchable()
                    ->required(),

                TextInput::make('location')
                    ->required(),

                TextInput::make('status')
                    ->required(),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?LostAndFound $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?LostAndFound $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('organization.name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description'),

                TextColumn::make('lostAndFoundCategory.name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('location'),

                TextColumn::make('status'),
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
