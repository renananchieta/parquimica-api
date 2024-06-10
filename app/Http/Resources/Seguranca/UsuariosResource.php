<?php

namespace App\Http\Resources\Seguranca;

use App\Models\Seguranca\SegPerfilUsuario;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsuariosResource extends JsonResource
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
            "nomeSocial" => $this->nome_social,
            "email" => $this->email,
            "dtNascimento" => date('d/m/Y', strtotime($this->dt_nascimento)),
            "contatoWpp" => $this->contato_wpp,
            "contato" => $this->contato,
            "estado" => $this->estado,
            "municipio" => $this->municipio,
            "bairro" => $this->bairro,
            "logradouro" => $this->logradouro,
            "numero" => $this->numero,
            "perfisUsuario" => SegPerfilResource::collection($this->perfis),
            "perfil" => $this->perfis->pluck('id')
        ];
    }
}
