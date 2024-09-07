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
            'id' => 'nullable|string',
            'nomeProduto' => 'required|string',
            'codigoProduto' => 'required|integer',
            'subtituloProduto' => 'required|string',
            'modoAcao' => 'required|string',
            // 'variantes' => 'nullable|string',
            'slug' => 'nullable|string',
            'recomendacao' => 'nullable|string',
            'ativo_site' => 'nullable|integer',

            'linha' => 'required|array',
            'linha.*.codigo_linha' => 'required|integer',

            'funcao' => 'required|array',
            'funcao.*.codigo_funcao' => 'required|integer',

            'variantes' => 'required|array',
            'variantes.*.codigo_produto' => 'required|integer',

            // 'linha' => 'nullable|string',
            // 'funcao' => 'nullable|string',
            'arquivo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function valid(): array
    {
        return [
            'produto' => [
                'id' => $this->request->get('id'),
                'nome_produto' => $this->request->get('nomeProduto'),
                'codigo_produto' => $this->request->get('codigoProduto'),
                'subtitulo' => $this->request->get('subtituloProduto'),
                'modo_acao' => $this->request->get('modoAcao'),
                // 'variantes' => $this->request->get('variantes'),
                'slug' => $this->request->get('slug'),
                'recomendacao' => $this->request->get('recomendacao'),
                'ativo_site' => $this->request->get('ativo_site'),
            ],

            'linha' => request()->linha,
            'funcao' => request()->funcao,
            'variantes' => request()->variantes,
            'arquivo' => $this->file('arquivo'),
        ];
    }
}
