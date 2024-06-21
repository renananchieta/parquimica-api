<?php

namespace App\Http\Resources\Catalogo;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CatalogoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "nome" => $this->nome,
            "emb_abreviada" => $this->emb_abreviada,
            "preco" => number_format($this->preco, 2, ',', '.')
        ]; 
    }
}
