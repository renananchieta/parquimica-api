<?php

namespace App\Models\Regras;

use App\Models\Entity\ConfiguracaoPages;

class SitePostagemRegras
{
    public static function salvarPostagemSite(array $data)
    {
        $data = (Object)$data;

        $postagemSite = new ConfiguracaoPages();
        $postagemSite->titulo = $data->titulo;
        $postagemSite->tipo = 'site';
        $postagemSite->texto = $data->texto;
        $postagemSite->categoria = $data->categoria;
        $postagemSite->data_publicacao = $data->data_publicacao;
        $postagemSite->status_publicacao = $data->status_publicacao;
        $postagemSite->slug = $data->titulo;
        $postagemSite->save();

        return $postagemSite;
    }
}
