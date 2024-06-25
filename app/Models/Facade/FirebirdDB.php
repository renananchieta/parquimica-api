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

        // Define o nome do arquivo CSV
        $filename = 'produtos.csv';

        // Cria um recurso de memória para o arquivo CSV
        $handle = fopen('php://memory', 'r+');

        // Escreve o cabeçalho no arquivo CSV
        fputcsv($handle, ['ID', 'Nome', 'Embalagem Abreviada', 'Preço']);

        // Escreve os dados no arquivo CSV
        foreach ($data as $row) {
            fputcsv($handle, (array) $row);
        }

        // Retorna ao início do recurso de memória
        rewind($handle);

        // Captura o conteúdo do recurso de memória
        $contents = stream_get_contents($handle);

        // Fecha o recurso de memória
        fclose($handle);

        return [
            'filename' => $filename,
            'content' => $contents
        ];
    }

    public static function consultaExtensa($params)
    {
        $teste = DB::connection('firebird')->select('SELECT id, nome, emb_abreviada, preco FROM site_produtos');
        return $teste;
    }
}
