<?php

namespace App\Filament\Resources\Disposisis;

use App\Filament\Resources\Disposisis\Pages\CreateDisposisi;
use App\Filament\Resources\Disposisis\Pages\EditDisposisi;
use App\Filament\Resources\Disposisis\Pages\ListDisposisis;
use App\Filament\Resources\Disposisis\Pages\ViewDisposisi;
use App\Filament\Resources\Disposisis\Schemas\DisposisiForm;
use App\Filament\Resources\Disposisis\Tables\DisposisisTable;
use App\Models\Disposisi;
use App\Support\AccessControl;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DisposisiResource extends Resource
{
    protected static ?string $model = Disposisi::class;

    protected static string|\UnitEnum|null $navigationGroup = 'PSH';

    protected static ?string $navigationLabel = 'Disposisi Pimpinan';

    protected static ?string $modelLabel = 'Disposisi Pimpinan';

    protected static ?string $pluralModelLabel = 'Disposisi Pimpinan';

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentArrowDown;

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return DisposisiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DisposisisTable::configure($table)
            ->defaultSort('waktu_disposisi', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDisposisis::route('/'),
            'create' => CreateDisposisi::route('/create'),
            'view' => ViewDisposisi::route('/{record}'),
            'edit' => EditDisposisi::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return AccessControl::hasAnyRole([
            'bidkum',
            'super_admin',
        ]);
    }

    public static function canViewAny(): bool
    {
        return AccessControl::hasAnyRole([
            'bidkum',
            'super_admin',
        ]);
    }

    public static function canCreate(): bool
    {
        return AccessControl::hasAnyRole([
            'bidkum',
            'super_admin',
        ]);
    }

    public static function canEdit($record): bool
    {
        return AccessControl::hasAnyRole([
            'bidkum',
            'super_admin',
        ]);
    }

    public static function canDelete($record): bool
    {
        return AccessControl::hasAnyRole([
            'bidkum',
            'super_admin',
        ]);
    }
}





// namespace App\Filament\Resources\Disposisis;

// use App\Filament\Resources\Disposisis\Pages\CreateDisposisi;
// use App\Filament\Resources\Disposisis\Pages\EditDisposisi;
// use App\Filament\Resources\Disposisis\Pages\ListDisposisis;
// use App\Filament\Resources\Disposisis\Pages\ViewDisposisi;
// use App\Filament\Resources\Disposisis\Schemas\DisposisiForm;
// use App\Filament\Resources\Disposisis\Tables\DisposisisTable;
// use App\Models\Disposisi;
// use Filament\Resources\Resource;
// use Filament\Schemas\Schema;
// use Filament\Support\Icons\Heroicon;
// use Filament\Tables\Table;
// use App\Support\AccessControl;

// class DisposisiResource extends Resource
// {
//     protected static ?string $model = Disposisi::class;

//     protected static string|\UnitEnum|null $navigationGroup = 'PSH';

//     protected static ?string $navigationLabel = 'Disposisi Pimpinan';

//     protected static ?string $modelLabel = 'Disposisi Pimpinan';

//     protected static ?string $pluralModelLabel = 'Disposisi Pimpinan';

//     protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentArrowDown;

//     protected static ?int $navigationSort = 3;

//     public static function form(Schema $schema): Schema
//     {
//         return DisposisiForm::configure($schema);
//     }

//     public static function table(Table $table): Table
//     {
//         return DisposisisTable::configure($table)
//             ->defaultSort('waktu_disposisi', 'desc');
//     }

//     public static function getPages(): array
//     {
//         return [
//             'index' => ListDisposisis::route('/'),
//             'create' => CreateDisposisi::route('/create'),
//             'view' => ViewDisposisi::route('/{record}'),
//             'edit' => EditDisposisi::route('/{record}/edit'),
//         ];
//     }

// public static function shouldRegisterNavigation(): bool
// {
//     return AccessControl::hasAnyRole([
//         'bidkum',
//         'super_admin',
//     ]);
// }

// public static function canViewAny(): bool
// {
//     return AccessControl::hasAnyRole([
//         'bidkum',
//         'super_admin',
//     ]);
// }

// public static function canCreate(): bool
// {
//     return AccessControl::hasAnyRole([
//         'bidkum',
//         'super_admin',
//     ]);
// }

// public static function canEdit($record): bool
// {
//     return AccessControl::hasAnyRole([
//         'bidkum',
//         'super_admin',
//     ]);
// }

// public static function canDelete($record): bool
// {
//     return AccessControl::hasAnyRole([
//         'bidkum',
//         'super_admin',
//     ]);
// }

// }