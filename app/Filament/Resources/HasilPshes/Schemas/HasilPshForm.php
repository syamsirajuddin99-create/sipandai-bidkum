<?php

namespace App\Filament\Resources\HasilPshes\Schemas;

use App\Models\PengajuanPsh;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class HasilPshForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('pengajuan_psh_id')
                    ->label('Nomor Pengajuan / Surat')
                    ->options(
                        PengajuanPsh::query()
                            ->orderByDesc('created_at')
                            ->get()
                            ->mapWithKeys(fn (PengajuanPsh $pengajuan) => [
                                $pengajuan->id => ($pengajuan->nomor_surat ?? '-')
                                    . ' — '
                                    . ($pengajuan->perihal ?? '-'),
                            ])
                            ->toArray()
                    )
                    ->searchable()
                    ->preload()
                    ->native(false)
                    ->required(),

                Select::make('user_id')
                    ->label('Petugas Penyelesaian')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->native(false)
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
// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Support\Facades\Auth;

// class HasilPshForm
// {
//     public static function configure(Schema $schema): Schema
//     {
//         return $schema
//             ->components([
//                 Select::make('pengajuan_psh_id')
//                     ->label('Nomor Pengajuan / Surat')
//                     ->options(
//                         fn (): array => PengajuanPsh::query()
//                             ->whereHas(
//                                 'statusProgres',
//                                 fn (Builder $query) => $query->where('nama', 'Disposisi Pimpinan')
//                             )
//                             ->doesntHave('hasilPsh')
//                             ->orderByDesc('id')
//                             ->get()
//                             ->mapWithKeys(
//                                 fn (PengajuanPsh $pengajuan): array => [
//                                     $pengajuan->id =>
//                                         $pengajuan->nomor_surat . ' - ' . $pengajuan->perihal,
//                                 ]
//                             )
//                             ->all()
//                     )
//                     ->searchable()
//                     ->preload()
//                     ->required()
//                     ->live(),

//                 Select::make('user_id')
//                     ->label('Petugas Penyelesaian')
//                     ->relationship('user', 'name')
//                     ->default(fn (): ?int => Auth::id())
//                     ->disabled()
//                     ->dehydrated()
//                     ->required(),

//                 FileUpload::make('file_hasil_psh')
//                     ->label('File Hasil Penyelesaian PSH')
//                     ->directory('sipandai/hasil-psh')
//                     ->acceptedFileTypes([
//                         'application/pdf',
//                     ])
//                     ->maxSize(10240)
//                     ->openable()
//                     ->downloadable()
//                     ->required(),

//                 DateTimePicker::make('waktu_upload')
//                     ->label('Waktu Penyelesaian')
//                     ->default(now())
//                     ->seconds(false)
//                     ->required(),

//                 Textarea::make('catatan')
//                     ->label('Catatan Penyelesaian')
//                     ->rows(5)
//                     ->columnSpanFull(),
//             ]);
//     }
// }