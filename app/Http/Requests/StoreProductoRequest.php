<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
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
            'nombre'      => 'required|string|max:255',
            'material'    => 'required|string|max:255',
            'dimensiones' => 'required|string|max:255',
            'condicion'      => 'required|in:nuevo,seminuevo',
            'imagen'      => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required'      => 'El nombre del producto es obligatorio.',
            'nombre.max'           => 'El nombre no puede superar los 255 caracteres.',

            'material.required'    => 'El material es obligatorio.',
            'material.max'         => 'El material no puede superar los 255 caracteres.',

            'dimensiones.required' => 'Debe indicar las dimensiones.',
            'dimensiones.max'      => 'Las dimensiones no pueden superar los 255 caracteres.',

            'condicion.required'      => 'Debe seleccionar el estado del producto.',
            'condicion.in'            => 'El estado seleccionado no es válido.',

            'imagen.required'      => 'Debe subir una imagen del producto.',
            'imagen.image'         => 'El archivo debe ser una imagen.',
            'imagen.mimes'         => 'La imagen debe ser jpeg, png, jpg, gif o svg.',
            'imagen.max'           => 'La imagen no puede superar los 2 MB.',
        ];
    }
}
