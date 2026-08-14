<?php

namespace App\Filament\Resources\HasilPshes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class HasilPshInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('pengajuanPsh.id')
                    ->label('Pengajuan psh'),
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('file_hasil_psh'),
                TextEntry::make('waktu_upload')
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
