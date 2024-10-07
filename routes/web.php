<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CplController;
use App\Http\Controllers\CpmkController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;

Route::get('/', function () {
    return view('welcome');
});

// ROUTE MAHASISWA
Route::get('/mahasiswa', [MahasiswaController::class, 'index']);

// ROUTE MATA KULIAH
Route::get('/matakuliah', [MatakuliahController::class, 'index']);

// ROUTE CPL
Route::get('/cpl', [CplController::class, 'index']);

// ROUTE CPMK
Route::get('/cpmk', [CpmkController::class, 'index']);