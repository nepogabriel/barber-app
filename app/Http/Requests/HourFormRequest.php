<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HourFormRequest extends FormRequest
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
            'date' => ['required'],
            'time' => ['required'],
            'professional_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'date.required' => 'O campo de data é obrigatório',
            'time.required' => 'O campo de horário é obrigatório',
            'professional_id.required' => 'O campo de profissonal é obrigatório',
        ];
    }
}
