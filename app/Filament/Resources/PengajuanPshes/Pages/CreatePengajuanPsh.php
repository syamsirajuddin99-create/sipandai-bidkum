<?php

namespace App\Filament\Resources\PengajuanPshes\Pages;

use App\Filament\Resources\PengajuanPshes\PengajuanPshResource;
use App\Models\StatusProgres;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePengajuanPsh extends CreateRecord
{
    protected static string $resource = PengajuanPshResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = Auth::user();

        $data['user_id'] = $user->id;
        $data['satker_id'] = $user->satker_id;
        $data['waktu_input'] = now();

        $data['status_progres_id'] = StatusProgres::query()
            ->where('nama', 'Pending Verifikasi')
            ->value('id');

        return $data;
    }
}
// namespace App\Filament\Resources\PengajuanPshes\Pages;

// use App\Filament\Resources\PengajuanPshes\PengajuanPshResource;
// use Filament\Resources\Pages\CreateRecord;

// class CreatePengajuanPsh extends CreateRecord
// {
//     protected static string $resource = PengajuanPshResource::class;
// }
