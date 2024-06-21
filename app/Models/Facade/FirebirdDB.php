<?php

namespace App\Models\Facade;

use App\Models\Firebird;
use Illuminate\Support\Facades\DB;

class FirebirdDB 
{
    public static function grid($params)
    {
        $query = 'SELECT id, nome, emb_abreviada, preco FROM site_produtos';
        $bindings = [];

        if (isset($params->nome)) {
            $query .= ' WHERE LOWER(nome) LIKE ?';
            $bindings[] = '%' . strtolower($params->nome) . '%';
        }
    
        // Debug: Mostra a consulta e os bindings para verificar a montagem correta
        error_log('Query: ' . $query);
        error_log('Bindings: ' . json_encode($bindings));
    
        // Executa a consulta
        $result = DB::connection('firebird')->select($query, $bindings);

        return $result;
    }

    public static function consultaExtensa($params)
    {
        $teste = DB::connection('firebird')->select('SELECT id, nome, emb_abreviada, preco FROM site_produtos');
        return $teste;
    }
}
