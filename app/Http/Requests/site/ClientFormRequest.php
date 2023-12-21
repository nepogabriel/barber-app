<?php

namespace App\Http\Requests\site;

use Illuminate\Foundation\Http\FormRequest;

class ClientFormRequest extends FormRequest
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
            'name_client' => ['required', 'min:3'],
            'telephone_client' => ['required', 'min:11', 'max:15'],
        ];
    }

    public function messages()
    {
        return [
            'name_client.required' => "Preencha o campo 'nome' continuar.",
            'name_client.min' => "O campo 'nome' deve ter pelo menos :min caracteres.",
            'telephone_client.required' => "Preencha o campo 'telefone' para continuar.",
            'telephone_client.min' => "O campo 'telefone' deve ter pelo menos :min caracteres.",
            'telephtelephone_clientone.max' => "O campo 'telefone' não deve ter mais de :max caracteres.",

        ];
    }
}
