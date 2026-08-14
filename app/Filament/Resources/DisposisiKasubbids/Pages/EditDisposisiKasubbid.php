<?php

namespace App\Filament\Resources\DisposisiKasubbids\Pages;

use App\Filament\Resources\DisposisiKasubbids\DisposisiKasubbidResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDisposisiKasubbid extends EditRecord
{
    protected static string $resource = DisposisiKasubbidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
