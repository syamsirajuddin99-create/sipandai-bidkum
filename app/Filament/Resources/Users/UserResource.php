<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Pages\ViewUser;
use App\Models\Satker;
use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Support\AccessControl;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Master User';

    protected static ?string $modelLabel = 'User';

    protected static ?string $pluralModelLabel = 'User';

    protected static string|\UnitEnum|null $navigationGroup = 'Master Data';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama User')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->revealable()
                    ->dehydrateStateUsing(
                        fn (?string $state): ?string =>
                            filled($state) ? $state : null
                    )
                    ->dehydrated(
                        fn (?string $state): bool => filled($state)
                    )
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->minLength(8),

                Select::make('satker_id')
                    ->label('Satker')
                    ->options(
                        fn () => Satker::query()
                            ->where('is_active', true)
                            ->orderBy('nama')
                            ->pluck('nama', 'id')
                    )
                    ->searchable()
                    ->preload()
                    ->nullable(),

                Select::make('roles')
                    ->label('Role')
                    ->relationship(
                        name: 'roles',
                        titleAttribute: 'name',
                    )
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->required(),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('satker.nama')
                    ->label('Satker')
                    ->searchable()
                    ->sortable()
                    ->placeholder('-'),

                TextColumn::make('roles.name')
                    ->label('Role')
                    ->badge()
                    ->separator(', '),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('name')
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make()
                    ->before(function (User $record): void {
                        if ($record->hasRole('super_admin')) {
                            throw new \RuntimeException(
                                'Super Admin tidak boleh dihapus dari menu ini.'
                            );
                        }
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'view' => ViewUser::route('/{record}'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['satker', 'roles']);
    }

public static function shouldRegisterNavigation(): bool
{
    return AccessControl::hasRole('super_admin');
}

public static function canViewAny(): bool
{
    return AccessControl::hasRole('super_admin');
}

public static function canCreate(): bool
{
    return AccessControl::hasRole('super_admin');
}

public static function canEdit($record): bool
{
    return AccessControl::hasRole('super_admin');
}

public static function canDelete($record): bool
{
    return AccessControl::hasRole('super_admin');
}

}