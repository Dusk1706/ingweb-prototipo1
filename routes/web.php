<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SucursalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->prefix('sucursal')->group(function () {
    Route::get('/', [SucursalController::class, 'index'])->name('sucursal');
    Route::post('/abrir-caja', [SucursalController::class, 'abrirCaja'])->name('abrir-caja');
    Route::post('/cambiar-cheques', [SucursalController::class, 'cambiarCheques'])->name('cambiar-cheques');
    Route::post('/agregar-dinero', [SucursalController::class, 'agregarDinero'])->name('agregar-dinero');
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
