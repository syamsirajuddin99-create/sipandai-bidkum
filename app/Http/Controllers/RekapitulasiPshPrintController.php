<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\DisposisiKasubbid;
use App\Models\HasilPsh;
use App\Models\PenugasanPsh;
use App\Models\PengajuanPsh;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RekapitulasiPshPrintController extends Controller
{
    public function __invoke(Request $request)
    {
        $tanggalMulai = Carbon::parse(
            $request->input('tanggal_mulai', now()->startOfMonth())
        )->startOfDay();

        $tanggalSelesai = Carbon::parse(
            $request->input('tanggal_selesai', now())
        )->endOfDay();

        $rekap = [
            'total_pengajuan' => PengajuanPsh::query()
                ->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai])
                ->count(),

            'pending_verifikasi' => PengajuanPsh::query()
                ->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai])
                ->whereHas(
                    'statusProgres',
                    fn ($query) => $query->where('nama', 'Pending Verifikasi')
                )
                ->count(),

            'sudah_diagendakan' => PengajuanPsh::query()
                ->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai])
                ->whereHas(
                    'statusProgres',
                    fn ($query) => $query->where('nama', 'Sudah Diagendakan')
                )
                ->count(),

            'disposisi_kabidkum' => Disposisi::query()
                ->whereBetween(
                    'waktu_disposisi',
                    [$tanggalMulai, $tanggalSelesai]
                )
                ->count(),

            'disposisi_kasubbid' => DisposisiKasubbid::query()
                ->whereBetween(
                    'waktu_disposisi',
                    [$tanggalMulai, $tanggalSelesai]
                )
                ->count(),

            'personel_ditugaskan' => PenugasanPsh::query()
                ->whereBetween(
                    'waktu_penugasan',
                    [$tanggalMulai, $tanggalSelesai]
                )
                ->count(),

            'psh_selesai' => HasilPsh::query()
                ->whereBetween(
                    'waktu_upload',
                    [$tanggalMulai, $tanggalSelesai]
                )
                ->count(),
        ];

        $pengajuans = PengajuanPsh::query()
            ->with([
                'satker',
                'statusProgres',
                'agenda',
                'disposisi',
                'hasilPsh',
            ])
            ->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai])
            ->latest('created_at')
            ->get();

        return view(
            'laporan.rekapitulasi-psh-print',
            compact(
                'rekap',
                'pengajuans',
                'tanggalMulai',
                'tanggalSelesai'
            )
        );
    }
}