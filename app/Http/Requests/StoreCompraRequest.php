<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompraRequest extends FormRequest
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
            'producto_id' => 'required|exists:productos,id',
            'proveedor_id' => 'required|exists:proveedores,id',
            'cantidad' => 'required|integer|min:1',
            'precio_compra' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'producto_id.required'   => 'Debe seleccionar un producto.',
            'producto_id.exists'     => 'El producto seleccionado no es válido.',

            'proveedor_id.required'  => 'Debe seleccionar un proveedor.',
            'proveedor_id.exists'    => 'El proveedor seleccionado no es válido.',

            'cantidad.required'      => 'Debe indicar la cantidad del producto.',
            'cantidad.integer'       => 'La cantidad debe ser un número entero.',
            'cantidad.min'           => 'La cantidad debe ser al menos 1.',

            'precio_compra.required' => 'Debe indicar el precio de compra.',
            'precio_compra.numeric'  => 'El precio de compra debe ser un número.',
            'precio_compra.min'      => 'El precio de compra no puede ser negativo.',
        ];
    }
}
