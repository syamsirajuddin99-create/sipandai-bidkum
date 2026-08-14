<?php

namespace App\Filament\Resources\Personels\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PersonelsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nrp_nip')
                    ->label('NRP / NIP')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nama')
                    ->label('Nama Personel')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('pangkat')
                    ->label('Pangkat')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('jabatan')
                    ->label('Jabatan')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('satker')
                    ->label('Satker')
                    ->searchable()
                    ->toggleable(),

                IconColumn::make('aktif')
                    ->label('Status')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime('d-m-Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
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
}

// namespace App\Filament\Resources\Personels\Tables;

// use Filament\Actions\BulkActionGroup;
// use Filament\Actions\DeleteBulkAction;
// use Filament\Actions\EditAction;
// use Filament\Actions\ViewAction;
// use Filament\Tables\Columns\IconColumn;
// use Filament\Tables\Columns\TextColumn;
// use Filament\Tables\Table;

// class PersonelsTable
// {
//     public static function configure(Table $table): Table
//     {
//         return $table
//             ->columns([
//                 TextColumn::make('nrp_nip')
//                     ->label('NRP / NIP')
//                     ->searchable()
//                     ->sortable(),

//                 TextColumn::make('nama')
//                     ->label('Nama Personel')
//                     ->searchable()
//                     ->sortable()
//                     ->weight('bold'),

//                 TextColumn::make('pangkat')
//                     ->label('Pangkat')
//                     ->searchable()
//                     ->sortable()
//                     ->toggleable(),

//                 TextColumn::make('jabatan')
//                     ->label('Jabatan')
//                     ->searchable()
//                     ->toggleable(),

//                 TextColumn::make('satker')
//                     ->label('Satker')
//                     ->searchable()
//                     ->toggleable(),

//                 IconColumn::make('aktif')
//                     ->label('Status')
//                     ->boolean()
//                     ->sortable(),

//                 TextColumn::make('created_at')
//                     ->dateTime('d-m-Y H:i')
//                     ->sortable()
//                     ->toggleable(isToggledHiddenByDefault: true),
//             ])
//             ->filters([
//                 //
//             ])
//             ->recordActions([
//                 ViewAction::make(),
//                 EditAction::make(),
//             ])
//             ->toolbarActions([
//                 BulkActionGroup::make([
//                     DeleteBulkAction::make(),
//                 ]),
//             ]);
//     }
// }