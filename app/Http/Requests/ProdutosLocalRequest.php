<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutosLocalRequest extends FormRequest
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
            //Produto
            'nomeProduto' => 'required|string',
            'codigoProduto' => 'required|integer',
            'subtituloProduto' => 'required|string',
            'modoAcao' => 'required|string',
            'variantes' => 'nullable|string',
            'slug' => 'nullable|string',
            'linha' => 'nullable|string',
            'funcao' => 'nullable|string',
            'arquivo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function valid(): array
    {
        return [
            'nome_produto' => $this->request->get('nomeProduto'),
            'codigo_produto' => $this->request->get('codigoProduto'),
            'subtitulo' => $this->request->get('subtituloProduto'),
            'modo_acao' => $this->request->get('modoAcao'),
            'variantes' => $this->request->get('variantes'),
            'slug' => $this->request->get('slug'),
            'linha' => $this->request->get('linha'),
            'funcao' => $this->request->get('funcao'),
            'arquivo' => $this->file('arquivo'),
        ];
    }
}
