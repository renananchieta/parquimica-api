<?php

namespace App\Models\Seguranca;

class SegPerfilDB
{
    public static function gridPerfis($data)
    {
        $query = SegPerfil::query();

        if(isset($data->perfil)) $query->where('perfil', 'like', '%' . $data->perfil . '%');

        $dados = $query->limit(200)->get();

        return $dados;
    }   
}
