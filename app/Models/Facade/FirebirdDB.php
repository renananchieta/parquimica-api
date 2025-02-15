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
                    sp.id, 
                    sp.nome, 
                    sp.embalagem, 
                    sp.emb_abreviada, 
                    sp.preco,
                    sp.ativo_site,
                    spf.id_funcao,
                    spf.funcao_dsc,
                    spl.id_linha,
                    spl.linha_dsc
                FROM site_produtos sp
                JOIN site_prod_linha spl ON sp.id = spl.id_prd
                JOIN site_prod_funcao spf ON sp.id = spf.id_prd';
        
        $condicionais = [];

        if (isset($params->produtoId)) {
            $condicionais[] = "sp.id = $params->produtoId";
        }
        
        if (isset($params->linhaId)) {
            $condicionais[] = "spl.id_linha = $params->linhaId";
        }

        if (isset($params->funcaoId)) {
            $condicionais[] = "spf.id_funcao = $params->funcaoId";
        }

        if (isset($params->nomeProduto)) {
            $condicionais[] = "sp.nome = '" . addslashes($params->nomeProduto) . "'";
        }

        if (isset($params->ativoSite)) {
            $condicionais[] = "sp.ativo_site = $params->ativoSite";
        }

        if (empty($params->ativoSite)) {
            $condicionais[] = "sp.ativo_site = 1";
        }

        if (!empty($condicionais)) {
            $query .= ' WHERE ' . implode(' AND ', $condicionais);
        }

        $produtos = DB::connection('firebird')->select($query);

        $produtosAgrupados = []; // Inicialize a variável para armazenar os produtos agrupados

        foreach ($produtos as $produto) {
            $produto = (array) $produto; // Certifique-se de que $produto é um array

            // Converta a codificação, se necessário
            $produto = array_map(function ($item) {
                return is_string($item) ? mb_convert_encoding($item, 'UTF-8', 'ISO-8859-1') : $item;
            }, $produto);

            // Verifique se a chave 'ID' existe
            if (!isset($produto['ID'])) {
                continue; // Se não existir, pule para o próximo produto
            }

            // Agrupar produtos pelo ID
            $id = $produto['ID'];
            if (!isset($produtosAgrupados[$id])) {
                // Se ainda não existir, inicialize a estrutura do produto
                $produtosAgrupados[$id] = (object) [
                    'id' => $produto['ID'],
                    'nome' => $produto['NOME'],
                    'embalagem' => $produto['EMBALAGEM'],
                    'emb_abreviada' => $produto['EMB_ABREVIADA'],
                    'preco' => $produto['PRECO'],
                    'ativo_site' => $produto['ATIVO_SITE'],
                    'funcoes' => [],
                    'linhas' => [],
                ];
            }

            // Adicione as funções como objetos
            if (isset($produto['FUNCAO_DSC']) && !in_array($produto['FUNCAO_DSC'], array_column($produtosAgrupados[$id]->funcoes, 'descricao'))) {
                $produtosAgrupados[$id]->funcoes[] = (object) [
                    'id_funcao' => $produto['ID_FUNCAO'],
                    'descricao' => $produto['FUNCAO_DSC']
                ];
            }

            // Adicione as linhas como objetos
            if (isset($produto['LINHA_DSC']) && !in_array($produto['LINHA_DSC'], array_column($produtosAgrupados[$id]->linhas, 'descricao'))) {
                $produtosAgrupados[$id]->linhas[] = (object) [
                    'id_linha' => $produto['ID_LINHA'],
                    'descricao' => $produto['LINHA_DSC']
                ];
            }
        }

        // Converter para array e retornar
        return array_values($produtosAgrupados);
    }


    public static function comboProdutos($params)
    {
        $query = '
                SELECT 
                    DISTINCT(id), 
                    nome
                FROM site_produtos
                ';

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

    public static function literatura($params)
    {
        $query = 'SELECT * FROM literatura(?)';
        $literaturas = DB::connection('firebird')->select($query, [$params->codigo_produto]);

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

    public static function literaturaTeste($params)
    {
        $query = 'SELECT * FROM literatura(?)';
        $literaturas = DB::connection('firebird')->select($query, [$params->codigo_produto]);

        $literaturas = array_map(function($literatura) {
            $literatura = (array) $literatura;
            $literatura = array_map(function($item) {
                return is_string($item) ? mb_convert_encoding($item, 'UTF-8', 'ISO-8859-1') : $item;
            }, $literatura);
            return (object) $literatura;
        }, $literaturas);

        return $literaturas;

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
    
    public static function exportarCsv($params)
    {
        $data = self::grid($params);

        $filename = 'produtos.csv';

        $handle = fopen('php://memory', 'r+');

        fputcsv($handle, ['ID', 'Nome', 'Embalagem Abreviada', 'Preço']);

        foreach ($data as $row) {
            fputcsv($handle, (array) $row);
        }

        rewind($handle);

        $contents = stream_get_contents($handle);

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

    public static function grid2($params)
    {
        $query = '
            SELECT * FROM site_produtos
                WHERE ID <> 533
                ORDER BY id
            ';

        $condicionais = [];

        if(isset($params->nomeProduto)) {
            $condicionais[] = "sp.nome = $params->nomeProduto";
        }

        if(!empty($condicionais)){
            $query .= ' WHERE ' . implode(' AND ', $condicionais);
        }
    
        $produtos = DB::connection('firebird')->select($query);

        $produtos = array_map(function($produto) {
            $produto = (array) $produto; 
            $produto = array_map(function($item) {
                return is_string($item) ? mb_convert_encoding($item, 'UTF-8', 'ISO-8859-1') : $item;
            }, $produto);
            return (object) $produto; 
        }, $produtos);
    
        return $produtos;
    }

    public static function siteProdListabkp($params)
    {
        $query = '
            SELECT * FROM site_prod_lista
        ';

        $condicionais = [];
        
        if (isset($params->id_base)) {
            $condicionais[] = "id_base = $params->id_base";
        }

        if (isset($params->nome)) {
            $nome = addslashes(strtoupper($params->nome));
            $condicionais[] = "nome LIKE '%$nome%'";
        }
    
        if (isset($params->slug)) {
            $slug = addslashes(strtolower($params->slug));
            $condicionais[] = "slug LIKE '%$slug%'";
        }

        if(!empty($condicionais)){
            $query .= ' WHERE ' . implode(' AND ', $condicionais);
        }

        if (isset($params->linha)) {
            $linha = addslashes(strtoupper($params->linha));
            $condicionais[] = "linha LIKE '%$linha%'";
        }

        if (isset($params->funcao)) {
            $funcao = addslashes(strtolower($params->funcao));
            $condicionais[] = "funcao LIKE '%$funcao%'";
        }
    
        $produtos = DB::connection('firebird')->select($query);

        $produtos = array_map(function($produto) {
            $produto = (array) $produto; 
            $produto = array_map(function($item) {
                return is_string($item) ? mb_convert_encoding($item, 'UTF-8', 'ISO-8859-1') : $item;
            }, $produto);
            return (object) $produto; 
        }, $produtos);
    
        return $produtos;
    }

    public static function siteProdLista($params)
    {
        $query = '
            SELECT * FROM site_prod_lista
        ';

        $condicionais = [];
        
        if (isset($params->id_base)) {
            $condicionais[] = "id_base = $params->id_base";
        }

        if (isset($params->nome)) {
            $nome = addslashes(strtoupper($params->nome));
            $condicionais[] = "nome LIKE '%$nome%'";
        }
    
        if (isset($params->slug)) {
            $slug = addslashes(strtolower($params->slug));
            $condicionais[] = "slug LIKE '%$slug%'";
        }
        
        if (isset($params->linha)) {
            $linha = addslashes(strtoupper($params->linha));
            $condicionais[] = "linha LIKE '%$linha%'";
        }

        if (isset($params->funcao)) {
            $funcao = ucfirst(strtolower(addslashes($params->funcao)));
            $condicionais[] = "funcao LIKE '%$funcao%'";
        }
        
        if (isset($params->slug_linha)) {
            $slug_linha = addslashes(strtolower($params->slug_linha));
            $condicionais[] = "slug_linha LIKE '%$slug_linha%'";
        }

        if (isset($params->slug_funcao)) {
            $slug_funcao = addslashes(strtolower($params->slug_funcao));
            $condicionais[] = "slug_funcao LIKE '%$slug_funcao%'";
        }

        if(!empty($condicionais)){
            $query .= ' WHERE ' . implode(' AND ', $condicionais);
        }

        $query .= 'ORDER BY nome';

    
        $produtos = DB::connection('firebird')->select($query);

        $produtosAgrupados = [];

        foreach($produtos as $produto) {
            $produto = (array)$produto;

            $produto = array_map(function ($item) {
                return is_string($item) ? mb_convert_encoding($item, 'UTF-8', 'ISO-8859-1') : $item;
            }, $produto);

            if(!isset($produto['ID_BASE'])) {
                continue;
            }

            $id = $produto['ID_BASE'];

            if(!isset($produtosAgrupados[$id])) {
                $produtosAgrupados[$id] = (Object) [
                    'id_base' => $produto['ID_BASE'],
                    'nome' => $produto['NOME'],
                    'slug' => $produto['SLUG'],
                    'linha' => [],
                    'funcao' => [],
                    'slug_linha' => [],
                    'slug_funcao' => []
                ];
            }

            if(isset($produto['LINHA']) && !in_array($produto['LINHA'], $produtosAgrupados[$id]->linha)) {
                $produtosAgrupados[$id]->linha[] = $produto['LINHA'];
            }

            if(isset($produto['FUNCAO']) && !in_array($produto['FUNCAO'], $produtosAgrupados[$id]->funcao)) {
                $produtosAgrupados[$id]->funcao[] = $produto['FUNCAO'];
            }

            if(isset($produto['SLUG_LINHA']) && !in_array($produto['SLUG_LINHA'], $produtosAgrupados[$id]->slug_linha)) {
                $produtosAgrupados[$id]->slug_linha[] = $produto['SLUG_LINHA'];
            }

            if(isset($produto['SLUG_FUNCAO']) && !in_array($produto['SLUG_FUNCAO'], $produtosAgrupados[$id]->slug_funcao)) {
                $produtosAgrupados[$id]->slug_funcao[] = $produto['SLUG_FUNCAO'];
            }
        }

        return array_values($produtosAgrupados);
    }

    public static function siteProdDetalhes($params)
    {
        $id_base = (int) $params->id_base;
        $query = 'SELECT * FROM site_prod_detalhes(?)';
        $literaturas = DB::connection('firebird')->select($query, [$id_base]);
        
        $literaturas = array_map(function($literatura) {
            $literatura = (array) $literatura;
            $literatura = array_map(function($item) {
                return is_string($item) ? mb_convert_encoding($item, 'UTF-8', 'ISO-8859-1') : $item;
            }, $literatura);
            return (object) $literatura;
        }, $literaturas);
        
        return $literaturas;
    }

    public static function siteProdVariantes($params)
    {
        $id_base = (int) $params->id_base;
        $query = 'SELECT * FROM site_prod_variantes(?)';
        $literaturas = DB::connection('firebird')->select($query, [$id_base]);
        
        $literaturas = array_map(function($literatura) {
            $literatura = (array) $literatura;
            $literatura = array_map(function($item) {
                return is_string($item) ? mb_convert_encoding($item, 'UTF-8', 'ISO-8859-1') : $item;
            }, $literatura);
            return (object) $literatura;
        }, $literaturas);
        
        return $literaturas;
    }
}
