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

        $fileName = 'produtos_' . date('Y-m-d_H-i-s') . '.csv';

        $csvContent = implode(",", $csvHeader) . "\n";

        foreach ($data as $row) {
            $csvContent .= $row->id . ',' . $row->nome . ',' . $row->emb_abreviada . ',' . $row->preco . "\n";
        }

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
