<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Seguranca\PerfilController;
use App\Http\Controllers\Seguranca\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::middleware(['seguranca'])->group(function () {
    //Acesso
    Route::get('/usuario-info', [AuthController::class, 'info']);
    Route::get('/logout', [AuthController::class, 'logout']);
    
    //Admin - Perfil
    Route::get('/perfil/grid', [PerfilController::class, 'grid']);
    Route::post('/perfil', [PerfilController::class, 'store']);
    Route::get('/perfil/create', [PerfilController::class, 'create']);
    Route::get('/perfil/{perfil}/edit', [PerfilController::class, 'edit']);
    Route::match(['put', 'patch'],'/perfil/{perfil}', [PerfilController::class, 'update']);
    Route::delete('/perfil/{perfil}', [PerfilController::class, 'delete']);

    //Admin - Usuários
    Route::get('/admin/usuarios', [UsuarioController::class, 'index']);
    Route::post('/admin/usuario', [UsuarioController::class, 'store']);
    Route::get('/admin/usuario/{usuario}', [UsuarioController::class, 'show']);
    Route::put('/admin/usuario/{usuario}', [UsuarioController::class, 'update']);
    Route::delete('/admin/usuario/{usuario}', [UsuarioController::class, 'destroy']);

    Route::get('/home', function () {
        return response('Você está logado e está na página home');
    });
});

Route::middleware(['api'])->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});