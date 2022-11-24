<?php

namespace App\Http\Requests\Sede;

use Illuminate\Foundation\Http\FormRequest;

class SedeUpdateRequest extends FormRequest
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
            'id'          => 'required',
            'name'          => 'required',
            'address'       => 'required',
            'sede_type'     => 'required|integer|exists:parameters,id',
            'business_id'   => 'required|integer|exists:businesses,id',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'El id es obligatorio.',
            'name.required' => 'El email es obligatorio.',
            'address.required' => 'La dirección es obligatorio.',
            'sede_type.required' => 'El Tipo de Sede es obligatorio.',
            'business_id.required' => 'La empresa es obligatorio.',
            'sede_type.exists' => 'No existe el Tipo de Sede.',
            'business_id.exists' => 'No existe la empresa.'
        ];
    }
}
