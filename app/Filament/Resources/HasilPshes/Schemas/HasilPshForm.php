<?php

namespace App\Filament\Resources\HasilPshes\Schemas;

use App\Models\PengajuanPsh;
use App\Models\Personel;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class HasilPshForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('pengajuan_psh_id')
                    ->label('Pengajuan PSH yang Ditugaskan')
                    ->relationship(
                        name: 'pengajuanPsh',
                        titleAttribute: 'nomor_surat',
                        modifyQueryUsing: function (Builder $query): Builder {
                            return $query
                                ->whereHas('penugasanPshes')
                                ->whereDoesntHave('hasilPsh')
                                ->with([
                                    'satker',
                                    'penugasanPshes.personel',
                                ])
                                ->orderByDesc('created_at');
                        },
                    )
                    ->getOptionLabelFromRecordUsing(
                        function (PengajuanPsh $record): string {
                            $personel = $record->penugasanPshes
                                ->map(fn ($penugasan) => $penugasan->personel?->nama)
                                ->filter()
                                ->unique()
                                ->implode(', ');

                            return ($record->nomor_surat ?? 'Tanpa Nomor Surat')
                                . ' | '
                                . ($record->satker?->nama ?? 'Satker Tidak Diketahui')
                                . ' | '
                                . ($record->perihal ?? '-')
                                . ' | Personel: '
                                . ($personel ?: '-');
                        }
                    )
                    ->searchable([
                        'nomor_surat',
                        'perihal',
                    ])
                    ->preload()
                    ->native(false)
                    ->required()
                    ->live(),

                Select::make('personel_id')
                    ->label('Personel Pelaksana PSH')
                    ->relationship(
                        name: 'personel',
                        titleAttribute: 'nama',
                        modifyQueryUsing: function (Builder $query, callable $get): Builder {
                            $pengajuanPshId = $get('pengajuan_psh_id');

                            if (! $pengajuanPshId) {
                                return $query->whereRaw('1 = 0');
                            }

                            return $query
                                ->whereHas('penugasanPshes', function (Builder $penugasanQuery) use ($pengajuanPshId): void {
                                    $penugasanQuery->where(
                                        'pengajuan_psh_id',
                                        $pengajuanPshId
                                    );
                                })
                                ->where('aktif', true)
                                ->orderBy('nama');
                        },
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn (Personel $record): string =>
                            trim(
                                ($record->nama ?? '')
                                . ' | '
                                . ($record->pangkat ?? '-')
                                . ' | '
                                . ($record->jabatan ?? '-')
                            )
                    )
                    ->searchable()
                    ->preload()
                    ->native(false)
                    ->required(),

Select::make('user_id')
    ->label('Diinput Oleh')
    ->relationship('user', 'name')
    ->default(fn (): ?int => Auth::id())
    ->disabled()
    ->dehydrated()
    ->required(),

                FileUpload::make('file_hasil_psh')
                    ->label('File Hasil Penyelesaian PSH')
                    ->disk('public')
                    ->directory('sipandai/hasil-psh')
                    ->acceptedFileTypes([
                        'application/pdf',
                    ])
                    ->downloadable()
                    ->openable()
                    ->required(),

                DateTimePicker::make('waktu_upload')
                    ->label('Waktu Penyelesaian')
                    ->default(now())
                    ->seconds(false)
                    ->required(),

                Textarea::make('catatan')
                    ->label('Catatan Penyelesaian')
                    ->rows(4)
                    ->columnSpanFull(),
            ]);
    }
}

// namespace App\Filament\Resources\HasilPshes\Schemas;

// use App\Models\PengajuanPsh;
// use Filament\Forms\Components\DateTimePicker;
// use Filament\Forms\Components\FileUpload;
// use Filament\Forms\Components\Select;
// use Filament\Forms\Components\Textarea;
// use Filament\Schemas\Schema;

// class HasilPshForm
// {
//     public static function configure(Schema $schema): Schema
//     {
//         return $schema
//             ->components([
//                 Select::make('pengajuan_psh_id')
//                     ->label('Nomor Pengajuan / Surat')
//                     ->options(
//                         PengajuanPsh::query()
//                             ->orderByDesc('created_at')
//                             ->get()
//                             ->mapWithKeys(fn (PengajuanPsh $pengajuan) => [
//                                 $pengajuan->id => ($pengajuan->nomor_surat ?? '-')
//                                     . ' — '
//                                     . ($pengajuan->perihal ?? '-'),
//                             ])
//                             ->toArray()
//                     )
//                     ->searchable()
//                     ->preload()
//                     ->native(false)
//                     ->required(),

//                 Select::make('user_id')
//                     ->label('Petugas Penyelesaian')
//                     ->relationship('user', 'name')
//                     ->searchable()
//                     ->preload()
//                     ->native(false)
//                     ->required(),

//                 FileUpload::make('file_hasil_psh')
//                     ->label('File Hasil Penyelesaian PSH')
//                     ->disk('public')
//                     ->directory('sipandai/hasil-psh')
//                     ->acceptedFileTypes([
//                         'application/pdf',
//                     ])
//                     ->downloadable()
//                     ->openable()
//                     ->required(),

//                 DateTimePicker::make('waktu_upload')
//                     ->label('Waktu Penyelesaian')
//                     ->seconds(false)
//                     ->required(),

//                 Textarea::make('catatan')
//                     ->label('Catatan Penyelesaian')
//                     ->rows(4)
//                     ->columnSpanFull(),
//             ]);
//     }
// }
