<?php

namespace App\Http\Requests\CostCenter;

use Illuminate\Foundation\Http\FormRequest;

class CostCenterUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'code'          => 'required',
            'name'          => 'required',
            'area_id'     => 'required|integer|exists:areas,id',
            'sede_id'     => 'required|integer|exists:sedes,id',
            'business_id'   => 'required|integer|exists:businesses,id',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'El id es obligatorio.',
            'code.required' => 'El codigo es obligatorio.',
            'name.required' => 'El nombre es obligatorio.',
            'area_id.required' => 'El Area es obligatorio.',
            'sede_id.required' => 'El Sede es obligatorio.',
            'business_id.required' => 'La empresa es obligatorio.',
            'area_id.exists' => 'No existe el Area.',
            'sede_id.exists' => 'No existe la Sede.',
            'business_id.exists' => 'No existe la empresa.'
        ];
    }
}
