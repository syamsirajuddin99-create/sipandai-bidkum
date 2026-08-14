<?php

namespace App\Filament\Resources\PenugasanPshes\Pages;

use App\Filament\Resources\PenugasanPshes\PenugasanPshResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPenugasanPsh extends EditRecord
{
    protected static string $resource = PenugasanPshResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
