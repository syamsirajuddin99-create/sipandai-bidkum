<?php

namespace App\Filament\Resources\StatusProgres;

use App\Filament\Resources\StatusProgres\Pages\CreateStatusProgres;
use App\Filament\Resources\StatusProgres\Pages\EditStatusProgres;
use App\Filament\Resources\StatusProgres\Pages\ListStatusProgres;
use App\Filament\Resources\StatusProgres\Pages\ViewStatusProgres;
use App\Models\StatusProgres;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Support\AccessControl;

class StatusProgresResource extends Resource
{
    protected static ?string $model = StatusProgres::class;

    protected static ?string $recordTitleAttribute = 'nama';

    protected static ?string $navigationLabel = 'Status Progres';

    protected static ?string $modelLabel = 'Status Progres';

    protected static ?string $pluralModelLabel = 'Status Progres';

    protected static string|\UnitEnum|null $navigationGroup = 'Master Data';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrow-path';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode')
                    ->label('Kode Status')
                    ->required()
                    ->maxLength(100)
                    ->unique(ignoreRecord: true),

                TextInput::make('nama')
                    ->label('Nama Status')
                    ->required()
                    ->maxLength(255),

                Select::make('warna')
                    ->label('Warna Badge')
                    ->options([
                        'gray' => 'Gray',
                        'danger' => 'Danger',
                        'warning' => 'Warning',
                        'info' => 'Info',
                        'primary' => 'Primary',
                        'success' => 'Success',
                    ])
                    ->default('gray')
                    ->required(),

                TextInput::make('urutan')
                    ->label('Urutan')
                    ->numeric()
                    ->integer()
                    ->default(1)
                    ->required()
                    ->minValue(1),

                Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->rows(3)
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(true),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('urutan')
                    ->label('Urutan')
                    ->sortable(),

                TextColumn::make('kode')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nama')
                    ->label('Nama Status')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('warna')
                    ->label('Warna')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'danger' => 'danger',
                        'warning' => 'warning',
                        'info' => 'info',
                        'primary' => 'primary',
                        'success' => 'success',
                        default => 'gray',
                    }),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('urutan')
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
            'index' => ListStatusProgres::route('/'),
            'create' => CreateStatusProgres::route('/create'),
            'view' => ViewStatusProgres::route('/{record}'),
            'edit' => EditStatusProgres::route('/{record}/edit'),
        ];
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