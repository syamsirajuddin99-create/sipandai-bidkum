<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use Barryvdh\DomPDF\Facade\Pdf;

class DisposisiPrintController extends Controller
{
    public function print(Disposisi $disposisi)
    {
        $disposisi->load([
            'agenda',
            'pengajuanPsh.satker',
            'user',
        ]);

        $pengajuanPsh = $disposisi->pengajuanPsh;
        $agenda = $disposisi->agenda;
        $satker = $pengajuanPsh?->satker;

        $pdf = Pdf::loadView('pdf.disposisi-report', [
            'disposisi' => $disposisi,
            'pengajuanPsh' => $pengajuanPsh,
            'agenda' => $agenda,
            'satker' => $satker,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream(
            'Laporan-Disposisi-' . $disposisi->id . '.pdf'
        );
    }
}