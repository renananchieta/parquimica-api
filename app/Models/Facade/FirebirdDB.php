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

        // Abre um ponteiro de memória para escrever o CSV
        $file = fopen('php://temp', 'w');

        // Escreve o cabeçalho no CSV
        fputcsv($file, $csvHeader);

        // Escreve os dados no CSV
        foreach ($data as $row) {
            fputcsv($file, (array) $row);
        }

        // Reseta o ponteiro do arquivo para o início
        rewind($file);

        // Captura o conteúdo do CSV como string
        $csvContent = stream_get_contents($file);

        // Fecha o ponteiro do arquivo
        fclose($file);

        // Cria um nome único para o arquivo CSV
        $fileName = 'produtos_' . date('Y-m-d_H-i-s') . '.csv';

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
