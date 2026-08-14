<?php

namespace App\Filament\Widgets;

use App\Models\PengajuanPsh;
use App\Models\Disposisi;
use App\Models\DisposisiKasubbid;
use App\Models\PenugasanPsh;
use App\Models\HasilPsh;
use Carbon\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PshStatsOverview extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $tanggalMulai = filled($this->filters['tanggal_mulai'] ?? null)
            ? Carbon::parse($this->filters['tanggal_mulai'])->startOfDay()
            : now()->startOfMonth();

        $tanggalSelesai = filled($this->filters['tanggal_selesai'] ?? null)
            ? Carbon::parse($this->filters['tanggal_selesai'])->endOfDay()
            : now()->endOfDay();

        $total = PengajuanPsh::query()
            ->whereBetween('waktu_input', [
                $tanggalMulai,
                $tanggalSelesai,
            ])
            ->count();

        $pending = PengajuanPsh::query()
            ->whereBetween('waktu_input', [
                $tanggalMulai,
                $tanggalSelesai,
            ])
            ->whereHas(
                'statusProgres',
                fn ($query) => $query->where(
                    'nama',
                    'Pending Verifikasi'
                )
            )
            ->count();

        $diagendakan = PengajuanPsh::query()
            ->whereBetween('waktu_input', [
                $tanggalMulai,
                $tanggalSelesai,
            ])
            ->whereHas(
                'statusProgres',
                fn ($query) => $query->where(
                    'nama',
                    'Sudah Diagendakan'
                )
            )
            ->count();

        $disposisiKabidkum = Disposisi::query()
            ->whereBetween('waktu_disposisi', [
                $tanggalMulai,
                $tanggalSelesai,
            ])
            ->count();

        $disposisiKasubbid = DisposisiKasubbid::query()
            ->whereBetween('waktu_disposisi', [
                $tanggalMulai,
                $tanggalSelesai,
            ])
            ->count();

        $personelDitugaskan = PenugasanPsh::query()
            ->whereBetween('waktu_penugasan', [
                $tanggalMulai,
                $tanggalSelesai,
            ])
            ->count();

        $selesai = HasilPsh::query()
            ->whereBetween('waktu_upload', [
                $tanggalMulai,
                $tanggalSelesai,
            ])
            ->count();

        return [
            Stat::make('Total Pengajuan PSH', $total)
                ->description('Pengajuan pada periode terpilih')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),

            Stat::make('Pending Verifikasi', $pending)
                ->description('Menunggu verifikasi')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Sudah Diagendakan', $diagendakan)
                ->description('Telah masuk agenda')
                ->descriptionIcon('heroicon-m-clipboard-document-check')
                ->color('info'),

            Stat::make('Disposisi Kabidkum', $disposisiKabidkum)
                ->description('Telah didisposisikan Kabidkum')
                ->descriptionIcon('heroicon-m-arrow-right-circle')
                ->color('primary'),

            Stat::make('Disposisi Kasubbid', $disposisiKasubbid)
                ->description('Telah didisposisikan Kasubbid')
                ->descriptionIcon('heroicon-m-arrow-right-circle')
                ->color('info'),

            Stat::make('Personel Ditugaskan', $personelDitugaskan)
                ->description('Telah dilakukan penunjukan personel')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('warning'),

            Stat::make('PSH Selesai', $selesai)
                ->description('Penyelesaian PSH telah diunggah')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }
}



// namespace App\Filament\Widgets;

// use App\Models\PengajuanPsh;
// use Filament\Widgets\StatsOverviewWidget;
// use Filament\Widgets\StatsOverviewWidget\Stat;

// class PshStatsOverview extends StatsOverviewWidget
// {
//     protected static ?int $sort = 1;

//     protected function getStats(): array
//     {
//         $total = PengajuanPsh::count();

//         $pending = PengajuanPsh::whereHas(
//             'statusProgres',
//             fn ($query) => $query->where('nama', 'Pending Verifikasi')
//         )->count();

//         $diagendakan = PengajuanPsh::whereHas(
//             'statusProgres',
//             fn ($query) => $query->where('nama', 'Sudah Diagendakan')
//         )->count();

//         $disposisi = PengajuanPsh::whereHas(
//             'statusProgres',
//             fn ($query) => $query->where('nama', 'Disposisi Pimpinan')
//         )->count();

//         $selesai = PengajuanPsh::whereHas(
//             'statusProgres',
//             fn ($query) => $query->where('nama', 'Selesai')
//         )->count();

//         return [
//             Stat::make('Total Pengajuan PSH', $total)
//                 ->description('Seluruh pengajuan PSH')
//                 ->descriptionIcon('heroicon-m-document-text')
//                 ->color('primary'),

//             Stat::make('Pending Verifikasi', $pending)
//                 ->description('Menunggu verifikasi')
//                 ->descriptionIcon('heroicon-m-clock')
//                 ->color('warning'),

//             Stat::make('Sudah Diagendakan', $diagendakan)
//                 ->description('PSH telah memiliki agenda')
//                 ->descriptionIcon('heroicon-m-clipboard-document-check')
//                 ->color('info'),

//             Stat::make('Disposisi Pimpinan', $disposisi)
//                 ->description('Menunggu proses penyelesaian')
//                 ->descriptionIcon('heroicon-m-arrow-right-circle')
//                 ->color('primary'),

//             Stat::make('Selesai', $selesai)
//                 ->description('PSH telah diselesaikan')
//                 ->descriptionIcon('heroicon-m-check-circle')
//                 ->color('success'),
//         ];
//     }
// }