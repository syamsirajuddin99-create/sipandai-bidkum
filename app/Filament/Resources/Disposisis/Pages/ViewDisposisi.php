<?php

namespace App\Filament\Resources\Disposisis\Pages;

use App\Filament\Resources\Disposisis\DisposisiResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDisposisi extends ViewRecord
{
    protected static string $resource = DisposisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
