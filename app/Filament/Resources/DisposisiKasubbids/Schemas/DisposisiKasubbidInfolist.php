<?php

namespace App\Filament\Resources\DisposisiKasubbids\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DisposisiKasubbidInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextEntry::make('pengajuanPsh.nomor_surat')
                    ->label('Nomor Surat')
                    ->placeholder('-'),

                TextEntry::make('pengajuanPsh.satker.nama')
                    ->label('Satker')
                    ->placeholder('-'),

                TextEntry::make('pengajuanPsh.perihal')
                    ->label('Perihal')
                    ->placeholder('-')
                    ->columnSpanFull(),

                TextEntry::make('disposisi.user.name')
                    ->label('Disposisi Kabidkum Oleh')
                    ->placeholder('-'),

                TextEntry::make('user.name')
                    ->label('Disposisi Kasubbid Oleh')
                    ->placeholder('-'),

                TextEntry::make('isi_disposisi')
                    ->label('Isi Disposisi Kasubbid')
                    ->placeholder('-')
                    ->columnSpanFull(),

                TextEntry::make('waktu_disposisi')
                    ->label('Waktu Disposisi')
                    ->dateTime('d F Y H:i')
                    ->placeholder('-'),

                TextEntry::make('catatan')
                    ->label('Catatan')
                    ->placeholder('-')
                    ->columnSpanFull(),

            ]);
    }
}