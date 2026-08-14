<?php

namespace App\Filament\Widgets;

use App\Models\PengajuanPsh;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PshStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $total = PengajuanPsh::count();

        $pending = PengajuanPsh::whereHas(
            'statusProgres',
            fn ($query) => $query->where('nama', 'Pending Verifikasi')
        )->count();

        $diagendakan = PengajuanPsh::whereHas(
            'statusProgres',
            fn ($query) => $query->where('nama', 'Sudah Diagendakan')
        )->count();

        $disposisi = PengajuanPsh::whereHas(
            'statusProgres',
            fn ($query) => $query->where('nama', 'Disposisi Pimpinan')
        )->count();

        $selesai = PengajuanPsh::whereHas(
            'statusProgres',
            fn ($query) => $query->where('nama', 'Selesai')
        )->count();

        return [
            Stat::make('Total Pengajuan PSH', $total)
                ->description('Seluruh pengajuan PSH')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),

            Stat::make('Pending Verifikasi', $pending)
                ->description('Menunggu verifikasi')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Sudah Diagendakan', $diagendakan)
                ->description('PSH telah memiliki agenda')
                ->descriptionIcon('heroicon-m-clipboard-document-check')
                ->color('info'),

            Stat::make('Disposisi Pimpinan', $disposisi)
                ->description('Menunggu proses penyelesaian')
                ->descriptionIcon('heroicon-m-arrow-right-circle')
                ->color('primary'),

            Stat::make('Selesai', $selesai)
                ->description('PSH telah diselesaikan')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }
}