<?php

namespace App\Filament\Resources\Agendas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AgendaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('pengajuanPsh.nomor_surat')
                    ->label('Nomor Pengajuan PSH')
                    ->placeholder('Tanpa Nomor Surat'),

                TextEntry::make('pengajuanPsh.satker.nama')
                    ->label('Satker Pengaju')
                    ->placeholder('-'),

                TextEntry::make('pengajuanPsh.perihal')
                    ->label('Perihal')
                    ->placeholder('-'),

                TextEntry::make('user.name')
                    ->label('Diagendakan Oleh')
                    ->placeholder('-'),

                TextEntry::make('nomor_agenda')
                    ->label('Nomor Agenda')
                    ->placeholder('-'),

                TextEntry::make('waktu_agenda')
                    ->label('Waktu Agenda')
                    ->dateTime('d F Y H:i')
                    ->placeholder('-'),

                TextEntry::make('catatan')
                    ->label('Catatan')
                    ->placeholder('-')
                    ->columnSpanFull(),

                TextEntry::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d F Y H:i')
                    ->placeholder('-'),

                TextEntry::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->dateTime('d F Y H:i')
                    ->placeholder('-'),
            ]);
    }
}

// namespace App\Filament\Resources\Agendas\Schemas;

// use Filament\Infolists\Components\TextEntry;
// use Filament\Schemas\Schema;

// class AgendaInfolist
// {
//     public static function configure(Schema $schema): Schema
//     {
//         return $schema
//             ->components([
//                 TextEntry::make('pengajuanPsh.id')
//                     ->label('Pengajuan psh'),
//                 TextEntry::make('user.name')
//                     ->label('User'),
//                 TextEntry::make('nomor_agenda'),
//                 TextEntry::make('waktu_agenda')
//                     ->dateTime(),
//                 TextEntry::make('catatan')
//                     ->placeholder('-')
//                     ->columnSpanFull(),
//                 TextEntry::make('created_at')
//                     ->dateTime()
//                     ->placeholder('-'),
//                 TextEntry::make('updated_at')
//                     ->dateTime()
//                     ->placeholder('-'),
//             ]);
//     }
// }
