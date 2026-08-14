<?php

namespace App\Filament\Resources\DisposisiKasubbids\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DisposisiKasubbidsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pengajuanPsh.nomor_surat')
                    ->label('Nomor Surat')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('pengajuanPsh.satker.nama')
                    ->label('Satker')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('pengajuanPsh.perihal')
                    ->label('Perihal')
                    ->limit(40)
                    ->tooltip(fn ($state): string => $state ?? '-')
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('Disposisi Oleh')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('waktu_disposisi')
                    ->label('Waktu Disposisi')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->recordActions([

                ViewAction::make(),

                Action::make('print')
                    ->label('Print')
                    ->icon('heroicon-o-printer')
                    ->color('orange')
                    ->url(
                        fn ($record): string =>
                            route('disposisi-kasubbids.print', $record)
                    )
                    ->openUrlInNewTab(),

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

// namespace App\Filament\Resources\DisposisiKasubbids\Tables;

// use Filament\Actions\BulkActionGroup;
// use Filament\Actions\DeleteBulkAction;
// use Filament\Actions\EditAction;
// use Filament\Tables\Columns\TextColumn;
// use Filament\Tables\Table;

// class DisposisiKasubbidsTable
// {
//     public static function configure(Table $table): Table
//     {
//         return $table
//             ->columns([

//                 TextColumn::make('pengajuanPsh.nomor_surat')
//                     ->label('Nomor Surat PSH')
//                     ->searchable()
//                     ->sortable()
//                     ->description(
//                         fn ($record): string =>
//                             $record->pengajuanPsh?->satker?->nama
//                             ?? 'Satker Tidak Diketahui'
//                     ),

//                 TextColumn::make('pengajuanPsh.perihal')
//                     ->label('Perihal')
//                     ->searchable()
//                     ->limit(50)
//                     ->tooltip(
//                         fn ($record): ?string =>
//                             $record->pengajuanPsh?->perihal
//                     ),

//                 TextColumn::make('user.name')
//                     ->label('Disposisi Oleh')
//                     ->searchable()
//                     ->sortable(),

//                 TextColumn::make('waktu_disposisi')
//                     ->label('Waktu Disposisi')
//                     ->dateTime('d M Y H:i')
//                     ->sortable(),

//                 TextColumn::make('created_at')
//                     ->label('Dibuat')
//                     ->dateTime('d M Y H:i')
//                     ->sortable()
//                     ->toggleable(isToggledHiddenByDefault: true),

//                 TextColumn::make('updated_at')
//                     ->label('Diubah')
//                     ->dateTime('d M Y H:i')
//                     ->sortable()
//                     ->toggleable(isToggledHiddenByDefault: true),

//             ])
//             ->filters([
//                 //
//             ])
//             ->recordActions([
//                 EditAction::make(),
//             ])
//             ->toolbarActions([
//                 BulkActionGroup::make([
//                     DeleteBulkAction::make(),
//                 ]),
//             ]);
//     }
// }