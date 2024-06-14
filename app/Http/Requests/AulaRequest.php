<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AulaRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'aulaNombre' => 'required|string',
            'aulaCapacidad' => 'required|integer|min:1',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'aulaNombre.required' => 'El nombre del aula es requerido.',
            'aulaNombre.string' => 'El nombre del aula debe ser una cadena de caracteres.',
            'aulaCapacidad.required' => 'La capacidad del aula es requerida.',
            'aulaCapacidad.integer' => 'La capacidad del aula debe ser un número entero.',
            'aulaCapacidad.min' => 'La capacidad del aula debe ser como mínimo :min.',
        ];
    }
}