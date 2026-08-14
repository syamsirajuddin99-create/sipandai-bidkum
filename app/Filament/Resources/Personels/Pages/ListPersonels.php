<?php

namespace App\Filament\Resources\Personels\Pages;

use App\Filament\Resources\Personels\PersonelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPersonels extends ListRecords
{
    protected static string $resource = PersonelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
