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

        $csvHeader = ['ID', 'Nome', 'Embalagem Abreviada', 'Preço'];

        $nomeArquivo = 'produtos_' . date('Y-m-d_H-i-s') . '.csv';

        $csvContent = implode(",", $csvHeader) . "\n";

        foreach ($data as $coluna) {
            $csvContent .= $coluna->id . ',' . $coluna->nome . ',' . $coluna->emb_abreviada . ',' . $coluna->preco . "\n";
        }

        return [
            'content' => $csvContent,
            'filename' => $nomeArquivo,
        ];
    }

    public static function consultaExtensa($params)
    {
        $teste = DB::connection('firebird')->select('SELECT id, nome, emb_abreviada, preco FROM site_produtos');
        return $teste;
    }
}
