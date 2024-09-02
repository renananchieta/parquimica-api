<?php

namespace App\Http\Controllers\Produtos;

use App\Http\Controllers\Controller;
use App\Models\Entity\Produtos\Funcao;
use App\Models\Entity\Produtos\Linha;
use App\Models\Entity\Produtos\ProdFuncao;
use App\Models\Entity\Produtos\ProdLinha;
use App\Models\Facade\FirebirdDB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LinhafuncaoController extends Controller
{
    public function cadastrarLinhaFuncao(Request $request)
    {
        $params = (Object)$request->all();

        try{
            $linhas = FirebirdDB::linhas($params);

            foreach($linhas as $linha) {
                $l = new Linha();
    
                $l->codigo_linha = $linha->ID;
                $l->descricao_linha = $linha->DESCRICAO;
                $l->save();
            }
    
            $funcoes = FirebirdDB::funcoes($params);
    
            foreach($funcoes as $funcao) {
                $f = new Funcao();
    
                $f->codigo_funcao = $funcao->ID;
                $f->descricao_funcao = $funcao->DESCRICAO;
                $f->save();
            }
    
           
            return response(['mensagem' => 'Linhas e produtos cadastrados com sucesso'], 201);
        } catch(Exception $e) {

            return response(['error' => 'Não foi possível cadastrar.'], 500);

        }
        
    }

    public function salvarNaMinhaMaquinaLinhaFuncao()
    {
        $response = Http::withOptions([
            'verify' => false,
        ])->get('https://srcs.parquimica.com.br/api/firebird/linhas');

        if ($response->successful()) {
            $linhas = $response->json(); 

            foreach($linhas as $linha) {
                $l = new Linha();
    
                $l->codigo_linha = $linha['ID'];
                $l->descricao_linha = $linha['DESCRICAO'];
                $l->save();
            }
        }

        $response2 = Http::withOptions([
            'verify' => false,
        ])->get('https://srcs.parquimica.com.br/api/firebird/funcoes');

        if ($response2->successful()) {
            $funcoes = $response2->json(); 
            foreach($funcoes as $funcao) {
                $f = new Funcao();
    
                $f->codigo_funcao = $funcao['ID'];
                $f->descricao_funcao = $funcao['DESCRICAO'];
                $f->save();
            }
        }

        return response(['mensagem' => 'Linhas e funções cadastrados com sucesso'], 201);
    }

    public function combos()
    {
        $linhas = Linha::select('codigo_linha', 'descricao_linha')->orderBy('descricao_linha')->get();
        $funcoes = Funcao::select('codigo_funcao', 'descricao_funcao')->orderBy('descricao_funcao')->get();

        return response([
            'linhas' => $linhas,
            'funcoes' => $funcoes
        ]); 
    }

    public function salvarNaMinhaMaquinaProdLinhaProdFuncao()
    {
        $response = Http::withOptions([
            'verify' => false,
        ])->get('https://srcs.parquimica.com.br/api/firebird/prod-linha');

        if ($response->successful()) {
            $prodlinhas = $response->json(); 

            foreach($prodlinhas as $linha) {
                $pl = new ProdLinha();
    
                $pl->codigo_linha = $linha['ID_LINHA'];
                $pl->descricao_linha = $linha['LINHA_DSC'];
                $pl->codigo_produto = $linha['ID_PRD'];
                $pl->save();
            }
        }

        $response2 = Http::withOptions([
            'verify' => false,
        ])->get('https://srcs.parquimica.com.br/api/firebird/prod-funcao');

        if ($response2->successful()) {
            $prodfuncoes = $response2->json(); 
            foreach($prodfuncoes as $funcao) {
                $pf = new ProdFuncao();
    
                $pf->codigo_funcao = $funcao['ID_FUNCAO'];
                $pf->descricao_funcao = $funcao['FUNCAO_DSC'];
                $pf->codigo_produto = $funcao['ID_PRD'];
                $pf->save();
            }
        }

        return response(['mensagem' => 'Relacionamento de Linhas e Funções produtos cadastrados com sucesso'], 201);
    }

    public function cadastrarLinhaFuncaoBaseLocal(Request $request)
    {
        $params = (Object)$request->all();
        //Consultar linha
        $linhas = FirebirdDB::linhas($params);

        //Cadastrar Linha na base Local
        foreach($linhas as $linha) {
            $l = new Linha();

            $l->codigo_linha = $linha['ID'];
            $l->descricao_linha = $linha['DESCRICAO'];
            $l->save();
        }


        //Consultar Função
        $funcoes = FirebirdDB::funcoes($params);

        //Cadastrar função base local
        foreach($funcoes as $funcao) {
            $f = new Funcao();

            $f->codigo_funcao = $funcao['ID'];
            $f->descricao_funcao = $funcao['DESCRICAO'];
            $f->save();
        }

        return response(['mensagem' => 'Linhas e funções cadastrados com sucesso'], 201);
    }

    public function cadastrarProdLinhaProdFuncaoBaseLocal(Request $request)
    {
        $params = (Object)$request->all();
        
        //Consultar Prod-Linha
        $prodLinhas = FirebirdDB::prodLinha($params);

        //Salvar Prod-Linha
        foreach($prodLinhas as $linha) {
            $pl = new ProdLinha();

            $pl->codigo_linha = $linha['ID_LINHA'];
            $pl->descricao_linha = $linha['LINHA_DSC'];
            $pl->codigo_produto = $linha['ID_PRD'];
            $pl->save();
        }

        //Consultar Prod-Função
        $prodFuncao = FirebirdDB::prodFuncao($params);

        //Salvar Prod-Função
        foreach($prodFuncao as $funcao) {
            $pf = new ProdFuncao();

            $pf->codigo_funcao = $funcao['ID_FUNCAO'];
            $pf->descricao_funcao = $funcao['FUNCAO_DSC'];
            $pf->codigo_produto = $funcao['ID_PRD'];
            $pf->save();
        }

        return response(['mensagem' => 'Relacionamento de Linhas e Funções produtos cadastrados com sucesso'], 201)
    }
}
