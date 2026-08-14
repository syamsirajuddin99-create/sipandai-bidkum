<?php

namespace App\Filament\Resources\Satkers;

use App\Filament\Resources\Satkers\Pages\CreateSatker;
use App\Filament\Resources\Satkers\Pages\EditSatker;
use App\Filament\Resources\Satkers\Pages\ListSatkers;
use App\Filament\Resources\Satkers\Pages\ViewSatker;
use App\Models\Satker;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Support\AccessControl;

class SatkerResource extends Resource
{
    protected static ?string $model = Satker::class;

    protected static ?string $recordTitleAttribute = 'nama';

    protected static ?string $navigationLabel = 'Master Satker';

    protected static ?string $modelLabel = 'Satker';

    protected static ?string $pluralModelLabel = 'Satker';

    protected static string|\UnitEnum|null $navigationGroup = 'Master Data';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode')
                    ->label('Kode Satker')
                    ->required()
                    ->maxLength(50)
                    ->unique(ignoreRecord: true),

                TextInput::make('nama')
                    ->label('Nama Satker')
                    ->required()
                    ->maxLength(255),

                Textarea::make('alamat')
                    ->label('Alamat')
                    ->rows(3)
                    ->columnSpanFull(),

                TextInput::make('telepon')
                    ->label('Telepon')
                    ->tel()
                    ->maxLength(30),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->maxLength(255),

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
                TextColumn::make('kode')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nama')
                    ->label('Nama Satker')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('telepon')
                    ->label('Telepon')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('nama')
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
            'index' => ListSatkers::route('/'),
            'create' => CreateSatker::route('/create'),
            'view' => ViewSatker::route('/{record}'),
            'edit' => EditSatker::route('/{record}/edit'),
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