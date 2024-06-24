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

        $nomeArquivo = 'export_' . date('Y-m-d');
        $file = fopen(storage_path('app/public/' . $nomeArquivo), 'w');

        fputcsv($file, [
            'ID', 
            'Nome', 
            'Embalagem Abreviada', 
            'Preço'
        ]);

        foreach ($data as $row) {
            fputcsv($file, [
                $row->id,
                $row->nome,
                $row->emb_abreviada,
                $row->preco
            ]);
        }

        // rewind($file);

        $csvContent = stream_get_contents($file);

        fclose($file);

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
