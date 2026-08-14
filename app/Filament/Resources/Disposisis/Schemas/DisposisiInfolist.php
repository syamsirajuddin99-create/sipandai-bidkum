<?php

namespace App\Filament\Resources\Disposisis\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DisposisiInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('pengajuanPsh.id')
                    ->label('Pengajuan psh'),
                TextEntry::make('agenda.id')
                    ->label('Agenda'),
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('isi_disposisi')
                    ->columnSpanFull(),
                TextEntry::make('file_disposisi')
                    ->placeholder('-'),
                TextEntry::make('waktu_disposisi')
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
