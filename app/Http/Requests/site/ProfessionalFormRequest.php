<?php

namespace App\Http\Requests\site;

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
            'professional_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'professional_id.required' => 'Escolha um profissional para continuar.',
        ];
    }
}
