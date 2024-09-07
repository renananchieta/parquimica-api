<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SitePostagemResource extends JsonResource
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
            'titulo' => $this->titulo,
            'texto' => $this->texto,
            'categoria' => mb_strtoupper($this->categoria),
            'data_publicacao' => date('d/m/Y H:i', strtotime($this->data_publicacao)),
            'status_publicacao' => $this->status_publicacao == 0 ? "A PUBLICAR" : "PUBLICADO",
        ];
    }
}
