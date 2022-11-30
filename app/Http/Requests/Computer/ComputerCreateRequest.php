<?php

namespace App\Http\Requests\Computer;

use Illuminate\Foundation\Http\FormRequest;

class ComputerCreateRequest extends FormRequest
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
            'type_id'           => 'required|exists:parameters,id',
            'brand_id'          => 'required|exists:parameters,id',
            'model_id'          => 'required|exists:parameters,id',
            'so_id'             => 'required|exists:parameters,id',
            'name'              => 'required',
            'status_id'         => 'required|exists:parameters,id',
            'supplier_id'       => 'required|exists:parameters,id',
            'ceco_id'           => 'required|exists:cost_centers,id',
            'employee_id'       => 'required|exists:employees,id'
        ];
    }

    public function messages()
    {
        return [
            'type_id.required' => 'El Tipo es obligatorio.',
            'brand_id.required' => 'El Marca es obligatorio.',
            'model_id.required' => 'El Modelo es obligatorio.',
            'so_id.required' => 'El Sist. Oper es obligatorio.',
            'name.required' => 'El Nombre es obligatorio.',
            'status_id.exists' => 'El Estado es obligatorio.',
            'ceco_id.exists' => 'El CECO es obligatorio.',
            'employee_id.exists' => 'El Usuario es obligatorio.'
        ];
    }
}
