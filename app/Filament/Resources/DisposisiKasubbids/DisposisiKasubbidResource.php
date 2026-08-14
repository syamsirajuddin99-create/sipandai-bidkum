<?php

namespace App\Filament\Resources\DisposisiKasubbids;

use App\Filament\Resources\DisposisiKasubbids\Pages\CreateDisposisiKasubbid;
use App\Filament\Resources\DisposisiKasubbids\Pages\EditDisposisiKasubbid;
use App\Filament\Resources\DisposisiKasubbids\Pages\ListDisposisiKasubbids;
use App\Filament\Resources\DisposisiKasubbids\Schemas\DisposisiKasubbidForm;
use App\Filament\Resources\DisposisiKasubbids\Tables\DisposisiKasubbidsTable;
use App\Models\DisposisiKasubbid;
use App\Support\AccessControl;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DisposisiKasubbids\Pages\ViewDisposisiKasubbid;
use App\Filament\Resources\DisposisiKasubbids\Schemas\DisposisiKasubbidInfolist;

class DisposisiKasubbidResource extends Resource
{
    protected static ?string $model = DisposisiKasubbid::class;

    protected static string|\UnitEnum|null $navigationGroup = 'PSH';

    protected static ?string $navigationLabel = 'Disposisi Kasubbid';

    protected static ?string $modelLabel = 'Disposisi Kasubbid';

    protected static ?string $pluralModelLabel = 'Disposisi Kasubbid';

    protected static string|\BackedEnum|null $navigationIcon =
        Heroicon::OutlinedUserGroup;

    protected static ?int $navigationSort = 4;

    public static function shouldRegisterNavigation(): bool
    {
        return AccessControl::hasAnyRole([
            'kasubbid_bankum',
            'super_admin',
        ]);
    }

    public static function canViewAny(): bool
    {
        return AccessControl::hasAnyRole([
            'kasubbid_bankum',
            'super_admin',
            'wabprof',
        ]);
    }

    public static function canCreate(): bool
    {
        return AccessControl::hasAnyRole([
            'kasubbid_bankum',
            'super_admin',
        ]);
    }

    public static function canEdit($record): bool
    {
        return AccessControl::hasAnyRole([
            'kasubbid_bankum',
            'super_admin',
        ]);
    }

    public static function canDelete($record): bool
    {
        return AccessControl::hasAnyRole([
            'kasubbid_bankum',
            'super_admin',
        ]);
    }

    public static function form(Schema $schema): Schema
    {
        return DisposisiKasubbidForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DisposisiKasubbidsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with([
                'pengajuanPsh.satker',
                'disposisi',
                'user',
                'penugasanPshes.personel',
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDisposisiKasubbids::route('/'),
            'create' => CreateDisposisiKasubbid::route('/create'),
            'view' => ViewDisposisiKasubbid::route('/{record}'),
            'edit' => EditDisposisiKasubbid::route('/{record}/edit'),
        ];
    }

    public static function infolist(Schema $schema): Schema
{
    return DisposisiKasubbidInfolist::configure($schema);
}
    
}