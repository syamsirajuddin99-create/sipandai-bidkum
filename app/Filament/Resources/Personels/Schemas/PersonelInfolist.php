<?php

namespace App\Filament\Resources\Personels\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PersonelInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nrp_nip')
                    ->placeholder('-'),
                TextEntry::make('nama'),
                TextEntry::make('pangkat')
                    ->placeholder('-'),
                TextEntry::make('jabatan')
                    ->placeholder('-'),
                TextEntry::make('satker')
                    ->placeholder('-'),
                IconEntry::make('aktif')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
