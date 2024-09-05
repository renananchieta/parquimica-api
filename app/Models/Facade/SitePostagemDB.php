<?php

namespace App\Models\Facade;

use App\Models\Entity\ConfiguracaoPages;

class SitePostagemDB 
{
    public static function getPostagensSite($params)
    {
        $query = ConfiguracaoPages::query();
        
        if(isset($params->categoria)) {
            $query->where('categoria', 'like', '%' . $params->categoria . '%');
        }
        if(isset($params->titulo)) {
            $query->where('titulo', 'like', '%' . $params->titulo . '%');
        }
        if(isset($params->data_publicacao)) {
            $query->where('data_publicacao', $params->data_publicacao);
        }
        if(isset($params->status_publicacao)) {
            $query->where('status_publicacao', $params->status_publicacao);
        }

        return $query->where('tipo', 'site')->whereNull('deleted_at')->get();
    }

    public static function getPostagensBlog($params)
    {
        $query = ConfiguracaoPages::query();
        
        if(isset($params->categoria)) {
            $query->where('categoria', 'like', '%' . $params->categoria . '%');
        }
        if(isset($params->titulo)) {
            $query->where('titulo', 'like', '%' . $params->titulo . '%');
        }
        if(isset($params->data_publicacao)) {
            $query->where('data_publicacao', $params->data_publicacao);
        }
        if(isset($params->status_publicacao)) {
            $query->where('status_publicacao', $params->status_publicacao);
        }

        return $query->where('tipo', 'blog')->whereNull('deleted_at')->get();
    }
}
