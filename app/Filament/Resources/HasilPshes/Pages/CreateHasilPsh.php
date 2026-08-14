<?php

namespace App\Filament\Resources\HasilPshes\Pages;

use App\Filament\Resources\HasilPshes\HasilPshResource;
use App\Models\StatusProgres;
use Filament\Resources\Pages\CreateRecord;

class CreateHasilPsh extends CreateRecord
{
    protected static string $resource = HasilPshResource::class;

    protected function afterCreate(): void
    {
        $statusSelesaiId = StatusProgres::query()
            ->where('nama', 'Selesai')
            ->value('id');

        if ($statusSelesaiId) {
            $this->record->pengajuanPsh()->update([
                'status_progres_id' => $statusSelesaiId,
            ]);
        }
    }
}