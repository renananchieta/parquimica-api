<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Seguranca\PerfilController;
use App\Http\Controllers\Seguranca\UsuarioController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:api'])->group(function () {
    //Acesso
    Route::get('/usuario-info', [AuthController::class, 'info']);
    Route::get('/logout', [AuthController::class, 'logout']);
    
    //Admin - Perfil
    Route::get('/admin/perfis', [PerfilController::class, 'index']);
    Route::post('/admin/perfil', [PerfilController::class, 'store']);
    Route::get('/admin/perfil/{perfil}', [PerfilController::class, 'show']);
    Route::put('/admin/perfil/{perfil}', [PerfilController::class, 'update']);
    Route::delete('/admin/perfil/{perfil}', [PerfilController::class, 'destroy']);

    //Admin - Usuários
    Route::get('/admin/usuarios', [UsuarioController::class, 'index']);
    Route::post('/admin/usuario', [UsuarioController::class, 'store']);
    Route::get('/admin/usuario/{usuario}', [UsuarioController::class, 'show']);
    Route::put('/admin/usuario/{usuario}', [UsuarioController::class, 'update']);
    Route::delete('/admin/usuario/{usuario}', [UsuarioController::class, 'destroy']);

});