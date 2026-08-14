<?php

namespace App\Filament\Resources\PengajuanPshes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PengajuanPshInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('satker.id')
                    ->label('Satker'),
                TextEntry::make('statusProgres.id')
                    ->label('Status progres'),
                TextEntry::make('nomor_surat'),
                TextEntry::make('tanggal_surat')
                    ->date(),
                TextEntry::make('waktu_input')
                    ->dateTime(),
                TextEntry::make('perihal'),
                TextEntry::make('ringkasan_kasus')
                    ->columnSpanFull(),
                TextEntry::make('file_pemohon'),
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
