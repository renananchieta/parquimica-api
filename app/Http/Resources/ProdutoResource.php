<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdutoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'codigo_produto' => $this->codigo_produto,
            'nome_produto' => $this->nome_produto,
            'subtitulo' => $this->subtitulo,
            'modo_acao' => $this->modo_acao,
            'recomendacao' => $this->recomendacao,
            'slug' => $this->slug,
            'ativo_site' => $this->ativo_site,
            'variantes' => $this->variantes,
            'caminho_arquivo' => $this->caminho_arquivo,
            // 'linha' => $this->linha,
            // 'funcao' => $this->recomendacao,
        ];
    }
}
