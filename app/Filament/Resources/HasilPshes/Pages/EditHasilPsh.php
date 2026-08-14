<?php

namespace App\Filament\Resources\HasilPshes\Pages;

use App\Filament\Resources\HasilPshes\HasilPshResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditHasilPsh extends EditRecord
{
    protected static string $resource = HasilPshResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
