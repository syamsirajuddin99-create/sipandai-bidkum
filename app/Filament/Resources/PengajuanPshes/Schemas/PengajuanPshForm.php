<?php

namespace App\Filament\Resources\PengajuanPshes\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PengajuanPshForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('satker_id')
                    ->relationship('satker', 'id')
                    ->required(),
                Select::make('status_progres_id')
                    ->relationship('statusProgres', 'id')
                    ->required(),
                TextInput::make('nomor_surat')
                    ->required(),
                DatePicker::make('tanggal_surat')
                    ->required(),
                DateTimePicker::make('waktu_input')
                    ->required(),
                TextInput::make('perihal')
                    ->required(),
                Textarea::make('ringkasan_kasus')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('file_pemohon')
                    ->required(),
                Textarea::make('catatan')
                    ->columnSpanFull(),
            ]);
    }
}
