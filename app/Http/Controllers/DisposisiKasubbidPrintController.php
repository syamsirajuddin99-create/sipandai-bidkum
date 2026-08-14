<?php

namespace App\Http\Controllers;

use App\Models\DisposisiKasubbid;
use Barryvdh\DomPDF\Facade\Pdf;

class DisposisiKasubbidPrintController extends Controller
{
    public function print(DisposisiKasubbid $disposisiKasubbid)
    {
        $disposisiKasubbid->load([
            'pengajuanPsh.satker',
            'disposisi.user',
            'user',
            'penugasanPshes.personel',
        ]);

        $pdf = Pdf::loadView(
            'pdf.disposisi-kasubbid-report',
            compact('disposisiKasubbid')
        )->setPaper('a4', 'portrait');

        return $pdf->stream(
            'Disposisi-Kasubbid-' . $disposisiKasubbid->id . '.pdf'
        );
    }
}