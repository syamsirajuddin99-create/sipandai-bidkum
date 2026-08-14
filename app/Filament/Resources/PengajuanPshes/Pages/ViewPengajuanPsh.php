<?php

namespace App\Filament\Resources\PengajuanPshes\Pages;

use App\Filament\Resources\PengajuanPshes\PengajuanPshResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPengajuanPsh extends ViewRecord
{
    protected static string $resource = PengajuanPshResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
