<?php

namespace App\Filament\Resources\Disposisis\Tables;

use App\Models\Disposisi;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class DisposisisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('agenda.nomor_agenda')
                    ->label('Nomor Agenda')
                    ->searchable()
                    ->sortable(),

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
                    ->limit(50)
                    ->tooltip(
                        fn (Disposisi $record): string =>
                            $record->pengajuanPsh?->perihal ?? ''
                    ),

                TextColumn::make('isi_disposisi')
                    ->label('Isi Disposisi')
                    ->limit(60)
                    ->wrap(),

                TextColumn::make('waktu_disposisi')
                    ->label('Waktu Disposisi')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Dibuat Oleh')
                    ->sortable(),
            ])
            ->defaultSort('waktu_disposisi', 'desc')
            ->actions([
                ViewAction::make(),

                Action::make('print_pdf')
                    ->label('Print PDF')
                    ->icon('heroicon-o-printer')
                    ->url(
                        fn (Disposisi $record): string => route(
                            'disposisis.print',
                            [
                                'disposisi' => $record->id,
                            ]
                        )
                    )
                    ->openUrlInNewTab(),

                EditAction::make()
                    ->visible(fn (): bool => static::canManage()),

                DeleteAction::make()
                    ->visible(fn (): bool => static::canManage()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->visible(fn (): bool => static::canManage()),
                ]),
            ]);
    }

    protected static function canManage(): bool
    {
        $user = Auth::user();

        if (! $user) {
            return false;
        }

        return method_exists($user, 'hasAnyRole')
            && $user->hasAnyRole([
                'bidkum',
                'super_admin',
            ]);
    }
}

// namespace App\Filament\Resources\Disposisis\Tables;

// use App\Models\Disposisi;
// use Filament\Actions\BulkActionGroup;
// use Filament\Actions\DeleteAction;
// use Filament\Actions\DeleteBulkAction;
// use Filament\Actions\EditAction;
// use Filament\Actions\ViewAction;
// use Filament\Tables\Columns\TextColumn;
// use Filament\Tables\Table;
// use Illuminate\Support\Facades\Auth;

// class DisposisisTable
// {
//     public static function configure(Table $table): Table
//     {
//         return $table
//             ->columns([
//                 TextColumn::make('agenda.nomor_agenda')
//                     ->label('Nomor Agenda')
//                     ->searchable()
//                     ->sortable(),

//                 TextColumn::make('pengajuanPsh.nomor_surat')
//                     ->label('Nomor Surat')
//                     ->searchable()
//                     ->sortable(),

//                 TextColumn::make('pengajuanPsh.satker.nama')
//                     ->label('Satker')
//                     ->searchable()
//                     ->sortable(),

//                 TextColumn::make('pengajuanPsh.perihal')
//                     ->label('Perihal')
//                     ->limit(50)
//                     ->tooltip(
//                         fn (Disposisi $record): string =>
//                             $record->pengajuanPsh?->perihal ?? ''
//                     ),

//                 TextColumn::make('isi_disposisi')
//                     ->label('Isi Disposisi')
//                     ->limit(60)
//                     ->wrap(),

//                 TextColumn::make('waktu_disposisi')
//                     ->label('Waktu Disposisi')
//                     ->dateTime('d/m/Y H:i')
//                     ->sortable(),

//                 TextColumn::make('user.name')
//                     ->label('Dibuat Oleh')
//                     ->sortable(),
//             ])
//             ->defaultSort('waktu_disposisi', 'desc')
//             ->actions([
//                 ViewAction::make(),

//                 EditAction::make()
//                     ->visible(fn (): bool => static::canManage()),

//                 DeleteAction::make()
//                     ->visible(fn (): bool => static::canManage()),
//             ])
//             ->toolbarActions([
//                 BulkActionGroup::make([
//                     DeleteBulkAction::make()
//                         ->visible(fn (): bool => static::canManage()),
//                 ]),
//             ]);
//     }

//     protected static function canManage(): bool
//     {
//         $user = Auth::user();

//         if (! $user) {
//             return false;
//         }

//         return method_exists($user, 'hasAnyRole')
//             && $user->hasAnyRole([
//                 'super_admin',
//                 'admin_bidkum',
//             ]);
//     }
// }