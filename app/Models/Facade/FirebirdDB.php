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

        $result = DB::connection('firebird')->select($query, $bindings);

        return $result;
    }

    public static function grid2($params)
    {
        $query = Firebird::query();

        if(isset($params->nome)) $query->where('NOME', 'ilike', $params->nome);

        $query->limit(200)->get();

        return $query;
    }

    public static function consultaExtensa($params)
    {
        $teste = DB::connection('firebird')->select('SELECT id, nome, emb_abreviada, preco FROM site_produtos');
        return $teste;
    }
}
