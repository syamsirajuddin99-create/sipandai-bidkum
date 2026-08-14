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
                TextEntry::make('pengajuanPsh.id')
                    ->label('Pengajuan psh'),
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('nomor_agenda'),
                TextEntry::make('waktu_agenda')
                    ->dateTime(),
                TextEntry::make('catatan')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
