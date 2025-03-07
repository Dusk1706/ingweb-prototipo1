<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CajaController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [CajaController::class, 'index'])->name('caja');
    Route::post('/abrir-caja', [CajaController::class, 'abrirCaja'])->name('abrir-caja');
    Route::post('/cambiar-cheques', [CajaController::class, 'cambiarCheques'])->name('cambiar-cheques');
    Route::post('/agregar-dinero', [CajaController::class, 'agregarDinero'])->name('agregar-dinero');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
