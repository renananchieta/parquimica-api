<?php

namespace App\Models\Facade;

use App\Http\Resources\Catalogo\CatalogoResource;
use App\Models\Firebird;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class FirebirdDB 
{
    public static function grid($params)
    {
        $query = 'SELECT 
                    DISTINCT(sp.id), 
                    sp.nome, 
                    sp.embalagem, 
                    sp.emb_abreviada, 
                    sp.preco,
                    spl.id_linha,
                    spl.linha_dsc,
                    spf.id_funcao,
                    spf.funcao_dsc 
                    FROM site_produtos sp
                    JOIN site_prod_linha spl ON sp.id = spl.id_prd
                    JOIN site_prod_funcao spf ON sp.id = spf.id_prd';

        $condicionais = [];

        if (isset($params->linhaId)) {
            $condicionais[] = "spl.id_linha = $params->linhaId";
        }

        if (isset($params->funcaoId)) {
            $condicionais[] = "spf.id_funcao = $params->funcaoId";
        }

        if(isset($params->nomeProduto)) {
            $condicionais[] = "sp.nome = $params->nomeProduto";
        }

        if(!empty($condicionais)){
            $query .= ' WHERE ' . implode(' AND ', $condicionais);
        }
    
        $produtos = DB::connection('firebird')->select($query);

        $produtos = array_map(function($produto) {
            $produto = (array) $produto; // Certifique-se de que $produto é um array
            $produto = array_map(function($item) {
                return is_string($item) ? mb_convert_encoding($item, 'UTF-8', 'ISO-8859-1') : $item;
            }, $produto);
            return (object) $produto; // Converter de volta para objeto
        }, $produtos);
    
        return $produtos;
    }

    public static function linhas($params)
    {
        $query = 'SELECT * FROM site_linhas';

        // $condicionais = [];

        if (isset($params->descricao)) {
            $query .= " WHERE descricao LIKE '%$params->descricao%'";
            // $condicionais[] = "id_linha = $params->linhaId";
        }

        // if (isset($params->nome)) {
        //     // $query .= " WHERE prd_nome LIKE '%$params->nome%'";
        //     $condicionais[] = "prd_nome = $params->nome";
        // }

        // if (isset($params->linhaDesc)) {
        //     // $query .= " WHERE linha_dsc LIKE '%$params->linhaDesc%'";
        //     $condicionais[] = "linha_dsc = $params->linhaDesc";
        // }

        // if(!empty($condicionais)){
        //     $query .= ' WHERE ' . implode(' AND ', $condicionais);
        // }
    
        $linhas = DB::connection('firebird')->select($query);

        $linhas = array_map(function($linha) {
            $linha = (array) $linha; 
            $linha = array_map(function($item) {
                return is_string($item) ? mb_convert_encoding($item, 'UTF-8', 'ISO-8859-1') : $item;
            }, $linha);
            return (object) $linha;
        }, $linhas);
    
        return $linhas;
    }

    public static function funcoes($params)
    {
        $query = 'SELECT * FROM site_funcoes';

        if (isset($params->descricao)) {
            $query .= " WHERE descricao LIKE '%$params->descricao%'";
        }
    
        $funcoes = DB::connection('firebird')->select($query);

        $funcoes = array_map(function($funcao) {
            $funcao = (array) $funcao;
            $funcao = array_map(function($item) {
                return is_string($item) ? mb_convert_encoding($item, 'UTF-8', 'ISO-8859-1') : $item;
            }, $funcao);
            return (object) $funcao;
        }, $funcoes);
    
        return $funcoes;
    }

    public static function prodLinha($params)
    {
        $query = 'SELECT * FROM site_prod_linha';

        // if (isset($params->nome)) {
        //     $query .= " WHERE nome LIKE '%$params->nome%'";
        // }
    
        $prodLinhas = DB::connection('firebird')->select($query);

        $prodLinhas = array_map(function($prodLinha) {
            $prodLinha = (array) $prodLinha;
            $prodLinha = array_map(function($item) {
                return is_string($item) ? mb_convert_encoding($item, 'UTF-8', 'ISO-8859-1') : $item;
            }, $prodLinha);
            return (object) $prodLinha;
        }, $prodLinhas);
    
        return $prodLinhas;
    }

    public static function prodFuncao($params)
    {
        $query = 'SELECT * FROM site_prod_funcao';

        // if (isset($params->nome)) {
        //     $query .= " WHERE nome LIKE '%$params->nome%'";
        // }
    
        $prodFuncoes = DB::connection('firebird')->select($query);

        $prodFuncoes = array_map(function($prodFuncao) {
            $prodFuncao = (array) $prodFuncao;
            $prodFuncao = array_map(function($item) {
                return is_string($item) ? mb_convert_encoding($item, 'UTF-8', 'ISO-8859-1') : $item;
            }, $prodFuncao);
            return (object) $prodFuncao;
        }, $prodFuncoes);
    
        return $prodFuncoes;
    }

    public static function exportarCsv($params)
    {
        $data = self::grid($params);

        // Define o nome do arquivo CSV
        $filename = 'produtos.csv';

        // Cria um recurso de memória para o arquivo CSV
        $handle = fopen('php://memory', 'r+');

        // Escreve o cabeçalho no arquivo CSV
        fputcsv($handle, ['ID', 'Nome', 'Embalagem Abreviada', 'Preço']);

        // Escreve os dados no arquivo CSV
        foreach ($data as $row) {
            fputcsv($handle, (array) $row);
        }

        // Retorna ao início do recurso de memória
        rewind($handle);

        // Captura o conteúdo do recurso de memória
        $contents = stream_get_contents($handle);

        // Fecha o recurso de memória
        fclose($handle);

        return [
            'filename' => $filename,
            'content' => $contents
        ];
    }

    public static function consultaExtensa($params)
    {
        $teste = DB::connection('firebird')->select('SELECT id, nome, emb_abreviada, preco FROM site_produtos');
        return $teste;
    }
}
