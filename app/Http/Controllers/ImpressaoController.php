<?php

namespace App\Http\Controllers;

use App\Models\Facade\FirebirdDB;
use App\Models\Regras\ConfigurarPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImpressaoController extends Controller
{
    public function gerarPDF(Request $request)
    {
        $p = (Object)$request->all();

        if (isset($p->imprime_literatura)){
            $query = 'SELECT * FROM literatura(?)';
            $literaturas = DB::connection('firebird')->select($query, [$p->codigo_produto]);

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

            $pdf = ConfigurarPDF::configurar('produto.literatura_pdf', compact('groupedLiteraturas'));

            return $pdf->setPaper('a4', 'portrait')->stream();
        }

    }
}
