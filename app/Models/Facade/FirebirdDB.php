<?php

namespace App\Models\Facade;

use App\Models\Firebird;
use Illuminate\Support\Facades\DB;

class FirebirdDB 
{
    public static function gridbkp($params)
    {
        if (isset($params->nome)) {
            $query = `SELECT id, nome, emb_abreviada, preco
                        FROM site_produtos
                        WHERE LOWER(nome) LIKE '%$params->nome%'`;
        } else{
            $query = 'SELECT id, nome, emb_abreviada, preco FROM site_produtos';
        }
    
        $result = DB::connection('firebird')->select($query);

        return $result;
    }

    public static function grid($params)
    {
        $query = 'SELECT id, nome, emb_abreviada, preco FROM site_produtos';

        if (isset($params->nome)) {
            $query .= " WHERE nome LIKE '%$params->nome%'";
        }
    
        $result = DB::connection('firebird')->select($query);

        return $result;
    }

    public static function consultaExtensa($params)
    {
        $teste = DB::connection('firebird')->select('SELECT id, nome, emb_abreviada, preco FROM site_produtos');
        return $teste;
    }
}
