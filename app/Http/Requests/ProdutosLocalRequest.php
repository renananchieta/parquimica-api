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
            
            //Variantes 
            'variantes' => 'nullable|array',
            'variantes.*.id' => 'nullable|integer',

            //arquivo
            // 'arquivo' => 'nullable|file|mimes:pdf|max:5120',
        ];
    }

    public function valid(): array
    {
        return [
            'produto' => [
                'nome_produto' => $this->request->get('nomeProduto'),
                'codigo_produto' => $this->request->get('codigoProduto'),
                'subtitulo' => $this->request->get('subtituloProduto'),
                'modo_acao' => $this->request->get('modoAcao'),
            ],
            
            'variantes' => request()->variantes,
            
            // 'arquivo' => $this->file('arquivo'),
        ];
    }
}
