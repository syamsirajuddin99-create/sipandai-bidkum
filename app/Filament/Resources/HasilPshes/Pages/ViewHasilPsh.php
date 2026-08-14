<?php

namespace App\Filament\Resources\HasilPshes\Pages;

use App\Filament\Resources\HasilPshes\HasilPshResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewHasilPsh extends ViewRecord
{
    protected static string $resource = HasilPshResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
