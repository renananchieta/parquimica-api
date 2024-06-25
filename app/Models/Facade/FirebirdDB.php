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
        $dados = CatalogoResource::collection($data);

        $file = fopen('php://temp', 'w+');

        fputcsv($file, ['ID', 'Nome', 'Embalagem Abreviada', 'Preço']);

        foreach ($dados as $row) {
            fputcsv($file, [
                $row->id,
                $row->nome,
                $row->emb_abreviada,
                $row->preco
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
