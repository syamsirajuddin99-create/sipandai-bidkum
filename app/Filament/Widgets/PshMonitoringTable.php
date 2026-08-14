<?php

namespace App\Filament\Widgets;

use App\Models\PengajuanPsh;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PshMonitoringTable extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Monitoring PSH Terbaru')
            ->description('Monitoring seluruh tahapan proses Pengajuan PSH')
            ->query(
                PengajuanPsh::query()
                    ->with([
                        'satker',
                        'statusProgres',
                        'user',
                        'agenda',
                        'disposisi',
                        'hasilPsh',
                    ])
                    ->latest()
            )
            ->defaultPaginationPageOption(5)
            ->columns([
                Tables\Columns\TextColumn::make('nomor_surat')
                    ->label('Nomor Surat')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('satker.nama')
                    ->label('Satker')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('perihal')
                    ->label('Perihal')
                    ->limit(40)
                    ->tooltip(
                        fn (PengajuanPsh $record): string => $record->perihal ?? ''
                    ),

                Tables\Columns\TextColumn::make('statusProgres.nama')
                    ->label('Status')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'Pending Verifikasi' => 'warning',
                        'Sudah Diagendakan' => 'info',
                        'Disposisi Pimpinan' => 'primary',
                        'Selesai' => 'success',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('agenda.nomor_agenda')
                    ->label('Nomor Agenda')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('disposisi.waktu_disposisi')
                    ->label('Disposisi')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('hasilPsh.waktu_upload')
                    ->label('Hasil PSH')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pengajuan')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ]);
    }
}