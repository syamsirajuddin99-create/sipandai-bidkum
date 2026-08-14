<?php

namespace App\Filament\Resources\Agendas\Tables;

use App\Models\Agenda;
use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class AgendasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_agenda')
                    ->label('Nomor Agenda')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('pengajuanPsh.nomor_surat')
                    ->label('Nomor Surat')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('pengajuanPsh.satker.nama')
                    ->label('Satker Pengirim')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('pengajuanPsh.perihal')
                    ->label('Perihal')
                    ->limit(40)
                    ->tooltip(
                        fn (Agenda $record): string => $record->pengajuanPsh?->perihal ?? ''
                    ),

                TextColumn::make('pengajuanPsh.statusProgres.nama')
                    ->label('Status')
                    ->badge(),

                TextColumn::make('waktu_agenda')
                    ->label('Waktu Agenda')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Diagendakan Oleh'),
            ])
            ->actions([
                ViewAction::make(),

                EditAction::make()
                    ->visible(function (): bool {
                        /** @var User|null $user */
                        $user = Auth::user();

                        return $user?->hasAnyRole([
                            'super_admin',
                            'admin_bidkum',
                        ]) ?? false;
                    }),

                DeleteAction::make()
                    ->visible(function (): bool {
                        /** @var User|null $user */
                        $user = Auth::user();

                        return $user?->hasAnyRole([
                            'super_admin',
                            'admin_bidkum',
                        ]) ?? false;
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->visible(function (): bool {
                            /** @var User|null $user */
                            $user = Auth::user();

                            return $user?->hasAnyRole([
                                'super_admin',
                                'admin_bidkum',
                            ]) ?? false;
                        }),
                ]),
            ]);
    }
}





// namespace App\Filament\Resources\Agendas\Tables;

// use Filament\Actions\BulkActionGroup;
// use Filament\Actions\DeleteBulkAction;
// use Filament\Actions\EditAction;
// use Filament\Actions\ViewAction;
// use Filament\Tables\Columns\TextColumn;
// use Filament\Tables\Table;

// class AgendasTable
// {
//     public static function configure(Table $table): Table
//     {
//         return $table
//             ->columns([
//                 TextColumn::make('pengajuanPsh.id')
//                     ->searchable(),
//                 TextColumn::make('user.name')
//                     ->searchable(),
//                 TextColumn::make('nomor_agenda')
//                     ->searchable(),
//                 TextColumn::make('waktu_agenda')
//                     ->dateTime()
//                     ->sortable(),
//                 TextColumn::make('created_at')
//                     ->dateTime()
//                     ->sortable()
//                     ->toggleable(isToggledHiddenByDefault: true),
//                 TextColumn::make('updated_at')
//                     ->dateTime()
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
