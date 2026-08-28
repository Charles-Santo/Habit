<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index']);

Route::get('/anuncios/criar', [MainController::class, 'createAnuncio'])->name('anuncios.create');
Route::post('/anuncios', [MainController::class, 'storeAnuncio'])->name('anuncios.store');
Route::get('/anuncios/{anuncio}/editar', [MainController::class, 'editAnuncio'])->name('anuncios.edit');
Route::put('/anuncios/{anuncio}', [MainController::class, 'updateAnuncio'])->name('anuncios.update');
Route::delete('/anuncios/{anuncio}', [MainController::class, 'deleteAnuncio'])->name('anuncios.destroy');
