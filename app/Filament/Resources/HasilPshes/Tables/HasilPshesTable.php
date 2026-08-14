<?php

namespace App\Filament\Resources\HasilPshes\Tables;

use App\Models\HasilPsh;
use App\Models\StatusProgres;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HasilPshesTable
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
                    ->limit(50)
                    ->tooltip(
                        fn (HasilPsh $record): string =>
                            $record->pengajuanPsh?->perihal ?? ''
                    ),

                TextColumn::make('user.name')
                    ->label('Diselesaikan Oleh')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('waktu_upload')
                    ->label('Waktu Penyelesaian')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('file_hasil_psh')
                    ->label('Dokumen')
                    ->formatStateUsing(fn (): string => 'Lihat File')
                    ->url(
                        fn (HasilPsh $record): ?string =>
                            $record->file_hasil_psh
                                ? asset('storage/' . $record->file_hasil_psh)
                                : null
                    )
                    ->openUrlInNewTab(),
            ])
            ->actions([
                ViewAction::make(),

                EditAction::make(),

                DeleteAction::make()
                    ->requiresConfirmation()
                    ->before(function (HasilPsh $record): void {
                        $statusDisposisiId = StatusProgres::query()
                            ->where('nama', 'Disposisi Pimpinan')
                            ->value('id');

                        if ($statusDisposisiId && $record->pengajuanPsh) {
                            $record->pengajuanPsh()->update([
                                'status_progres_id' => $statusDisposisiId,
                            ]);
                        }
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}