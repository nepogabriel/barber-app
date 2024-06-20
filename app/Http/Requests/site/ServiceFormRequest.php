<?php

namespace App\Http\Requests\site;

use Illuminate\Foundation\Http\FormRequest;

class ServiceFormRequest extends FormRequest
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
            'service_id' => ['required', 'max:3'],
        ];
    }

    public function messages()
    {
        return [
            'service_id.required' => 'Escolha um serviço para continuar.',
            'service_id.max' => 'Escolha até 3 serviços para continuar.',
        ];
    }
}
