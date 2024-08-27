<?php

namespace App\Models\Facade;

use App\Models\Entity\Produtos\ProdutosLocal;

class ProdutosLocalDB 
{
    public static function getProdutos($params)
    {
        return ProdutosLocal::where('ativo_site', 1)->get();
    }

    public static function getProdutosTodos($params)
    {
        $query = ProdutosLocal::query();

        if(isset($params->nome_produto)) {
            $query->where('nome_produto', 'like', '%' . $params->nome_produto . '%');
        }

        if(isset($params->ativo_site)) {
            $query->where('nome_produto', $params->ativo_site);
        }

        $produtos = $query->get();

        // return ProdutosLocal::where('ativo_site', 1)->get();
        return $produtos;
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
