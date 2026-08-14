<?php

use App\Http\Controllers\DisposisiPrintController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/disposisis/{disposisi}/print', [DisposisiPrintController::class, 'print'])
    ->name('disposisis.print');
