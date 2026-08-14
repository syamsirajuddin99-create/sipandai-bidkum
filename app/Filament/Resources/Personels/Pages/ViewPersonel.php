<?php

namespace App\Filament\Resources\Personels\Pages;

use App\Filament\Resources\Personels\PersonelResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPersonel extends ViewRecord
{
    protected static string $resource = PersonelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
