<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SitePostagemRequest extends FormRequest
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
            'id' => 'nullable|integer',
            'titulo' => 'required|string',
            'texto' => 'required|string',
            'categoria' => 'required|string',
            'data_publicacao' => 'required|date',
            'status_publicacao' => 'boolean',
        ];
    }

    public function valid(): array
    {
        return [
            'id' => $this->request->get('id'),
            'titulo' => $this->request->get('titulo'),
            'texto' => $this->request->get('texto'),
            'categoria' => $this->request->get('categoria'),
            'data_publicacao' => $this->request->get('data_publicacao'),
            'status_publicacao' => $this->request->get('status_publicacao'),
        ];
    }
}
