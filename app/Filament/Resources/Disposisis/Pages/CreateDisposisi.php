<?php

namespace App\Filament\Resources\Disposisis\Pages;

use App\Filament\Resources\Disposisis\DisposisiResource;
use App\Models\PengajuanPsh;
use App\Models\StatusProgres;
use Filament\Resources\Pages\CreateRecord;

class CreateDisposisi extends CreateRecord
{
    protected static string $resource = DisposisiResource::class;

    protected function afterCreate(): void
    {
        $statusId = StatusProgres::query()
            ->where('nama', 'Disposisi Pimpinan')
            ->value('id');

        if (! $statusId) {
            return;
        }

        PengajuanPsh::query()
            ->whereKey($this->record->pengajuan_psh_id)
            ->update([
                'status_progres_id' => $statusId,
            ]);
    }
}