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

        $file = fopen('php://temp', 'w+');

        fputcsv($file, ['ID', 'Nome', 'Embalagem Abreviada', 'Preço']);

        foreach ($data as $row) {
            fputcsv($file, [
                $row->ID,
                $row->NOME,
                $row->EMB_ABREVIADA,
                $row->PRECO
            ]);
        }

        rewind($file);

        $csvContent = stream_get_contents($file);

        fclose($file);

        $fileName = 'produtos.csv';

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
