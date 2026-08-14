<?php

namespace App\Filament\Resources\HasilPshes\Pages;

use App\Filament\Resources\HasilPshes\HasilPshResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHasilPshes extends ListRecords
{
    protected static string $resource = HasilPshResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
