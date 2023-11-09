<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfessionalFormRequest extends FormRequest
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
            'name' => ['required', 'min:3'],
            'telephone' => ['required', 'min:11', 'max:15'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.min' => 'O campo de nome deve ter pelo menos :min caracteres.',
            'telephone.required' => 'O campo de telefone é obrigatório.',
            'telephone.min' => 'O campo de nome deve ter pelo menos :min caracteres.',
            'telephone.max' => 'O campo de telefone não deve ter mais de :max caracteres.',
        ];
    }
}
