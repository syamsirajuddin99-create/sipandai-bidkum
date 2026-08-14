<?php

namespace App\Filament\Resources\PengajuanPshes\Pages;

use App\Filament\Resources\PengajuanPshes\PengajuanPshResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPengajuanPshes extends ListRecords
{
    protected static string $resource = PengajuanPshResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
