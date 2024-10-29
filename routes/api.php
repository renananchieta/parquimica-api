<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Blog\BlogPostagemController;
use App\Http\Controllers\Catalogo\CatalogoController;
use App\Http\Controllers\ImpressaoController;
use App\Http\Controllers\Produtos\LinhafuncaoController;
use App\Http\Controllers\Produtos\ProdutosLocalController;
use App\Http\Controllers\Seguranca\PerfilController;
use App\Http\Controllers\Seguranca\UsuarioController;
use App\Http\Controllers\Site\SitePostagemController;
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
    // Route::get('/catalogo/grid', [CatalogoController::class, 'grid']); // Testando esse endpoint
    Route::get('/catalogo/grid/exportar-csv', [CatalogoController::class, 'grid']); // Testando esse endpoint
    Route::get('/catalogo/consulta-extensa', [CatalogoController::class, 'consulta']);

    // Detalhes de produtos
    Route::get('/firebird/linhas', [CatalogoController::class, 'linhas']);
    Route::get('/firebird/funcoes', [CatalogoController::class, 'funcoes']);
    Route::get('/firebird/prod-linha', [CatalogoController::class, 'prodLinha']);
    Route::get('/firebird/prod-funcao', [CatalogoController::class, 'prodFuncao']);

    //Combo Produtos
    Route::get('/combo/produtos', [ProdutosLocalController::class, 'comboProdutos']);

    //Adicionar o produto na base local para alimentar o Site
    // Route::post('/area-restrita/produtos', [ProdutosLocalController::class, 'store']);
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
Route::get('/firebird/site-prod-lista', [CatalogoController::class, 'siteProdLista']);
Route::get('/firebird/site-prod-lista/nao-tratado', [CatalogoController::class, 'siteProdListaNaoTratado']);
Route::get('/firebird/site-prod-detalhes', [CatalogoController::class, 'siteProdDetalhes']);
Route::get('/firebird/site-prod-variantes', [CatalogoController::class, 'siteProdVariantes']);


//Base local
Route::get('/area-restrita/puxar-base-firebird-para-base-local', [ProdutosLocalController::class, 'cadastrarProdutosBaseLocal']);
Route::get('/area-restrita/puxar-linha-funcao-para-base-local', [LinhafuncaoController::class, 'cadastrarLinhaFuncaoBaseLocal']);
Route::get('/area-restrita/puxar-prodlinha-prodfuncao-para-base-local', [LinhafuncaoController::class, 'cadastrarProdLinhaProdFuncaoBaseLocal']);
Route::get('/area-restrita/produto/update/ativo-site', [ProdutosLocalController::class, 'updateAtivoSite']);
Route::get('/area-restrita/produtos/salvar-na-minha-maquina', [ProdutosLocalController::class, 'salvarNaMinhaMaquina']);
Route::get('/area-restrita/linha-funcao/salvar-na-minha-maquina', [LinhafuncaoController::class, 'salvarNaMinhaMaquinaLinhaFuncao']);
Route::get('/area-restrita/prod-linha-prod-funcao/salvar-na-minha-maquina', [LinhafuncaoController::class, 'salvarNaMinhaMaquinaProdLinhaProdFuncao']);

// Produtos
Route::get('/catalogo/grid', [CatalogoController::class, 'grid']); // Testando esse endpoint
Route::get('/area-restrita/produtos/base-local', [ProdutosLocalController::class, 'index']);
Route::get('/area-restrita/produtos/paginate', [ProdutosLocalController::class, 'produtosPaginate']);
Route::get('/area-restrita/produtos/base-local/todos', [ProdutosLocalController::class, 'gridProdutos']);
Route::post('/area-restrita/produtos', [ProdutosLocalController::class, 'store']);
Route::get('/area-restrita/produto/{codigo_produto}', [ProdutosLocalController::class, 'show']);
Route::put('/area-restrita/produto/{codigo_produto}/update', [ProdutosLocalController::class, 'update']);
Route::get('/area-restrita/combos/linhas-funcoes', [LinhafuncaoController::class, 'combos']);
Route::get('/area-restrita/produtos/exibir-imagem/{id}', [ProdutosLocalController::class, 'showArquivo']);
Route::delete('/area-restrita/produto/{id}', [ProdutosLocalController::class, 'destroy']);

// Postagem Site
Route::post('/area-restrita/site/postagem/store', [SitePostagemController::class, 'store']);
Route::get('/area-restrita/site/postagem/grid', [SitePostagemController::class, 'index']);
Route::get('/area-restrita/site/postagem/show/{id}', [SitePostagemController::class, 'show']);
Route::put('/area-restrita/site/postagem/update/{postagemSite}', [SitePostagemController::class, 'update']);
Route::delete('/area-restrita/site/postagem/{id}', [SitePostagemController::class, 'delete']);

// Postagem Blog
Route::post('/area-restrita/blog/postagem/store', [BlogPostagemController::class, 'store']);
Route::get('/area-restrita/blog/postagem/grid', [BlogPostagemController::class, 'index']);
Route::get('/area-restrita/blog/postagem/show/{id}', [BlogPostagemController::class, 'show']);
Route::put('/area-restrita/blog/postagem/update/{postagemBlog}', [BlogPostagemController::class, 'update']);
Route::delete('/area-restrita/blog/postagem/{id}', [BlogPostagemController::class, 'delete']);

// Route::get('/area-restrita/puxar-linha-funcao-para-base-local', [LinhafuncaoController::class, 'cadastrarLinhaFuncao']);
// teste

Route::get('/teste-requisicao', [SitePostagemController::class, 'testeRequisicao']);