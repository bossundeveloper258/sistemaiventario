<?php

namespace App\Http\Requests\Business;

use Illuminate\Foundation\Http\FormRequest;

class BusinessCreateRequest extends FormRequest
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
            'ruc' => 'required|string|max:11|unique:businesses,ruc',
            'name' => 'required',
            'address' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'ruc.required' => 'El nombre es obligatorio.',
            'ruc.max' => 'El ruc debe tener maximo 11 digitos.',
            'ruc.unique' => 'Este Ruc ya esta regidtrado.',
            'name.required' => 'El email es obligatorio.',
            'address.required' => 'La dirección es obligatorio.'
        ];
    }
}
