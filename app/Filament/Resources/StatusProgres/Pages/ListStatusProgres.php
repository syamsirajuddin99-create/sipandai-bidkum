<?php

namespace App\Filament\Resources\StatusProgres\Pages;

use App\Filament\Resources\StatusProgres\StatusProgresResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStatusProgres extends ListRecords
{
    protected static string $resource = StatusProgresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
