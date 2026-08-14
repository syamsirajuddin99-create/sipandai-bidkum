<?php

namespace App\Filament\Resources\StatusProgres\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class StatusProgresForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode')
                    ->required(),
                TextInput::make('nama')
                    ->required(),
                TextInput::make('warna'),
                Textarea::make('keterangan')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('urutan')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
