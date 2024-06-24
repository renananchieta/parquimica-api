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
        $fileName = 'produtos_' . date('Y-m-d_H-i-s') . '.csv';

        // Cria o conteúdo do CSV
        $csvContent = implode(",", $csvHeader) . "\n";

        foreach ($data as $row) {
            $csvContent .= $row->ID . ',' . $row->NOME . ',' . $row->EMB_ABREVIADA . ',' . $row->PERCO . "\n";
        }

        // Retorna o conteúdo do CSV e o nome do arquivo
        return [
            'content' => $csvContent,
            'filename' => $fileName,
        ];
    }

    public static function consultaExtensa($params)
    {
        $teste = DB::connection('firebird')->select('SELECT id, nome, emb_abreviada, preco FROM site_produtos');
        return $teste;
    }
}
