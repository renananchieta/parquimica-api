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

        $fileName = 'produtos_' . date('Y-m-d_H-i-s') . '.csv';
        // Cria um ponteiro de memória para escrever o CSV
        $file = fopen(storage_path('app/public/' . $fileName), 'w');

        // Escreve os cabeçalhos no CSV
        fputcsv($file, ['ID', 'Nome', 'Embalagem Abreviada', 'Preço']);

        // Escreve os dados no CSV
        foreach ($data as $row) {
            fputcsv($file, [
                $row->id,
                $row->nome,
                $row->emb_abreviada,
                $row->preco
            ]);
        }

        // Reseta o ponteiro do arquivo para o início
        // rewind($file);

        // Captura o conteúdo do CSV como string
        $csvContent = stream_get_contents($file);

        // Fecha o ponteiro do arquivo
        fclose($file);

        // Cria um nome único para o arquivo CSV
        

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
