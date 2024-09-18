<?php

namespace App\Models\Facade;

use App\Models\Entity\Produtos\ProdutosLocal;
use Exception;
use Illuminate\Support\Facades\DB;

class ProdutosLocalDB 
{
    public static function getProdutos($params)
    {
        return ProdutosLocal::where('ativo_site', 1)->get();
    }

    public static function getProdutosTodos($params)
    {
        $query = DB::table('produtos as p')
                    ->select('p.codigo_produto', 'p.nome_produto', 'p.modo_acao')
                    ->join('prod_linha as pl', 'pl.codigo_produto', '=', 'p.codigo_produto')
                    ->join('prod_funcao as pf', 'pf.codigo_produto', '=', 'p.codigo_produto');

        if(isset($params->codigo_produto)) {
            $query->where('p.codigo_produto', $params->codigo_produto);
        }

        if(isset($params->codigo_linha)) {
            $query->where('pl.codigo_linha', $params->codigo_linha);
        }

        if(isset($params->codigo_funcao)) {
            $query->where('pf.codigo_funcao', $params->codigo_funcao);
        }

        $produtos = $query->where('ativo_site', 1)->whereNull('p.deleted_at')->distinct('p.codigo_produto')->orderBy('p.nome_produto')->get();

        return $produtos;
    }

    
    public static function getProdutosTodosPaginado($params)
    {
        $query = DB::table('produtos as p')
            ->select(
                'p.codigo_produto',
                'p.nome_produto',
                'p.modo_acao',
                DB::raw('
                    JSON_ARRAYAGG(
                        JSON_OBJECT(
                            "codigo_linha", pl.codigo_linha,
                            "descricao_linha", l.descricao_linha
                        )
                    ) as linhas
                '),
                DB::raw('
                    JSON_ARRAYAGG(
                        JSON_OBJECT(
                            "codigo_funcao", pf.codigo_funcao,
                            "descricao_funcao", f.descricao_funcao
                        )
                    ) as funcoes
                ')
            )
            ->leftJoin('prod_linha as pl', 'pl.codigo_produto', '=', 'p.codigo_produto')
            ->leftJoin('linha as l', 'l.codigo_linha', '=', 'pl.codigo_linha') // Join para pegar descrição da linha
            ->leftJoin('prod_funcao as pf', 'pf.codigo_produto', '=', 'p.codigo_produto')
            ->leftJoin('funcao as f', 'f.codigo_funcao', '=', 'pf.codigo_funcao') // Join para pegar descrição da função
            ->groupBy('p.codigo_produto', 'p.nome_produto', 'p.modo_acao');
    
        // Filtros opcionais
        if (isset($params->nome_produto)) {
            $query->where('p.nome_produto', 'like', '%' . $params->nome_produto . '%');
        }
    
        if (isset($params->codigo_produto)) {
            $query->where('p.codigo_produto', $params->codigo_produto);
        }
    
        if (isset($params->codigo_linha)) {
            $query->where('pl.codigo_linha', $params->codigo_linha);
        }
    
        if (isset($params->codigo_funcao)) {
            $query->where('pf.codigo_funcao', $params->codigo_funcao);
        }
    
        // Definir a ordenação (asc ou desc)
        $ordem = isset($params->ordem) && in_array($params->ordem, ['asc', 'desc']) ? $params->ordem : 'asc';
    
        // Paginação
        $perPage = isset($params->perPage) && is_numeric($params->perPage) ? $params->perPage : 10;
        $page = isset($params->page) && is_numeric($params->page) ? $params->page : 1;
    
        // Executar a consulta com paginação
        $produtos = $query->where('ativo_site', 1)
            ->whereNull('p.deleted_at')
            ->orderBy('p.nome_produto', $ordem)
            ->paginate($perPage, ['*'], 'page', $page);
    
        // Transformar campos de JSON string para arrays
        $produtos->getCollection()->transform(function ($produto) {
            $produto->linhas = json_decode($produto->linhas, true); // Decodificar JSON para array
            $produto->funcoes = json_decode($produto->funcoes, true); // Decodificar JSON para array
            return $produto;
        });
    
        return $produtos;
    }
    
    
    

    public static function getProdutoLocal($codigo_produto)
    {
        $produtoLocal = DB::table('produtos as p')
            ->leftJoin('prod_linha as pl', 'pl.codigo_produto', '=', 'p.codigo_produto')
            ->leftJoin('prod_funcao as pf', 'pf.codigo_produto', '=', 'p.codigo_produto')
            // ->leftJoin('variantes_produto as vp', 'vp.codigo_produto', '=', 'p.codigo_produto')
            ->where('p.codigo_produto', $codigo_produto)
            ->whereNull('p.deleted_at')
            ->groupBy(
                'p.id',
                'p.codigo_produto',
                'p.nome_produto',
                'p.subtitulo',
                'p.modo_acao',
                'p.slug',
                'p.ativo_site',
                'p.recomendacao',
                'p.variantes',
                'pl.codigo_linha',
                'pl.descricao_linha',
                'pf.codigo_funcao',
                'pf.descricao_funcao',
                // 'vp.codigo_produto_variante',
                // 'vp.descricao_produto_variante',
            )
            ->get([
                'p.id',
                'p.nome_produto',
                'p.codigo_produto',
                'p.subtitulo',
                'p.modo_acao',
                'p.slug',
                'p.ativo_site',
                'p.recomendacao',
                'p.variantes',
                'pl.codigo_linha',
                'pl.descricao_linha',
                'pf.codigo_funcao',
                'pf.descricao_funcao',
                // 'vp.codigo_produto_variante',
                // 'vp.descricao_produto_variante',
            ]);

        $agrupado = [];

        foreach ($produtoLocal as $produto) {
            $idProduto = $produto->id;

            if (!isset($agrupado[$idProduto])) {
                $agrupado[$idProduto] = [
                    'id' => $produto->id,
                    'nome_produto' => $produto->nome_produto,
                    'codigo_produto' => $produto->codigo_produto,
                    'subtitulo' => $produto->subtitulo,
                    'modo_acao' => $produto->modo_acao,
                    'slug' => $produto->slug,
                    'ativo_site' => $produto->ativo_site,
                    'recomendacao' => $produto->recomendacao, 
                    'variantes' => $produto->variantes,
                    'linhas' => [],
                    'funcoes' => [],
                    // 'variantes' => [],
                ];
            }

            // Verifica se a linha já foi adicionada
            $linhaExiste = false;
            foreach ($agrupado[$idProduto]['linhas'] as $linha) {
                if ($linha['codigo_linha'] === $produto->codigo_linha && $linha['descricao_linha'] === $produto->descricao_linha) {
                    $linhaExiste = true;
                    break;
                }
            }

            if (!$linhaExiste) {
                $agrupado[$idProduto]['linhas'][] = [
                    'codigo_linha' => $produto->codigo_linha,
                    'descricao_linha' => $produto->descricao_linha,
                ];
            }

            // Verifica se a função já foi adicionada
            $funcaoExiste = false;
            foreach ($agrupado[$idProduto]['funcoes'] as $funcao) {
                if ($funcao['codigo_funcao'] === $produto->codigo_funcao && $funcao['descricao_funcao'] === $produto->descricao_funcao) {
                    $funcaoExiste = true;
                    break;
                }
            }

            if (!$funcaoExiste) {
                $agrupado[$idProduto]['funcoes'][] = [
                    'codigo_funcao' => $produto->codigo_funcao,
                    'descricao_funcao' => $produto->descricao_funcao,
                ];
            }

            // Verifica se a variante já foi adicionada
            // $varianteExiste = false;
            // foreach ($agrupado[$idProduto]['variantes'] as $variante) {
            //     if ($variante['codigo_produto'] === $produto->codigo_produto_variante && $variante['nome_produto'] === $produto->descricao_produto_variante) {
            //         $varianteExiste = true;
            //         break;
            //     }
            // }

            // if (!$varianteExiste) {
            //     $agrupado[$idProduto]['variantes'][] = [
            //         'codigo_produto' => $produto->codigo_produto_variante,
            //         'nome_produto' => $produto->descricao_produto_variante,
            //     ];
            // }
        }

        if($agrupado) {
            return array_values($agrupado);
        } else {
            throw new Exception('Não foi encontrado nenhum produto.');
        }

    }

    public static function getProdutoLocal2($codigo_produto)
    {
        $produtoLocal = DB::table('produtos as p')
            ->join('prod_linha as pl', 'pl.codigo_produto', '=', 'p.codigo_produto')
            ->join('prod_funcao as pf', 'pf.codigo_produto', '=', 'p.codigo_produto')
            ->where('p.codigo_produto', $codigo_produto)
            ->get([
                'p.id',
                'p.nome_produto',
                'p.codigo_produto',
                'p.subtitulo',
                'p.modo_acao',
                'p.slug',
                'p.ativo_site',
                'p.variantes',
                'p.recomendacao',
                'pl.codigo_linha',
                'pf.codigo_funcao',
            ]);
    
        // Agrupando os dados para o formato desejado
        $agrupado = [];
    
        foreach ($produtoLocal as $produto) {
            $idProduto = $produto->id;
    
            if (!isset($agrupado[$idProduto])) {
                $agrupado[$idProduto] = [
                    'id' => $produto->id,
                    'nome_produto' => $produto->nome_produto,
                    'codigo_produto' => $produto->codigo_produto,
                    'subtitulo' => $produto->subtitulo,
                    'modo_acao' => $produto->modo_acao,
                    'slug' => $produto->slug,
                    'ativo_site' => $produto->ativo_site,
                    'variantes' => $produto->variantes,
                    'recomendacao' => $produto->recomendacao,
                    'linhas' => [],
                    'funcoes' => [],
                ];
            }
    
            // Verifica se a linha já foi adicionada
            $linhaExiste = false;
            foreach ($agrupado[$idProduto]['linhas'] as $linha) {
                if ($linha['codigo_linha'] === $produto->codigo_linha) {
                    $linhaExiste = true;
                    break;
                }
            }
    
            if (!$linhaExiste) {
                $agrupado[$idProduto]['linhas'][] = [
                    'codigo_linha' => $produto->codigo_linha,
                ];
            }
    
            // Verifica se a função já foi adicionada
            $funcaoExiste = false;
            foreach ($agrupado[$idProduto]['funcoes'] as $funcao) {
                if ($funcao['codigo_funcao'] === $produto->codigo_funcao) {
                    $funcaoExiste = true;
                    break;
                }
            }
    
            if (!$funcaoExiste) {
                $agrupado[$idProduto]['funcoes'][] = [
                    'codigo_funcao' => $produto->codigo_funcao,
                ];
            }
        }
    
        return array_values($agrupado);
    }

    public static function getComboProdutos()
    {
        return  ProdutosLocal::get(['codigo_produto', 'nome_produto']);
    }
}
