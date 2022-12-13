<?php

namespace App\Http\Requests\CostCenter;

use Illuminate\Foundation\Http\FormRequest;

class CostCenterCreateRequest extends FormRequest
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
            'code'          => 'required',
            'name'          => 'required',
            'area_id'     => 'required|integer|exists:areas,id',
            'business_id'   => 'required|integer|exists:businesses,id',
            'area_id'     => 'required|integer|exists:areas,id',
            'business_id'   => 'required|integer|exists:businesses,id',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'El codigo es obligatorio.',
            'name.required' => 'El nombre es obligatorio.',
            'area_id.required' => 'El Area es obligatorio.',
            'business_id.required' => 'La empresa es obligatorio.',
            'area_id.exists' => 'No existe el Area.',
            'business_id.exists' => 'No existe la empresa.'
        ];
    }
}
