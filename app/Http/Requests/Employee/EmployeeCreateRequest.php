<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeCreateRequest extends FormRequest
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
            'gpid'          => 'required',
            'name'          => 'required',
            'email'          => 'required',
            'job'          => 'required',
            'cost_center_id'   => 'required|integer|exists:cost_centers,id',
        ];
    }

    public function messages()
    {
        return [
            'gpid.required' => 'El gpid es obligatorio.',
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'Este campo debe ser un correo.',
            'job.required' => 'El cargo es obligatorio.',
            'cost_center_id.exists' => 'No existe el Centro de costo.',
            'cost_center_id.required' => 'El Centro de costo es obligatorio.'
        ];
    }
}
