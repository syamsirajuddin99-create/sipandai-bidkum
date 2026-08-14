<?php

namespace App\Filament\Resources\PenugasanPshes\Pages;

use App\Filament\Resources\PenugasanPshes\PenugasanPshResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPenugasanPshes extends ListRecords
{
    protected static string $resource = PenugasanPshResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
