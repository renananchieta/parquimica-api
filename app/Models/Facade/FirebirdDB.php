<?php

namespace App\Models\Facade;

use App\Models\Firebird;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class FirebirdDB 
{
    public static function grid($params)
    {
        $query = 'SELECT id, nome, emb_abreviada, preco FROM site_produtos';

        if (isset($params->nome)) {
            $query .= " WHERE nome LIKE '%$params->nome%'";
        }
    
        $result = DB::connection('firebird')->select($query);

        return $result;
    }

    public static function exportarCsv($params)
    {
        $data = self::grid($params);

        // Cria um cabeçalho para o CSV
        $csvHeader = ['ID', 'Nome', 'Embalagem Abreviada', 'Preço'];

        // Cria um nome único para o arquivo CSV
        $nomeArquivo = 'produtos_' . date('Y-m-d_H-i-s') . '.csv';

        // Cria o conteúdo do CSV
        $csvContent = implode(",", $csvHeader) . "\n";

        foreach ($data as $coluna) {
            $csvContent .= $coluna->id . ',' . $coluna->nome . ',' . $coluna->emb_abreviada . ',' . $coluna->preco . "\n";
        }

        // Retorna o arquivo CSV para download
        return Response::make($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$nomeArquivo\"",
        ]);
    }

    public static function consultaExtensa($params)
    {
        $teste = DB::connection('firebird')->select('SELECT id, nome, emb_abreviada, preco FROM site_produtos');
        return $teste;
    }
}
