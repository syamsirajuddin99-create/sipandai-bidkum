<?php

namespace App\Filament\Resources\PenugasanPshes\Schemas;

use App\Models\DisposisiKasubbid;
use App\Models\Personel;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PenugasanPshForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('disposisi_kasubbid_id')
                    ->label('Disposisi Kasubbid')
                    ->relationship(
                        name: 'disposisiKasubbid',
                        titleAttribute: 'id',
                        modifyQueryUsing: fn (Builder $query): Builder => $query
                            ->with([
                                'pengajuanPsh.satker',
                            ])
                            ->whereDoesntHave('penugasanPshes')
                            ->latest('waktu_disposisi'),
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn (DisposisiKasubbid $record): string =>
                            ($record->pengajuanPsh?->nomor_surat ?? 'Tanpa Nomor Surat')
                            . ' | '
                            . ($record->pengajuanPsh?->satker?->nama ?? 'Satker Tidak Diketahui')
                            . ' | '
                            . ($record->pengajuanPsh?->perihal ?? '-')
                    )
                    ->searchable()
                    ->preload()
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set): void {
                        $disposisi = DisposisiKasubbid::find($state);

                        $set(
                            'pengajuan_psh_id',
                            $disposisi?->pengajuan_psh_id
                        );
                    }),

                Hidden::make('pengajuan_psh_id')
                    ->required(),

                Select::make('personel_id')
                    ->label('Personel yang Ditunjuk')
                    ->relationship(
                        name: 'personel',
                        titleAttribute: 'nama',
                        modifyQueryUsing: fn (Builder $query): Builder =>
                            $query
                                ->where('aktif', true)
                                ->orderBy('nama')
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn (Personel $record): string =>
                            $record->nama
                            . ($record->pangkat ? ' | ' . $record->pangkat : '')
                            . ($record->jabatan ? ' | ' . $record->jabatan : '')
                    )
                    ->searchable([
                        'nama',
                        'nrp_nip',
                        'pangkat',
                        'jabatan',
                    ])
                    ->preload()
                    ->required(),

                Hidden::make('ditugaskan_oleh')
                    ->default(fn (): ?int => Auth::id())
                    ->required(),

                DateTimePicker::make('waktu_penugasan')
                    ->label('Waktu Penugasan')
                    ->default(now())
                    ->seconds(false)
                    ->required(),

                Textarea::make('isi_penugasan')
                    ->label('Isi Penugasan')
                    ->placeholder('Masukkan uraian tugas personel...')
                    ->rows(5)
                    ->required()
                    ->columnSpanFull(),

                Textarea::make('catatan')
                    ->label('Catatan')
                    ->rows(3)
                    ->columnSpanFull(),

            ]);
    }
}