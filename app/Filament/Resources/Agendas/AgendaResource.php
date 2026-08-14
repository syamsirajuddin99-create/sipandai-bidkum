<?php

namespace App\Filament\Resources\Agendas;

use App\Filament\Resources\Agendas\Pages\CreateAgenda;
use App\Filament\Resources\Agendas\Pages\EditAgenda;
use App\Filament\Resources\Agendas\Pages\ListAgendas;
use App\Filament\Resources\Agendas\Pages\ViewAgenda;
use App\Filament\Resources\Agendas\Schemas\AgendaForm;
use App\Filament\Resources\Agendas\Schemas\AgendaInfolist;
use App\Filament\Resources\Agendas\Tables\AgendasTable;
use App\Models\Agenda;
use App\Support\AccessControl;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AgendaResource extends Resource
{
    protected static ?string $model = Agenda::class;

    protected static string|\UnitEnum|null $navigationGroup = 'PSH';

    protected static ?string $navigationLabel = 'Verifikasi & Agenda';

    protected static ?string $modelLabel = 'Agenda PSH';

    protected static ?string $pluralModelLabel = 'Verifikasi & Agenda';

    protected static string|\BackedEnum|null $navigationIcon =
        Heroicon::OutlinedClipboardDocumentCheck;

    protected static ?int $navigationSort = 2;

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

    public static function form(Schema $schema): Schema
    {
        return AgendaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AgendaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AgendasTable::configure($table)
            ->defaultSort('waktu_agenda', 'desc');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with([
                'pengajuanPsh.satker',
                'pengajuanPsh.statusProgres',
                'user',
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAgendas::route('/'),
            'create' => CreateAgenda::route('/create'),
            'view' => ViewAgenda::route('/{record}'),
            'edit' => EditAgenda::route('/{record}/edit'),
        ];
    }
}


// namespace App\Filament\Resources\Agendas;

// use App\Filament\Resources\Agendas\Pages\CreateAgenda;
// use App\Filament\Resources\Agendas\Pages\EditAgenda;
// use App\Filament\Resources\Agendas\Pages\ListAgendas;
// use App\Filament\Resources\Agendas\Pages\ViewAgenda;
// use App\Filament\Resources\Agendas\Schemas\AgendaForm;
// use App\Filament\Resources\Agendas\Tables\AgendasTable;
// use App\Models\Agenda;
// use App\Models\User;
// use Filament\Resources\Resource;
// use Filament\Schemas\Schema;
// use Filament\Support\Icons\Heroicon;
// use Filament\Tables\Table;
// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Support\Facades\Auth;

// class AgendaResource extends Resource
// {
//     protected static ?string $model = Agenda::class;

//     protected static string|\UnitEnum|null $navigationGroup = 'PSH';

//     protected static ?string $navigationLabel = 'Verifikasi & Agenda';

//     protected static ?string $modelLabel = 'Agenda PSH';

//     protected static ?string $pluralModelLabel = 'Verifikasi & Agenda';

//     protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

//     protected static ?int $navigationSort = 2;

//     public static function form(Schema $schema): Schema
//     {
//         return AgendaForm::configure($schema);
//     }

//     public static function table(Table $table): Table
//     {
//         return AgendasTable::configure($table)
//             ->defaultSort('waktu_agenda', 'desc');
//     }

//     public static function getEloquentQuery(): Builder
//     {
//         $query = parent::getEloquentQuery()
//             ->with([
//                 'pengajuanPsh.satker',
//                 'pengajuanPsh.statusProgres',
//                 'user',
//             ]);

//         /** @var User|null $user */
//         $user = Auth::user();

//         if (! $user) {
//             return $query->whereRaw('1 = 0');
//         }

//         if ($user->hasRole('super_admin')) {
//             return $query;
//         }

//         return $query->whereHas(
//             'pengajuanPsh.statusProgres',
//             fn (Builder $query) => $query->where('nama', 'Sudah Diagendakan')
//         );
//     }

//     public static function canViewAny(): bool
//     {
//         /** @var User|null $user */
//         $user = Auth::user();

//         if (! $user) {
//             return false;
//         }

//         return $user->hasAnyRole([
//             'super_admin',
//             'wabprof',
//             'admin_bidkum',
//             'bidkum',
//         ]);
//     }

//     public static function canCreate(): bool
//     {
//         /** @var User|null $user */
//         $user = Auth::user();

//         return $user?->hasAnyRole([
//             'super_admin',
//             'admin_bidkum',
//         ]) ?? false;
//     }

//     public static function canEdit($record): bool
//     {
//         /** @var User|null $user */
//         $user = Auth::user();

//         return $user?->hasAnyRole([
//             'super_admin',
//             'admin_bidkum',
//         ]) ?? false;
//     }

//     public static function canDelete($record): bool
//     {
//         /** @var User|null $user */
//         $user = Auth::user();

//         return $user?->hasAnyRole([
//             'super_admin',
//             'admin_bidkum',
//         ]) ?? false;
//     }

//     public static function getPages(): array
//     {
//         return [
//             'index' => ListAgendas::route('/'),
//             'create' => CreateAgenda::route('/create'),
//             'view' => ViewAgenda::route('/{record}'),
//             'edit' => EditAgenda::route('/{record}/edit'),
//         ];
//     }
// }
