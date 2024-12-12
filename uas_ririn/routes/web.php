<?php

use App\Http\Controllers\ProfileController;
use App\Models\mahasiswa;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MhsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/mahasiswa/create', [MhsController::class, 'create'])->name('mahasiswa.create');
    Route::post('/mahasiswa/store', [MhsController::class, 'store'])->name('mahasiswa.store');
    Route::get('/mahasiswa', [MhsController::class, 'index'])->name('mahasiswa.index');
    Route::delete('mahasiswa/{id}', [MhsController::class, 'destroy'])->name('mahasiswa.destroy');
    Route::get('mahasiswa/export', [MhsController::class, 'exportExcel'])->name('mahasiswa.export.excel');
    Route::get('/mahasiswa/{id}/edit', [MhsController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('/mahasiswa/{id}', [MhsController::class, 'update'])->name('mahasiswa.update');
    Route::get('mahasiswa/detail/{id}', [MhsController::class, 'show'])->name('mahasiswa.detail');




});


require __DIR__ . '/auth.php';
