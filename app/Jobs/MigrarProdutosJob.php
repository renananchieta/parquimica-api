<?php

namespace App\Jobs;

use App\Models\Entity\Produtos\ProdutosLocal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class MigrarProdutosJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $query = '
        SELECT 
            id, 
            nome
        FROM site_produtos
        ORDER BY id
        ';

        $produtos = DB::connection('firebird')->select($query);

        $produtos = array_map(function($produto) {
            $produto = (array) $produto; // Certifique-se de que $produto é um array
            $produto = array_map(function($item) {
                return is_string($item) ? mb_convert_encoding($item, 'UTF-8', 'ISO-8859-1') : $item;
            }, $produto);
            return (object) $produto; // Converter de volta para objeto
        }, $produtos);

        // dd($produtos);
        
        foreach($produtos as $produto) {
            $prod = (array)$produto;
            // dd($produtos);
            // dd($prod);
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
    
            // dd($groupedLiteraturas);

            $produto = (array)$groupedLiteraturas[0];
            $codigo_produto = $produto['PRD_COD'];
            // dd($codigo_produto);
            $nome_produto = $produto['PRD_NOME'];
            $subtitulo_produto = $produto['PRD_LIT_DSC'];
            $modo_acao = $produto['detalhes'][0]['LID_DSC'];

            $p = new ProdutosLocal();
            $p->codigo_produto = $codigo_produto;
            $p->nome_produto = $nome_produto;
            $p->subtitulo = $subtitulo_produto;
            $p->modo_acao = $modo_acao;
            $p->save();
    
            // return $p;
        }
    }
}
