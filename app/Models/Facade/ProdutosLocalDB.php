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
}
