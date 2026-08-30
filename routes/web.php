<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

Route::middleware([CheckIsLogged::class])->group(function () {

    Route::get('/meus-anuncios', [MainController::class, 'meusAnuncios'])->name('anuncios.meus');

    Route::get('/anuncios/criar', [MainController::class, 'createAnuncio'])->name('anuncios.create');
    Route::post('/anuncios/criar-submit', [MainController::class, 'storeAnuncio'])->name('anuncios.store');

    Route::get('/anuncios/editar/{id}', [MainController::class, 'editAnuncio'])->name('anuncios.edit');
    Route::post('/anuncios/editar-submit', [MainController::class, 'updateAnuncio'])->name('anuncios.update');

    Route::post('/anuncios/deletar-submit', [MainController::class, 'deleteAnuncio'])->name('anuncios.delete');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/anuncios/detalhes/{id}', [MainController::class, 'mostrar'])->name('anuncios.mostrar');
});
Route::get('/', [MainController::class, 'index'])->name('home');
Route::middleware([CheckIsNotLogged::class])->group(function () {

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login-submit', [AuthController::class, 'loginSubmit'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register-submit', [AuthController::class, 'registerSubmit'])->name('register.submit');
});