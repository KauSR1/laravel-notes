<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use \App\Http\Middleware\CheckIfLogged;
use \App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

// Rotas de Autentificação (Middleware)
Route::middleware([CheckIsNotLogged::class])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit'])->name('loginSubmit');
});

//Rotas com proteção (Middleware) - usuário está Logado ?
Route::middleware([CheckIfLogged::class])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/newNote', [MainController::class, 'newNote'])->name('newNote');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

