<?php

namespace App\Filament\Resources\DisposisiKasubbids\Schemas;

use App\Models\Disposisi;
use App\Models\PengajuanPsh;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class DisposisiKasubbidForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('disposisi_id')
                    ->label('Disposisi Kabidkum')
                    ->relationship(
                        name: 'disposisi',
                        titleAttribute: 'isi_disposisi',
                        modifyQueryUsing: function (Builder $query): Builder {
                            return $query
                                ->with([
                                    'pengajuanPsh.satker',
                                    'agenda',
                                ])
                                ->orderByDesc('waktu_disposisi');
                        },
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn (Disposisi $record): string =>
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
                        $disposisi = Disposisi::find($state);

                        if ($disposisi) {
                            $set('pengajuan_psh_id', $disposisi->pengajuan_psh_id);
                        }
                    }),

                Hidden::make('pengajuan_psh_id')
                    ->required(),

                Select::make('user_id')
                    ->label('Disposisi Dibuat Oleh')
                    ->relationship('user', 'name')
                    ->default(fn (): ?int => Auth::id())
                    ->disabled()
                    ->dehydrated()
                    ->required(),

                Textarea::make('isi_disposisi')
                    ->label('Isi Disposisi Kasubbid')
                    ->placeholder('Masukkan instruksi atau disposisi dari Kasubbid...')
                    ->rows(5)
                    ->required()
                    ->columnSpanFull(),

                DateTimePicker::make('waktu_disposisi')
                    ->label('Waktu Disposisi')
                    ->default(now())
                    ->seconds(false)
                    ->required(),

                Textarea::make('catatan')
                    ->label('Catatan')
                    ->rows(4)
                    ->columnSpanFull(),

            ]);
    }
}

// namespace App\Filament\Resources\DisposisiKasubbids\Schemas;

// use App\Models\Disposisi;
// use App\Models\PengajuanPsh;
// use Filament\Forms\Components\DateTimePicker;
// use Filament\Forms\Components\Select;
// use Filament\Forms\Components\Textarea;
// use Filament\Schemas\Schema;
// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Support\Facades\Auth;

// class DisposisiKasubbidForm
// {
//     public static function configure(Schema $schema): Schema
//     {
//         return $schema
//             ->components([

//                 /*
//                 |--------------------------------------------------------------------------
//                 | DISPOSISI KABIDKUM
//                 |--------------------------------------------------------------------------
//                 */
//                 Select::make('disposisi_id')
//                     ->label('Disposisi Kabidkum')
//                     ->relationship(
//                         name: 'disposisi',
//                         titleAttribute: 'id',
//                         modifyQueryUsing: fn (Builder $query) => $query
//                             ->with(['pengajuanPsh.satker'])
//                             ->latest('waktu_disposisi')
//                     )
//                     ->getOptionLabelFromRecordUsing(
//                         fn (Disposisi $record): string =>
//                             ($record->pengajuanPsh?->nomor_surat ?? 'Tanpa Nomor Surat')
//                             . ' | '
//                             . ($record->pengajuanPsh?->satker?->nama ?? 'Satker Tidak Diketahui')
//                             . ' | '
//                             . ($record->pengajuanPsh?->perihal ?? '-')
//                     )
//                     ->searchable()
//                     ->preload()
//                     ->required()
//                     ->live()
//                     ->afterStateUpdated(function ($state, callable $set): void {
//                         $disposisi = Disposisi::find($state);

//                         $set(
//                             'pengajuan_psh_id',
//                             $disposisi?->pengajuan_psh_id
//                         );
//                     }),

//                 /*
//                 |--------------------------------------------------------------------------
//                 | PENGAJUAN PSH
//                 |--------------------------------------------------------------------------
//                 */
//                 Select::make('pengajuan_psh_id')
//                     ->label('Pengajuan PSH')
//                     ->relationship(
//                         name: 'pengajuanPsh',
//                         titleAttribute: 'nomor_surat'
//                     )
//                     ->getOptionLabelFromRecordUsing(
//                         fn (PengajuanPsh $record): string =>
//                             ($record->nomor_surat ?? 'Tanpa Nomor Surat')
//                             . ' | '
//                             . ($record->satker?->nama ?? 'Satker Tidak Diketahui')
//                             . ' | '
//                             . ($record->perihal ?? '-')
//                     )
//                     ->disabled()
//                     ->dehydrated()
//                     ->required(),

//                 /*
//                 |--------------------------------------------------------------------------
//                 | USER PEMBUAT DISPOSISI KASUBBID
//                 |--------------------------------------------------------------------------
//                 */
//                 Select::make('user_id')
//                     ->label('Disposisi Oleh')
//                     ->relationship('user', 'name')
//                     ->default(fn (): ?int => Auth::id())
//                     ->disabled()
//                     ->dehydrated()
//                     ->required(),

//                 /*
//                 |--------------------------------------------------------------------------
//                 | ISI DISPOSISI
//                 |--------------------------------------------------------------------------
//                 */
//                 Textarea::make('isi_disposisi')
//                     ->label('Isi Disposisi Kasubbid')
//                     ->required()
//                     ->rows(5)
//                     ->columnSpanFull(),

//                 /*
//                 |--------------------------------------------------------------------------
//                 | WAKTU
//                 |--------------------------------------------------------------------------
//                 */
//                 DateTimePicker::make('waktu_disposisi')
//                     ->label('Waktu Disposisi')
//                     ->default(now())
//                     ->seconds(false)
//                     ->required(),

//                 /*
//                 |--------------------------------------------------------------------------
//                 | CATATAN
//                 |--------------------------------------------------------------------------
//                 */
//                 Textarea::make('catatan')
//                     ->label('Catatan')
//                     ->rows(4)
//                     ->columnSpanFull(),

//             ]);
//     }
// }