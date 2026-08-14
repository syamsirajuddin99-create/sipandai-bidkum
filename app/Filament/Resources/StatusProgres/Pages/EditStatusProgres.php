<?php

namespace App\Filament\Resources\StatusProgres\Pages;

use App\Filament\Resources\StatusProgres\StatusProgresResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditStatusProgres extends EditRecord
{
    protected static string $resource = StatusProgresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
