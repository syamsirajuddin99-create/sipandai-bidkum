<?php

namespace App\Filament\Resources\DisposisiKasubbids\Pages;

use App\Filament\Resources\DisposisiKasubbids\DisposisiKasubbidResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDisposisiKasubbids extends ListRecords
{
    protected static string $resource = DisposisiKasubbidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
