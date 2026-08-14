<?php

namespace App\Filament\Resources\Personels;

use App\Filament\Resources\Personels\Pages\CreatePersonel;
use App\Filament\Resources\Personels\Pages\EditPersonel;
use App\Filament\Resources\Personels\Pages\ListPersonels;
use App\Filament\Resources\Personels\Pages\ViewPersonel;
use App\Filament\Resources\Personels\Schemas\PersonelForm;
use App\Filament\Resources\Personels\Tables\PersonelsTable;
use App\Models\Personel;
use App\Support\AccessControl;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PersonelResource extends Resource
{
    protected static ?string $model = Personel::class;

    protected static string|\UnitEnum|null $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Personel';

    protected static ?string $modelLabel = 'Personel';

    protected static ?string $pluralModelLabel = 'Data Personel';

    protected static string|\BackedEnum|null $navigationIcon =
        Heroicon::OutlinedUsers;

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'nama';

    public static function shouldRegisterNavigation(): bool
    {
        return AccessControl::hasAnyRole([
            'admin_bidkum',
            'kasubbid_bankum',
            'super_admin',
        ]);
    }

    public static function canViewAny(): bool
    {
        return AccessControl::hasAnyRole([
            'admin_bidkum',
            'kasubbid_bankum',
            'super_admin',
            'wabprof',
        ]);
    }

    public static function canCreate(): bool
    {
        return AccessControl::hasAnyRole([
            'admin_bidkum',
            'super_admin',
        ]);
    }

    public static function canEdit($record): bool
    {
        return AccessControl::hasAnyRole([
            'admin_bidkum',
            'super_admin',
        ]);
    }

    public static function canDelete($record): bool
    {
        return AccessControl::hasAnyRole([
            'admin_bidkum',
            'super_admin',
        ]);
    }

    public static function form(Schema $schema): Schema
    {
        return PersonelForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PersonelsTable::configure($table)
            ->defaultSort('nama');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPersonels::route('/'),
            'create' => CreatePersonel::route('/create'),
            'view' => ViewPersonel::route('/{record}'),
            'edit' => EditPersonel::route('/{record}/edit'),
        ];
    }
}