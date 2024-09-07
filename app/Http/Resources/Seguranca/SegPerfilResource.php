<?php

namespace App\Http\Resources\Seguranca;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SegPerfilResource extends JsonResource
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
            "perfil" => $this->perfil
        ];
    }
}
