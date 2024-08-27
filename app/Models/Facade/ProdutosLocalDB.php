<?php

namespace App\Models\Facade;

use App\Models\Entity\Produtos\ProdutosLocal;

class ProdutosLocalDB 
{
    public static function getProdutos($params)
    {
        // $currentPage = isset($params->page) ? $params->page : 1;
        // $perPage = isset($params->perPage) ? $params->perPage : 100;

        // $produtosLocal = ProdutosLocal::paginate($perPage, ['*'], 'page', $currentPage);

        // return $produtosLocal;

        return ProdutosLocal::all();
    }

    public static function getProdutoLocal($codigo_produto)
    {
        $produtoLocal = ProdutosLocal::where('codigo_produto', $codigo_produto)->get();

        return $produtoLocal;
    }

    public static function getComboProdutos()
    {
        return  ProdutosLocal::get(['codigo_produto', 'nome_produto']);
    }
}
