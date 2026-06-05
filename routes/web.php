<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Fragaria;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/registro', [AuthController::class, 'showRegister'])->name('registro');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/registro', [AuthController::class, 'register'])->name('registro.post');


Route::middleware('auth')->group(function () {

    Route::get('/', [Fragaria::class, 'inicio'])->name('fra.inicio');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/perfume/{id}', [Fragaria::class, 'detalle'])->name('perfume.detalle');

    Route::post('/perfume/{id}/resena', [Fragaria::class, 'guardarResena'])->name('resena.guardar');

    Route::put('/resena/{id}', [Fragaria::class, 'actualizarResena'])->name('resena.actualizar');

    Route::delete('/resena/{id}', [Fragaria::class, 'eliminarResena'])->name('resena.eliminar');


    
});