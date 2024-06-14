<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
			'name' => 'required|string',
			'apellido_1' => 'string',
			'apellido_2' => 'string',
			'email' => 'required|string',
			'dni' => 'required|string',
            'id_tarifa' => 'nullable|exists:tarifas,id',
            'id_rol' => 'nullable|exists:roles,id',
            'cupos_clases' => 'nullable|integer|min:0',
        ];
    }
}