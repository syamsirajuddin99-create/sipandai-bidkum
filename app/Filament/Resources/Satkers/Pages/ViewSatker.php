<?php

namespace App\Filament\Resources\Satkers\Pages;

use App\Filament\Resources\Satkers\SatkerResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSatker extends ViewRecord
{
    protected static string $resource = SatkerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
