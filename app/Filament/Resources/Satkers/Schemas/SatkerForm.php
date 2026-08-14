<?php

namespace App\Filament\Resources\Satkers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SatkerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode')
                    ->required(),
                TextInput::make('nama')
                    ->required(),
                Textarea::make('alamat')
                    ->columnSpanFull(),
                TextInput::make('telepon')
                    ->tel(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
