<?php

namespace App\Filament\Resources\Agendas\Schemas;

use App\Models\PengajuanPsh;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AgendaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('pengajuan_psh_id')
                    ->label('Pengajuan PSH')
                    ->relationship(
                        name: 'pengajuanPsh',
                        titleAttribute: 'nomor_surat',
                        modifyQueryUsing: function (Builder $query): Builder {
                            return $query
                                //->whereDoesntHave('agenda')
                                ->with(['satker', 'statusProgres'])
                                ->orderByDesc('tanggal_surat');
                        },
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn (PengajuanPsh $record): string =>
                            ($record->nomor_surat ?: 'Tanpa Nomor Surat')
                            . ' | '
                            . ($record->satker?->nama ?? 'Satker Tidak Diketahui')
                            . ' | '
                            . ($record->perihal ?: '-')
                    )
                    ->searchable([
                        'nomor_surat',
                        'perihal',
                    ])
                    ->preload()
                    ->required()
                    ->live(),

                Select::make('user_id')
                    ->label('Diagendakan Oleh')
                    ->relationship('user', 'name')
                    ->default(fn (): ?int => Auth::id())
                    ->disabled()
                    ->dehydrated()
                    ->required(),

                TextInput::make('nomor_agenda')
                    ->label('Nomor Agenda')
                    ->required()
                    ->maxLength(255),

                DateTimePicker::make('waktu_agenda')
                    ->label('Waktu Agenda')
                    ->default(now())
                    ->seconds(false)
                    ->required(),

                Textarea::make('catatan')
                    ->label('Catatan')
                    ->rows(5)
                    ->columnSpanFull(),
            ]);
    }
}

// namespace App\Filament\Resources\Agendas\Schemas;

// use Filament\Forms\Components\DateTimePicker;
// use Filament\Forms\Components\Select;
// use Filament\Forms\Components\TextInput;
// use Filament\Forms\Components\Textarea;
// use Filament\Schemas\Schema;

// class AgendaForm
// {
//     public static function configure(Schema $schema): Schema
//     {
//         return $schema
//             ->components([
//                 Select::make('pengajuan_psh_id')
//                     ->relationship('pengajuanPsh', 'id')
//                     ->required(),
//                 Select::make('user_id')
//                     ->relationship('user', 'name')
//                     ->required(),
//                 TextInput::make('nomor_agenda')
//                     ->required(),
//                 DateTimePicker::make('waktu_agenda')
//                     ->required(),
//                 Textarea::make('catatan')
//                     ->columnSpanFull(),
//             ]);
//     }
// }
