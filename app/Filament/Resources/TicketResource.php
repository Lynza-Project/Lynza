<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\RelationManagers\MessageRelationManager;
use App\Models\Organization;
use App\Models\Ticket;
use App\Models\User;
use Filament\Forms\Components\MarkdownEditor;
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

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $slug = 'tickets';

    protected static ?string $breadcrumb = 'Tickets';

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationLabel = 'Tickets';

    protected static ?string $label = 'Gestion des tickets';

    public static function getNavigationBadge(): ?string
    {
        return Ticket::count();
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
                        fn() => Organization::all()->pluck('name', 'id')
                    )
                    ->required(),

                Select::make('user_id')
                    ->label('Utilisateur')
                    ->relationship('user', 'email')
                    ->searchable()
                    ->options(
                        fn() => User::all()->pluck('email', 'id')
                    )
                    ->required(),

                TextInput::make('subject')
                    ->label('Sujet')
                    ->required(),

                Select::make('status')
                    ->label('Statut')
                    ->options([
                        'open' => 'Ouvert',
                        'closed' => 'Fermé',
                    ])
                    ->required(),

                MarkdownEditor::make('description')
                    ->label('Description')
                    ->columnSpanFull()
                    ->required(),

                Section::make('Informations')
                    ->columns()
                    ->schema([
                        Placeholder::make('created_at')
                            ->label('Créé le')
                            ->content(fn(?Ticket $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                        Placeholder::make('updated_at')
                            ->label('Mis à jour le')
                            ->content(fn(?Ticket $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
                    ]),
            ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('organization.name')
                    ->label('Organisation')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user.email')
                    ->label('Utilisateur')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('subject')->label('Sujet'),

                TextColumn::make('description')->label('Description'),

                TextColumn::make('status')
                    ->label('Statut')
                    ->colors([
                        'success' => 'open',
                        'danger' => 'closed',
                    ])
                    ->badge()
                    ->formatStateUsing(function (string $state): string {
                        return match ($state) {
                            'open' => 'Ouvert',
                            'closed' => 'Fermé',
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
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
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
        return parent::getGlobalSearchEloquentQuery()->with(['organization', 'user']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['organization.name', 'user.email'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->organization) {
            $details['Organization'] = $record->organization->name;
        }

        if ($record->user) {
            $details['User'] = $record->user->email;
        }

        return $details;
    }

    public static function getRelations(): array
    {
        return [
            MessageRelationManager::class,
        ];
    }
}
