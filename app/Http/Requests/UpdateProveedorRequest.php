<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProveedorRequest extends FormRequest
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
            'nombre' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('proveedores')->ignore($this->proveedor->id),
            ],
            'telefono' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('proveedores')->ignore($this->proveedor->id),
            ],
            'direccion' => 'required|string',
            'notas' => 'max:500',
        ];

    }

    public function messages(): array
    {
        return [
            'nombre.required'    => 'El nombre del proveedor es obligatorio.',
            'nombre.max'         => 'El nombre no puede superar los 255 caracteres.',

            'telefono.max'       => 'El teléfono no puede superar los 20 caracteres.',
            'telefono.unique'    => 'Este teléfono ya está registrado.',

            'email.required'     => 'Debe indicar un email.',
            'email.email'        => 'Debe ser un email válido.',
            'email.unique'       => 'Este email ya está registrado.',

            'direccion.required' => 'Debe indicar una dirección.',

            'notas.max'          => 'Las notas no pueden superar los 500 caracteres.',
        ];
    }

}
