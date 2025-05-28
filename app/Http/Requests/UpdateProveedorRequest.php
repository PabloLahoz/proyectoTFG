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

}
