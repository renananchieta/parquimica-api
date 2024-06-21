<?php

namespace App\Models\Facade;

use App\Models\Firebird;
use Illuminate\Support\Facades\DB;

class FirebirdDB 
{
    public static function grid($params)
    {
        if (isset($params->nome)) {
            `SELECT id, nome, emb_abreviada, preco
            FROM site_produtos
            WHERE LOWER(nome) LIKE '%$params->nome%'`;
        } else{
            $query = 'SELECT id, nome, emb_abreviada, preco FROM site_produtos';
        }
    
        $result = DB::connection('firebird')->select($query);

        return $result;
    }

    public static function gridBKP($params)
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
