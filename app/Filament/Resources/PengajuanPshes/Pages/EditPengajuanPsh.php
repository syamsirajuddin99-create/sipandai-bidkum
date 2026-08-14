<?php

namespace App\Filament\Resources\PengajuanPshes\Pages;

use App\Filament\Resources\PengajuanPshes\PengajuanPshResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPengajuanPsh extends EditRecord
{
    protected static string $resource = PengajuanPshResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
