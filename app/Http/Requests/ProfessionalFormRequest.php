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
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:7', 'max:300'],
            'password_confirmation' => ['required', 'min:7', 'max:300'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.min' => 'O campo de nome deve ter pelo menos :min caracteres.',
            'telephone.required' => 'O campo de telefone é obrigatório.',
            'telephone.min' => 'O campo de telefone deve ter pelo menos :min caracteres.',
            'telephone.max' => 'O campo de telefone não deve ter mais de :max caracteres.',
            'email.required' => 'O campo de e-mail é obrigatório.',
            'email.email' => 'Verifique o campo de e-mail, por favor.',
            'password.required' => 'O campo de senha é obrigatório.',
            'password.confirmed' => 'A confirmação do campo de senha não corresponde.',
            'password.min' => 'O campo de senha deve ter pelo menos :min caracteres.',
            'password.max' => 'O campo de senha não deve ter mais de :max caracteres.',
            'password_confirmation.required' => 'O campo de confirmar a senha é obrigatório.',
            'password_confirmation.min' => 'O campo de confirmar a senha deve ter pelo menos :min caracteres.',
            'password_confirmation.max' => 'O campo de confirmar a senha não deve ter mais de :max caracteres.',
        ];
    }
}
