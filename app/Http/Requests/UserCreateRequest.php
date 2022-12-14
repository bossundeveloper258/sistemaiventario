<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'gpid' => 'required|integer|min:8|digits_between: 8,9|unique:users,gpid',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'gpid.required' => 'El gpid es obligatorio.',
            'gpid.integer' => 'El gpid debe ser numerico.',
            'gpid.unique' => 'El gpid ya existe.',
            'email.email' => 'Este campo debe ser un correo.',
            'password.required' => 'La contraseña es obligatorio.',
            'password.confirmed' => 'Las dos contraseñas deben ser iguales.'
        ];
    }
}
