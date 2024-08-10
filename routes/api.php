<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Catalogo\CatalogoController;
use App\Http\Controllers\ImpressaoController;
use App\Http\Controllers\Produtos\ProdutosLocalController;
use App\Http\Controllers\Seguranca\PerfilController;
use App\Http\Controllers\Seguranca\UsuarioController;
use App\Models\Entity\Produtos\ProdutosLocal;
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

    // Catálogo de produtos
    Route::get('/catalogo/grid', [CatalogoController::class, 'grid']); // Testando esse endpoint
    Route::get('/catalogo/grid/exportar-csv', [CatalogoController::class, 'grid']); // Testando esse endpoint
    Route::get('/catalogo/consulta-extensa', [CatalogoController::class, 'consulta']);

    // Detalhes de produtos
    Route::get('/firebird/linhas', [CatalogoController::class, 'linhas']);
    Route::get('/firebird/funcoes', [CatalogoController::class, 'funcoes']);
    Route::get('/firebird/prod-linha', [CatalogoController::class, 'prodLinha']);
    Route::get('/firebird/prod-funcao', [CatalogoController::class, 'prodFuncao']);

    //Combo Produtos
    Route::get('/combo/produtos', [CatalogoController::class, 'comboProdutos']);

    //Adicionar o produto na base local para alimentar o Site
    Route::post('/area-restrita/produtos', [ProdutosLocalController::class, 'store']);
});

Route::middleware(['api'])->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

/**
 * Endpoints para testar as querys sem estar autenticado.
 */
Route::get('/catalogo/grid2', [CatalogoController::class, 'grid2']);
Route::get('/produtos', [CatalogoController::class, 'produtos']);
Route::get('/firebird-produtos', function () {
    $produtos  = DB::connection('firebird')->select('SELECT id, nome, emb_abreviada, preco FROM site_produtos');
    $produtos = array_map(function($produto) {
        return array_map(function($item) {
            return is_string($item) ? mb_convert_encoding($item, 'UTF-8', 'ISO-8859-1') : $item;
        }, (array)$produto);
    }, $produtos);

    return response($produtos);
});

Route::get('/firebird-all', function () {
    $produtos = DB::connection('firebird')->select('SELECT * FROM site_produtos');
    $produtos = array_map(function($produto) {
        return array_map(function($item) {
            return is_string($item) ? mb_convert_encoding($item, 'UTF-8', 'ISO-8859-1') : $item;
        }, (array)$produto);
    }, $produtos);

    return response($produtos);
});

Route::get('/firebird/linhas', [CatalogoController::class, 'linhas']);
Route::get('/firebird/funcoes', [CatalogoController::class, 'funcoes']);
Route::get('/firebird/prod-linha', [CatalogoController::class, 'prodLinha']);
Route::get('/firebird/prod-funcao', [CatalogoController::class, 'prodFuncao']);
Route::get('/firebird/literatura/{codigo_produto}', [CatalogoController::class, 'literatura']);
Route::get('/firebird/literatura/{codigo_produto}/teste', [CatalogoController::class, 'literaturaTeste']);
Route::get('/impressao/{codigo_produto}', [ImpressaoController::class, 'gerarPdf']);



