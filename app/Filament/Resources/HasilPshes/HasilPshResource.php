<?php

namespace App\Filament\Resources\HasilPshes;

use App\Filament\Resources\HasilPshes\Pages\CreateHasilPsh;
use App\Filament\Resources\HasilPshes\Pages\EditHasilPsh;
use App\Filament\Resources\HasilPshes\Pages\ListHasilPshes;
use App\Filament\Resources\HasilPshes\Pages\ViewHasilPsh;
use App\Filament\Resources\HasilPshes\Schemas\HasilPshForm;
use App\Filament\Resources\HasilPshes\Tables\HasilPshesTable;
use App\Models\HasilPsh;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Support\AccessControl;

class HasilPshResource extends Resource
{
    protected static ?string $model = HasilPsh::class;

    protected static string|\UnitEnum|null $navigationGroup = 'PSH';

    protected static ?string $navigationLabel = 'Penyelesaian PSH';

    protected static ?string $modelLabel = 'Penyelesaian PSH';

    protected static ?string $pluralModelLabel = 'Penyelesaian PSH';

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedCheckCircle;

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return HasilPshForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HasilPshesTable::configure($table)
            ->defaultSort('waktu_upload', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHasilPshes::route('/'),
            'create' => CreateHasilPsh::route('/create'),
            'view' => ViewHasilPsh::route('/{record}'),
            'edit' => EditHasilPsh::route('/{record}/edit'),
        ];
    }

public static function shouldRegisterNavigation(): bool
{
    return AccessControl::hasAnyRole([
        'admin_bidkum',
        'super_admin',
    ]);
}

public static function canViewAny(): bool
{
    return AccessControl::hasAnyRole([
        'admin_bidkum',
        'super_admin',
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

}