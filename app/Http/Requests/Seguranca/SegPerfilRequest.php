<?php

namespace App\Http\Requests\Seguranca;

use Illuminate\Foundation\Http\FormRequest;

class SegPerfilRequest extends FormRequest
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
            'perfil' => 'required|string'
        ];
    }

    public function valid(): array
    {
        return [
            'perfil' => $this->request->get('perfil')
        ];
    }
}
