<?php

namespace App\Http\Requests\Seguranca;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UsuariosUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //Dados do usuário
            'nome' => 'required|string',
            'nomeSocial' => 'nullable|string',
            'email' => 'required|string|email',
            'senha' => 'sometimes|string|min:8',
            'cpf' => 'required|string|min:11',
            'dtNascimento' => 'required|string',
            'contato' => 'nullable|string',
            'contatoWpp' => 'required|string',
            'estado' => 'nullable|string',
            'municipio' => 'nullable|string',
            'bairro' => 'nullable|string',
            'logradouro' => 'nullable|string',
            'numero' => 'nullable|string',
            
            //Dados de perfil do usuário
            'perfil' => 'required|array',
            'perfil.*.id' => 'required|integer'
        ];
    }

    public function valid(): array
    {
        return [
            'usuario' => [
                'nome' => $this->request->get('nome'),
                'nome_social' => $this->request->get('nomeSocial'),
                'email' => $this->request->get('email'),
                'senha' => Hash::make($this->request->get('senha')),
                'cpf' => $this->request->get('cpf'),
                'dt_nascimento' => $this->request->get('dtNascimento'),
                'contato' => $this->request->get('contato'),
                'contato_wpp' => $this->request->get('contatoWpp'),
                'estado' => $this->request->get('estado'),
                'municipio' => $this->request->get('municipio'),
                'bairro' => $this->request->get('bairro'),
                'logradouro' => $this->request->get('logradouro'),
                'numero' => $this->request->get('numero'),
            ],

            'perfil' => request()->perfil,
        ];
    }
}
