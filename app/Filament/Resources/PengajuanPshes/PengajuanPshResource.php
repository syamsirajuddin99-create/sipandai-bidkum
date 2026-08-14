<?php

namespace App\Filament\Resources\PengajuanPshes;

use App\Filament\Resources\PengajuanPshes\Pages\CreatePengajuanPsh;
use App\Filament\Resources\PengajuanPshes\Pages\EditPengajuanPsh;
use App\Filament\Resources\PengajuanPshes\Pages\ListPengajuanPshes;
use App\Filament\Resources\PengajuanPshes\Pages\ViewPengajuanPsh;
use App\Models\PengajuanPsh;
use App\Models\StatusProgres;
use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Support\AccessControl;

class PengajuanPshResource extends Resource
{
    protected static ?string $model = PengajuanPsh::class;

    protected static ?string $recordTitleAttribute = 'nomor_surat';

    protected static ?string $navigationLabel = 'Pengajuan PSH';

    protected static ?string $modelLabel = 'Pengajuan PSH';

    protected static ?string $pluralModelLabel = 'Pengajuan PSH';

    protected static string|\UnitEnum|null $navigationGroup = 'PSH';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('user_id')
                    ->default(fn (): ?int => Auth::id())
                    ->dehydrated(),

                Hidden::make('satker_id')
                    ->default(fn (): ?int => Auth::user() instanceof User
                        ? Auth::user()->satker_id
                        : null
                    )
                    ->dehydrated(),

                Hidden::make('status_progres_id')
                    ->default(fn (): ?int => StatusProgres::query()
                        ->where('nama', 'Pending Verifikasi')
                        ->value('id')
                    )
                    ->dehydrated(),

                TextInput::make('nomor_surat')
                    ->label('Nomor Surat')
                    ->required()
                    ->maxLength(255),

                DatePicker::make('tanggal_surat')
                    ->label('Tanggal Surat')
                    ->required()
                    ->default(now()),

                DateTimePicker::make('waktu_input')
                    ->label('Waktu Input')
                    ->default(now())
                    ->disabled()
                    ->dehydrated()
                    ->seconds(false)
                    ->columnSpan(2),

                TextInput::make('perihal')
                    ->label('Perihal Permohonan')
                    ->required()
                    ->maxLength(500)
                    ->columnSpanFull(),

                Textarea::make('ringkasan_kasus')
                    ->label('Ringkasan Kasus')
                    ->required()
                    ->rows(7)
                    ->columnSpanFull(),

                FileUpload::make('file_pemohon')
                    ->label('Dokumen Pengajuan PDF')
                    ->disk('public')
                    ->directory('sipandai/pengajuan')
                    ->acceptedFileTypes([
                        'application/pdf',
                    ])
                    ->maxSize(10240)
                    ->downloadable()
                    ->openable()
                    ->required()
                    ->columnSpanFull(),

                Textarea::make('catatan')
                    ->label('Catatan')
                    ->rows(4)
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_surat')
                    ->label('Nomor Surat')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('satker.nama')
                    ->label('Satker Pengirim')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('perihal')
                    ->label('Perihal')
                    ->searchable()
                    ->limit(50),

                TextColumn::make('waktu_input')
                    ->label('Waktu Input')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('statusProgres.nama')
                    ->label('Status')
                    ->badge()
                    ->sortable(),

                TextColumn::make('file_pemohon')
                    ->label('Dokumen')
                    ->formatStateUsing(
                        fn (?string $state): string => $state ? 'Lihat PDF' : '-'
                    )
                    ->url(
                        fn (PengajuanPsh $record): ?string => $record->file_pemohon
                            ? asset('storage/' . $record->file_pemohon)
                            : null
                    )
                    ->openUrlInNewTab(),
            ])
            ->defaultSort('waktu_input', 'desc')
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
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
            'index' => ListPengajuanPshes::route('/'),
            'create' => CreatePengajuanPsh::route('/create'),
            'view' => ViewPengajuanPsh::route('/{record}'),
            'edit' => EditPengajuanPsh::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()
            ->with([
                'user',
                'satker',
                'statusProgres',
            ]);

        $user = Auth::user();

        if ($user instanceof User && $user->hasRole('wabprof')) {
            $query->where('user_id', $user->id);
        }

        return $query;
    }

public static function shouldRegisterNavigation(): bool
{
    return AccessControl::hasAnyRole([
        'wabprof',
        'super_admin',
    ]);
}

public static function canViewAny(): bool
{
    return AccessControl::hasAnyRole([
        'wabprof',
        'super_admin',
    ]);
}

public static function canCreate(): bool
{
    return AccessControl::hasAnyRole([
        'wabprof',
        'super_admin',
    ]);
}

public static function canEdit($record): bool
{
    return AccessControl::hasAnyRole([
        'wabprof',
        'super_admin',
    ]);
}

public static function canDelete($record): bool
{
    return AccessControl::hasAnyRole([
        'wabprof',
        'super_admin',
    ]);
}

}

// namespace App\Filament\Resources\PengajuanPshes;

// use App\Filament\Resources\PengajuanPshes\Pages\CreatePengajuanPsh;
// use App\Filament\Resources\PengajuanPshes\Pages\EditPengajuanPsh;
// use App\Filament\Resources\PengajuanPshes\Pages\ListPengajuanPshes;
// use App\Filament\Resources\PengajuanPshes\Pages\ViewPengajuanPsh;
// use App\Filament\Resources\PengajuanPshes\Schemas\PengajuanPshForm;
// use App\Filament\Resources\PengajuanPshes\Schemas\PengajuanPshInfolist;
// use App\Filament\Resources\PengajuanPshes\Tables\PengajuanPshesTable;
// use App\Models\PengajuanPsh;
// use BackedEnum;
// use Filament\Resources\Resource;
// use Filament\Schemas\Schema;
// use Filament\Support\Icons\Heroicon;
// use Filament\Tables\Table;

// class PengajuanPshResource extends Resource
// {
//     protected static ?string $model = PengajuanPsh::class;

//     protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

//     protected static ?string $recordTitleAttribute = 'nomor_surat';

//     public static function form(Schema $schema): Schema
//     {
//         return PengajuanPshForm::configure($schema);
//     }

//     public static function infolist(Schema $schema): Schema
//     {
//         return PengajuanPshInfolist::configure($schema);
//     }

//     public static function table(Table $table): Table
//     {
//         return PengajuanPshesTable::configure($table);
//     }

//     public static function getRelations(): array
//     {
//         return [
//             //
//         ];
//     }

//     public static function getPages(): array
//     {
//         return [
//             'index' => ListPengajuanPshes::route('/'),
//             'create' => CreatePengajuanPsh::route('/create'),
//             'view' => ViewPengajuanPsh::route('/{record}'),
//             'edit' => EditPengajuanPsh::route('/{record}/edit'),
//         ];
//     }
// }
