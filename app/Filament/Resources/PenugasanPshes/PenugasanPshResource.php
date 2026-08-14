<?php

namespace App\Filament\Resources\PenugasanPshes;

use App\Filament\Resources\PenugasanPshes\Pages\CreatePenugasanPsh;
use App\Filament\Resources\PenugasanPshes\Pages\EditPenugasanPsh;
use App\Filament\Resources\PenugasanPshes\Pages\ListPenugasanPshes;
use App\Filament\Resources\PenugasanPshes\Pages\ViewPenugasanPsh;
use App\Filament\Resources\PenugasanPshes\Schemas\PenugasanPshForm;
use App\Filament\Resources\PenugasanPshes\Tables\PenugasanPshesTable;
use App\Models\PenugasanPsh;
use App\Support\AccessControl;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PenugasanPshResource extends Resource
{
    protected static ?string $model = PenugasanPsh::class;

    protected static string|\UnitEnum|null $navigationGroup = 'PSH';

    protected static ?string $navigationLabel = 'Penugasan Personel';

    protected static ?string $modelLabel = 'Penugasan PSH';

    protected static ?string $pluralModelLabel = 'Penugasan Personel PSH';

    protected static string|\BackedEnum|null $navigationIcon =
        Heroicon::OutlinedUserPlus;

    protected static ?int $navigationSort = 5;

    public static function shouldRegisterNavigation(): bool
    {
        return AccessControl::hasAnyRole([
            'kasubbid_bankum',
            'super_admin',
            'wabprof',
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
        return PenugasanPshForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PenugasanPshesTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with([
                'disposisiKasubbid.pengajuanPsh',
                'pengajuanPsh.satker',
                'personel',
                'ditugaskanOleh',
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPenugasanPshes::route('/'),
            'create' => CreatePenugasanPsh::route('/create'),
            'view' => ViewPenugasanPsh::route('/{record}'),
            'edit' => EditPenugasanPsh::route('/{record}/edit'),
        ];
    }
}