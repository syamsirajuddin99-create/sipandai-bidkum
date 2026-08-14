<?php

use App\Http\Controllers\DisposisiPrintController;
use App\Http\Controllers\DisposisiKasubbidPrintController;
use App\Http\Controllers\RekapitulasiPshPrintController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/disposisis/{disposisi}/print', [DisposisiPrintController::class, 'print'])
    ->name('disposisis.print');

Route::get(
    '/disposisi-kasubbids/{disposisiKasubbid}/print',
    [DisposisiKasubbidPrintController::class, 'print']
)->name('disposisi-kasubbids.print');

Route::get(
    '/rekapitulasi-psh/print',
    RekapitulasiPshPrintController::class
)->name('rekapitulasi-psh.print');
