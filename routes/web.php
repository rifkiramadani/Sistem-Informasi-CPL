<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CplController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CpmkController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RumusanController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;

// Route::get('/', function () {
//     return view('welcome');
// });

// ROUTE DASHBOARD
Route::middleware(['auth', 'role:SuperAdmin/AkunSakti|Admin|Operator|Dosen'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});

// ROUTE AUTHENTICATION
Route::get('/', [AuthController::class, 'index'])->middleware('guest');
Route::post('/', [AuthController::class, 'authenticate'])->middleware('guest')->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// ROUTE PROFILE
Route::middleware(['auth'])->group(function() {
    Route::get('/profile', [ProfileController::class, 'edit']);
    Route::put('/profile', [ProfileController::class, 'update']);
});

//ROUTE ADMIN
Route::middleware(['auth', 'role:SuperAdmin/AkunSakti'])->group(function() {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/create', [AdminController::class, 'create']);
    Route::post('/admin', [AdminController::class, 'store']);
    Route::get('/admin/{id}/edit', [AdminController::class, 'edit']);
    Route::put('/admin/{id}', [AdminController::class, 'update']);
    Route::delete('/admin/{id}', [AdminController::class, 'destroy']);
});

// ROUTE OPERATOR
Route::middleware(['auth', 'role:SuperAdmin/AkunSakti|Admin'])->group(function() {
    Route::get('/operator', [OperatorController::class, 'index']);
    Route::get('/operator/create', [OperatorController::class, 'create']);
    Route::post('/operator', [OperatorController::class, 'store']);
    Route::get('/operator/{id}/edit', [OperatorController::class, 'edit']);
    Route::put('/operator/{id}', [OperatorController::class, 'update']);
    Route::delete('/operator/{id}', [OperatorController::class, 'destroy']);
});

// ROUTE DOSEN
Route::middleware(['auth', 'role:SuperAdmin/AkunSakti|Admin|Operator'])->group(function() {
    //CRUD DOSEN
    Route::get('/dosen', [DosenController::class, 'index']);
    Route::get('/dosen/create', [DosenController::class, 'create']);
    Route::post('/dosen', [DosenController::class, 'store']);
    Route::get('/dosen/{id}/edit', [DosenController::class, 'edit']);
    Route::put('/dosen/{id}', [DosenController::class, 'update']);
    Route::delete('/dosen/{id}', [DosenController::class, 'destroy']);
    Route::get('/dosen/{id}/matakuliah', [DosenController::class, 'addMatakuliah']);
    Route::put('/dosen/{id}/matakuliah', [DosenController::class, 'insertMatakuliah']);
});

// ROUTE MAHASISWA
Route::middleware(['auth', 'role:SuperAdmin/AkunSakti|Admin|Operator|Mahasiswa|Dosen'])->group(function () {
    // Index route (list all Mahasiswa)
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');

    // Create route (show the form to create a new Mahasiswa)
    Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');

    // Store route (store the new Mahasiswa in the database)
    Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');

    // Edit route (show the form to edit an existing Mahasiswa)
    Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');

    // Update route (update an existing Mahasiswa)
    Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');

    // Show route (show details of a specific Mahasiswa)
    Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');

    // Destroy route (delete a Mahasiswa)
    Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
});


// ROUTE RUMUSAN
Route::middleware('auth', 'role:SuperAdmin/AkunSakti|Admin')->group(function() {
    Route::get('/rumusan', [RumusanController::class, 'index'])->name('rumusan.index');
    Route::get('/rumusan/create', [RumusanController::class, 'create']);
    Route::post('/rumusan', [RumusanController::class, 'store']);
    Route::get('/rumusan/{id}/edit', [RumusanController::class, 'edit']);
    Route::put('/rumusan/{id}', [RumusanController::class, 'update'])->name('rumusan.update');
    Route::delete('/rumusan/{id}', [RumusanController::class, 'destroy']);
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