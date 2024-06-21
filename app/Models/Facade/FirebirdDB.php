<?php

namespace App\Models\Facade;

use App\Models\Firebird;
use Illuminate\Support\Facades\DB;

class FirebirdDB 
{
    public static function grid($params)
    {
        $query = DB::connection('firebird')->table('site_produtos');

        if(isset($params->nome)) $query->where('NOME', 'ilike', $params->nome);

        $query->select('ID', 'NOME', 'EMB_ABREVIADA', 'PRECO')->get();

        return $query;
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