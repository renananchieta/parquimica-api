<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Catalogo\CatalogoController;
use App\Http\Controllers\Seguranca\PerfilController;
use App\Http\Controllers\Seguranca\UsuarioController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::middleware(['seguranca'])->group(function () {
    //Acesso
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/usuario-info', [AuthController::class, 'info']);
    
    //Admin - Perfil
    Route::get('/perfil/grid', [PerfilController::class, 'grid']);
    Route::post('/perfil', [PerfilController::class, 'store']);
    Route::get('/perfil/create', [PerfilController::class, 'create']);
    Route::get('/perfil/{perfil}/edit', [PerfilController::class, 'edit']);
    Route::match(['put', 'patch'],'/perfil/{perfil}', [PerfilController::class, 'update']);
    Route::delete('/perfil/{perfil}', [PerfilController::class, 'delete']);
    
    //Admin - Usuários
    Route::get('/admin/usuarios', [UsuarioController::class, 'index']);
    Route::get('/admin/usuarios/create', [UsuarioController::class, 'create']);
    Route::post('/admin/usuario', [UsuarioController::class, 'store']);
    Route::get('/admin/usuario/{usuario}', [UsuarioController::class, 'show']);
    Route::put('/admin/usuario/{usuario}', [UsuarioController::class, 'update']);
    Route::put('/admin/usuario/{usuario}/dados-pessoais', [UsuarioController::class, 'updateDadosPessoais']);
    Route::delete('/admin/usuario/{usuario}', [UsuarioController::class, 'destroy']);

    Route::get('/catalogo/grid', [CatalogoController::class, 'grid']); // Testando esse endpoint
    Route::get('/catalogo/grid/exportar-csv', [CatalogoController::class, 'grid']); // Testando esse endpoint
    Route::get('/catalogo/consulta-extensa', [CatalogoController::class, 'consulta']);
});
// nome, emb_abreviada, preco
Route::get('/firebird-produtos', function () {
    $teste = DB::connection('firebird')->select('SELECT id, emb_abreviada FROM site_produtos');
    return response($teste);
});

Route::get('/firebird-all', function () {
    $teste = DB::connection('firebird')->select('SELECT * FROM site_produtos');
    return response($teste);
});

Route::middleware(['api'])->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

