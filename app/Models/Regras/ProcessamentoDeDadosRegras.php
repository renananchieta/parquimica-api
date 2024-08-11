<?php

namespace App\Models\Regras;

use App\Models\Entity\Produtos\ProdutosLocal;
use App\Models\Entity\Produtos\UploadProdutosLocal;
use App\Models\Entity\Produtos\VariantesProduto;
use Exception;
use Illuminate\Support\Facades\DB;

class ProcessamentoDeDadosRegras 
{
    public static function literaturaProduto($data)
    {
        foreach($data as $produto) {
            $prod = (array)$produto;

            $codigo_produto = $prod['ID'];

            $query = 'SELECT * FROM literatura(?)';
            $literaturas = DB::connection('firebird')->select($query, [$codigo_produto]);
    
            $literaturas = array_map(function($literatura) {
                $literatura = (array) $literatura;
                $literatura = array_map(function($item) {
                    return is_string($item) ? mb_convert_encoding($item, 'UTF-8', 'ISO-8859-1') : $item;
                }, $literatura);
                return (object) $literatura;
            }, $literaturas);
    
            $groupedLiteraturas = []; // Agrupa os resultados por PRD_COD
            foreach ($literaturas as $literatura) {
                $prdCod = $literatura->PRD_COD;
    
                if (!isset($groupedLiteraturas[$prdCod])) {
                    $groupedLiteraturas[$prdCod] = [
                        'PRD_COD' => $literatura->PRD_COD,
                        'PRD_NOME' => $literatura->PRD_NOME,
                        'PRD_LIT_DSC' => $literatura->PRD_LIT_DSC,
                        'detalhes' => []
                    ];
                }
    
                $groupedLiteraturas[$prdCod]['detalhes'][] = [
                    'LITENS_ID' => $literatura->LITENS_ID,
                    'LITENS_DSC' => $literatura->LITENS_DSC,
                    'LID_ID' => $literatura->LID_ID,
                    'LID_DSC' => $literatura->LID_DSC
                ];
            }
    
            $groupedLiteraturas = array_values(array_map(function($item) { // Converte o array associativo em uma lista de objetos
                return (object) $item;
            }, $groupedLiteraturas));
    
            return $groupedLiteraturas;
        }
    }

    public static function salvarProdutoBaseLocal($data)
    {
        $produto = (array)$data[0];
        // dd($produto);
        $codigo_produto = $produto['PRD_COD'];
        $nome_produto = $produto['PRD_NOME'];
        $subtitulo_produto = $produto['PRD_LIT_DSC'];
        $modo_acao = $data['detalhes'][0]['LID_DSC'];
        dd($produto);

        
        

    }
}
