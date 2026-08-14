<?php

namespace App\Filament\Resources\Personels\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PersonelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nrp_nip')
                    ->label('NRP / NIP')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->placeholder('Contoh: 12345678'),

                TextInput::make('nama')
                    ->label('Nama Personel')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Nama lengkap personel'),

                TextInput::make('pangkat')
                    ->label('Pangkat / Golongan')
                    ->maxLength(255)
                    ->placeholder('Contoh: AKP / Briptu / Penata'),

                TextInput::make('jabatan')
                    ->label('Jabatan')
                    ->maxLength(255)
                    ->placeholder('Contoh: Ba Urmintu'),

                TextInput::make('satker')
                    ->label('Satker / Kesatuan')
                    ->maxLength(255)
                    ->placeholder('Contoh: Bidkum Polda'),

                Toggle::make('aktif')
                    ->label('Status Aktif')
                    ->default(true)
                    ->required()
                    ->helperText('Hanya personel aktif yang dapat dipilih untuk penugasan PSH.'),
            ]);
    }
}