<?php

namespace App\Filament\Resources\StatusProgres\Pages;

use App\Filament\Resources\StatusProgres\StatusProgresResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewStatusProgres extends ViewRecord
{
    protected static string $resource = StatusProgresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
