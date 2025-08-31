<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProveedorRequest extends FormRequest
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
            'nombre' => 'required|string|max:50',
            'telefono' => 'required|string|unique:proveedores,telefono|min:9|max:9',
            'email' => 'required|email|unique:proveedores,email',
            'direccion' => 'required|string',
            'notas' => 'max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required'    => 'El nombre del proveedor es obligatorio.',
            'nombre.max'         => 'El nombre no puede superar los 50 caracteres.',

            'telefono.required'  => 'Debe indicar un teléfono.',
            'telefono.unique'    => 'Este teléfono ya está registrado.',
            'telefono.min'       => 'El teléfono debe tener 9 dígitos.',
            'telefono.max'       => 'El teléfono debe tener 9 dígitos.',

            'email.required'     => 'Debe indicar un email.',
            'email.email'        => 'Debe ser un email válido.',
            'email.unique'       => 'Este email ya está registrado.',

            'direccion.required' => 'Debe indicar una dirección.',

            'notas.max'          => 'Las notas no pueden superar los 500 caracteres.',
        ];
    }

}
