<?php

namespace App\Http\Requests\Area;

use Illuminate\Foundation\Http\FormRequest;

class AreaCreateRequest extends FormRequest
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
            'name'          => 'required',
            'sede_id'     => 'required|integer|exists:sedes,id',
            'business_id'   => 'required|integer|exists:businesses,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El email es obligatorio.',
            'sede_id.required' => 'El Tipo de Sede es obligatorio.',
            'business_id.required' => 'La empresa es obligatorio.',
            'sede_id.exists' => 'No existe el Tipo de Sede.',
            'business_id.exists' => 'No existe la empresa.'
        ];
    }
}
