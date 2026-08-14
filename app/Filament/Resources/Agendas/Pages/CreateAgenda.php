<?php

namespace App\Filament\Resources\Agendas\Pages;

use App\Filament\Resources\Agendas\AgendaResource;
use App\Models\StatusProgres;
use Filament\Resources\Pages\CreateRecord;

class CreateAgenda extends CreateRecord
{
    protected static string $resource = AgendaResource::class;

    protected function afterCreate(): void
    {
        $statusDiagendakan = StatusProgres::query()
            ->where('nama', 'Sudah Diagendakan')
            ->first();

        if ($statusDiagendakan && $this->record->pengajuanPsh) {
            $this->record->pengajuanPsh->update([
                'status_progres_id' => $statusDiagendakan->id,
            ]);
        }
    }
}

// namespace App\Filament\Resources\Agendas\Pages;

// use App\Filament\Resources\Agendas\AgendaResource;
// use Filament\Resources\Pages\CreateRecord;

// class CreateAgenda extends CreateRecord
// {
//     protected static string $resource = AgendaResource::class;
// }
