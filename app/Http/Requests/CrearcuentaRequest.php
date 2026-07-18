<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CrearcuentaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe tener un formato válido.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
            'password.uncompromised' => 'La contraseña ha sido comprometida en una filtración de datos. Por favor, elige una contraseña diferente.',
            'password.mixedCase' => 'La contraseña debe contener al menos una letra mayúscula y una letra minúscula.',
            'password.letters' => 'La contraseña debe contener al menos una letra.',
            'password.symbols' => 'La contraseña debe contener al menos un símbolo.',
            'password.numbers' => 'La contraseña debe contener al menos un número.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed',
            Password::min(4)
            ->mixedCase()
            ->letters()
            ->symbols()
            ->numbers()
            ->uncompromised()
            ],
        ];
    }
}
