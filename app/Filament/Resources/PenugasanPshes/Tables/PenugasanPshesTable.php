<?php

namespace App\Filament\Resources\PenugasanPshes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PenugasanPshesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('pengajuanPsh.nomor_surat')
                    ->label('Nomor Surat PSH')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('pengajuanPsh.satker.nama')
                    ->label('Satker')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('personel.nama')
                    ->label('Personel Ditunjuk')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('personel.pangkat')
                    ->label('Pangkat')
                    ->toggleable(),

                TextColumn::make('personel.jabatan')
                    ->label('Jabatan')
                    ->toggleable(),

                TextColumn::make('ditugaskanOleh.name')
                    ->label('Ditugaskan Oleh')
                    ->searchable(),

                TextColumn::make('waktu_penugasan')
                    ->label('Waktu Penugasan')
                    ->dateTime('d-m-Y H:i')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->searchable(),

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