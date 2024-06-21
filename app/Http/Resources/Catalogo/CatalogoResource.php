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
            "id" => $this->ID,
            "nome" => $this->NOME,
            "emb_abreviada" => $this->EMB_ABREVIADA,
            "preco" => number_format($this->PRECO, 2, ',', '.')
        ]; 
    }
}
