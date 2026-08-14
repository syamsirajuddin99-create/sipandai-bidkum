<?php

namespace App\Filament\Resources\Disposisis\Schemas;

use App\Models\Agenda;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class DisposisiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('agenda_id')
                    ->label('Pilih Agenda PSH')
                    ->options(
                        fn (): array => Agenda::query()
                            ->with('pengajuanPsh')
                            ->orderByDesc('waktu_agenda')
                            ->get()
                            ->mapWithKeys(function (Agenda $agenda): array {
                                $nomorSurat = $agenda->pengajuanPsh?->nomor_surat ?? '-';

                                return [
                                    $agenda->id => "{$agenda->nomor_agenda} - {$nomorSurat}",
                                ];
                            })
                            ->all()
                    )
                    ->searchable()
                    ->preload()
                    ->live()
                    ->afterStateUpdated(function ($state, Set $set): void {
                        $pengajuanPshId = Agenda::query()
                            ->whereKey($state)
                            ->value('pengajuan_psh_id');

                        $set('pengajuan_psh_id', $pengajuanPshId);
                    })
                    ->required(),

                Hidden::make('pengajuan_psh_id')
                    ->required(),

                Hidden::make('user_id')
                    ->default(fn (): ?int => Auth::id())
                    ->required(),

                Textarea::make('isi_disposisi')
                    ->label('Isi Disposisi')
                    ->required()
                    ->columnSpanFull(),

                FileUpload::make('file_disposisi')
                    ->label('File Disposisi')
                    ->directory('sipandai/disposisi')
                    ->acceptedFileTypes([
                        'application/pdf',
                    ])
                    ->maxSize(10240)
                    ->downloadable()
                    ->openable()
                    ->columnSpanFull(),

                DateTimePicker::make('waktu_disposisi')
                    ->label('Waktu Disposisi')
                    ->required()
                    ->seconds(false)
                    ->default(now()),

                Textarea::make('catatan')
                    ->label('Catatan')
                    ->columnSpanFull(),
            ]);
    }
}

// namespace App\Filament\Resources\Disposisis\Schemas;

// use App\Models\Agenda;
// use Filament\Forms\Components\DateTimePicker;
// use Filament\Forms\Components\FileUpload;
// use Filament\Forms\Components\Select;
// use Filament\Forms\Components\Textarea;
// use Filament\Schemas\Schema;

// class DisposisiForm
// {
//     public static function configure(Schema $schema): Schema
//     {
//         return $schema
//             ->components([
//                 Select::make('agenda_id')
//                     ->label('Pilih Agenda PSH')
//                     ->options(
//                         Agenda::query()
//                             ->with('pengajuanPsh')
//                             ->orderByDesc('waktu_agenda')
//                             ->get()
//                             ->mapWithKeys(fn (Agenda $agenda) => [
//                                 $agenda->id => trim(
//                                     ($agenda->nomor_agenda ?? '-')
//                                     . ' — '
//                                     . ($agenda->pengajuanPsh?->nomor_surat ?? '-')
//                                     . ' — '
//                                     . ($agenda->pengajuanPsh?->perihal ?? '-')
//                                 ),
//                             ])
//                             ->toArray()
//                     )
//                     ->searchable()
//                     ->preload()
//                     ->native(false)
//                     ->required()
//                     ->live()
//                     ->afterStateUpdated(function ($state, callable $set): void {
//                         $agenda = Agenda::find($state);

//                         $set('pengajuan_psh_id', $agenda?->pengajuan_psh_id);
//                     }),

//                 Select::make('pengajuan_psh_id')
//                     ->hidden()
//                     ->dehydrated()
//                     ->required(),

//                 Textarea::make('isi_disposisi')
//                     ->label('Isi Disposisi')
//                     ->required()
//                     ->rows(5)
//                     ->columnSpanFull(),

//                 FileUpload::make('file_disposisi')
//                     ->label('File Disposisi')
//                     ->disk('public')
//                     ->directory('sipandai/disposisi')
//                     ->acceptedFileTypes([
//                         'application/pdf',
//                     ])
//                     ->downloadable()
//                     ->openable()
//                     ->required(),

//                 DateTimePicker::make('waktu_disposisi')
//                     ->label('Waktu Disposisi')
//                     ->seconds(false)
//                     ->required(),

//                 Textarea::make('catatan')
//                     ->label('Catatan')
//                     ->rows(3)
//                     ->columnSpanFull(),
//             ]);
//     }
// }












// namespace App\Filament\Resources\Disposisis\Schemas;

// use App\Models\Agenda;
// use App\Models\StatusProgres;
// use Filament\Forms\Components\DateTimePicker;
// use Filament\Forms\Components\FileUpload;
// use Filament\Forms\Components\Hidden;
// use Filament\Forms\Components\Select;
// use Filament\Forms\Components\Textarea;
// use Filament\Schemas\Components\Utilities\Get;
// use Filament\Schemas\Schema;
// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Support\Facades\Auth;

// class DisposisiForm
// {
//     public static function configure(Schema $schema): Schema
//     {
//         return $schema
//             ->components([
//                 Select::make('agenda_id')
//                     ->label('Pilih Agenda PSH')
//                     ->options(
//                         Agenda::query()
//                             ->with('pengajuanPsh')
//                             ->whereDoesntHave('disposisi')
//                             ->whereHas(
//                                 'pengajuanPsh.statusProgres',
//                                 fn (Builder $query) => $query
//                                     ->where('nama', 'Sudah Diagendakan')
//                             )
//                             ->get()
//                             ->mapWithKeys(fn (Agenda $agenda) => [
//                                 $agenda->id =>
//                                     $agenda->nomor_agenda .
//                                     ' | ' .
//                                     ($agenda->pengajuanPsh?->nomor_surat ?? '-') .
//                                     ' | ' .
//                                     ($agenda->pengajuanPsh?->perihal ?? '-'),
//                             ])
//                             ->toArray()
//                     )
//                     ->searchable()
//                     ->preload()
//                     ->required()
//                     ->live()
//                     ->afterStateUpdated(function ($state, callable $set): void {
//                         if (! $state) {
//                             $set('pengajuan_psh_id', null);

//                             return;
//                         }

//                         $agenda = Agenda::find($state);

//                         $set('pengajuan_psh_id', $agenda?->pengajuan_psh_id);
//                     })
//                     ->columnSpanFull(),

//                 Hidden::make('pengajuan_psh_id')
//                     ->required(),

//                 Hidden::make('user_id')
//                     ->default(fn (): ?int => Auth::id())
//                     ->required(),

//                 Textarea::make('isi_disposisi')
//                     ->label('Isi Disposisi')
//                     ->required()
//                     ->rows(6)
//                     ->columnSpanFull(),

//                 FileUpload::make('file_disposisi')
//                     ->label('File Disposisi')
//                     ->directory('sipandai/disposisi')
//                     ->disk('public')
//                     ->acceptedFileTypes([
//                         'application/pdf',
//                         'image/jpeg',
//                         'image/png',
//                     ])
//                     ->maxSize(10240)
//                     ->openable()
//                     ->downloadable()
//                     ->columnSpanFull(),

//                 DateTimePicker::make('waktu_disposisi')
//                     ->label('Waktu Disposisi')
//                     ->default(now())
//                     ->seconds(false)
//                     ->required(),

//                 Textarea::make('catatan')
//                     ->label('Catatan')
//                     ->rows(4)
//                     ->columnSpanFull(),
//             ]);
//     }
// }