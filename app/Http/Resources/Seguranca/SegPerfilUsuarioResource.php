<?php

namespace App\Http\Resources\Seguranca;

use App\Models\Seguranca\SegPerfil;
use App\Models\Seguranca\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SegPerfilUsuarioResource extends JsonResource
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
            'perfilId' => $this->perfil_id,
            'usuarioId' => $this->usuario_id
        ];
    }
}
