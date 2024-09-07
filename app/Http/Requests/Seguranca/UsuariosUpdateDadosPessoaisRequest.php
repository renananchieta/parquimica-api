<?php

namespace App\Http\Requests\Seguranca;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UsuariosUpdateDadosPessoaisRequest extends FormRequest
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
            'email' => 'required|string|email',
            'cpf' => 'required|string|min:11',
            'senha' => 'required:id,null|confirmed|min:8',
            'senha_confirmation' => '',
            'dtNascimento' => 'required|string',
            'contato' => 'nullable|string',
            'contatoWpp' => 'required|string',
        ];
    }

    public function valid(): array
    {
        return [
            'usuario' => [
                'nome' => $this->request->get('nome'),
                'email' => $this->request->get('email'),
                'senha' => Hash::make($this->request->get('senha')),
                'cpf' => preg_replace('/\D/', '', $this->request->get('cpf')),
                'dt_nascimento' => $this->request->get('dtNascimento'),
                'contato' => preg_replace('/\D/', '', $this->request->get('contato')),
                'contato_wpp' => preg_replace('/\D/', '', $this->request->get('contatoWpp')),
            ],
        ];
    }
}
