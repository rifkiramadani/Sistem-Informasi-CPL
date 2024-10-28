<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CplController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CpmkController;
use App\Http\Controllers\RumusanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;

// Route::get('/', function () {
//     return view('welcome');
// });

// ROUTE AUTHENTICATION
Route::get('/', [AuthController::class, 'index'])->middleware('guest');
Route::post('/', [AuthController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// ROUTE MAHASISWA
Route::middleware(['auth', 'role:SuperAdmin/AkunSakti|Admin|Operator|Mahasiswa|Dosen'])->group(function() {
    Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
});

// ROUTE RUMUSAN
Route::middleware('auth', 'role:SuperAdmin/AkunSakti|Admin')->group(function() {
    Route::get('/rumusan', [RumusanController::class, 'index']);
});

// ROUTE MATA KULIAH
Route::middleware('auth', 'role:SuperAdmin/AkunSakti|Admin')->group(function() {
    Route::get('/matakuliah', [MatakuliahController::class, 'index']);
    Route::get('/matakuliah/create', [MatakuliahController::class, 'create']);
    Route::post('/matakuliah', [MatakuliahController::class, 'store']);
    Route::get('/matakuliah/{id}/edit', [MatakuliahController::class, 'edit']);
    Route::put('/matakuliah/{id}', [MatakuliahController::class, 'update']);
    Route::delete('/matakuliah/{id}', [MatakuliahController::class, 'destroy']);
});

// ROUTE CPL
Route::middleware(['auth', 'role:SuperAdmin/AkunSakti|Admin'])->group(function() {
    Route::get('/cpl', [CplController::class, 'index']);
    Route::get('/cpl/create', [CplController::class, 'create']);
    Route::post('/cpl', [CplController::class, 'store']);
    Route::get('/cpl/{id}/edit', [CplController::class, 'edit']);
    Route::put('/cpl/{id}', [CplController::class, 'update']);
    Route::delete('/cpl/{id}', [CplController::class, 'destroy']);
});

// ROUTE CPMK
Route::middleware(['auth', 'role:SuperAdmin/AkunSakti|Admin'])->group(function() {
    Route::get('/cpmk', [CpmkController::class, 'index']);
    Route::get('/cpmk/create', [CpmkController::class, 'create']);
    Route::post('/cpmk', [CpmkController::class, 'store']);
    Route::get('/cpmk/{id}/edit', [CpmkController::class, 'edit']);
    Route::put('/cpmk/{id}', [CpmkController::class, 'update']);
    Route::delete('/cpmk/{id}', [CpmkController::class, 'destroy']);
});