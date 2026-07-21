<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIfLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

// Rotas públicas (Apenas usuários NÃO logados)
Route::middleware([CheckIsNotLogged::class])->group(function () {
    // -- Form de Login --}}
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    // -- Submissão do Login --}}
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit'])->name('loginSubmit');
});

// Rotas protegidas (Apenas usuários LOGADOS)
Route::middleware([CheckIfLogged::class])->group(function () {
    // -- Página principal --}}
    Route::get('/', [MainController::class, 'index'])->name('home');

    // -- Criar nota --}}
    Route::get('/newNote', [MainController::class, 'newNote'])->name('newNote');
    Route::post('/newNoteSubmit', [MainController::class, 'newNoteSubmit'])->name('newNoteSubmit');

    // -- Editar nota --}}
    Route::get('/editNote/{id}', [MainController::class, 'editNote'])->name('editNote');
    Route::post('/editNoteSubmit', [MainController::class, 'editNoteSubmit'])->name('editNoteSubmit');

    // -- Excluir nota --}}
    Route::get('/deleteNote/{id}', [MainController::class, 'deleteNote'])->name('del');
    Route::get('/deleteNoteConfirm/{id}', [MainController::class, 'deleteNoteConfirm'])->name('deleteNoteConfirm');

    // -- Encerrar sessão --}}
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
