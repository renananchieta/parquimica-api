<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'index'])->name('/');
Route::get('/home', [SiteController::class, 'index'])->name('home');
Route::get('/empresa', [SiteController::class, 'empresa'])->name('empresa');
Route::get('/certificacoes', [SiteController::class, 'certificacoes'])->name('certificacoes');
Route::get('/contato', [SiteController::class, 'contato'])->name('contato');
Route::get('/cotacao', [SiteController::class, 'cotacao'])->name('cotacao');
Route::get('/produtos', [SiteController::class, 'produtos'])->name('produtos');
Route::get('/produtos/linha/{slug}', [SiteController::class, 'produtos'])->name('produtos-linha');
Route::get('/produtos/funcao/{slug}', [SiteController::class, 'produtos'])->name('produtos-funcao');
Route::get('/linhas', [SiteController::class, 'linhas'])->name('linhas');
Route::get('/funcoes', [SiteController::class, 'funcoes'])->name('funcoes');
// Route::get('/produtos/{linha?}/{funcao?}/{termo?}', [SiteController::class, 'produtos'])->name('produtos');
Route::get('/produto/{slug}', [SiteController::class, 'produto'])->name('produto');
Route::get('/produto-fb/{slug}', [SiteController::class, 'produtofb'])->name('produto-fb');
Route::get('/ficha-tecnica/{slug}', [SiteController::class, 'fichaTecnica'])->name('literatura');
Route::get('/blog', [SiteController::class, 'blog'])->name('blog');
Route::get('/post/{slug}', [SiteController::class, 'post'])->name('post');

Route::post('/enviar/{form}', [SiteController::class, 'enviar'])->name('enviar');

Route::get('/teste-firebird', [SiteController::class, 'testeFirebird'])->name('testeFirebird');

