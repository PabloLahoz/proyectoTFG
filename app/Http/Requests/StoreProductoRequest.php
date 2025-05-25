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
            'proveedor_id'   => 'required|exists:proveedores,id',
            'nombre'         => 'required|string|max:255',
            'material'       => 'required|string|max:255',
            'dimensiones'    => 'required|string|max:255',
            'estado'         => 'required|in:nuevo,seminuevo',
            'cantidad'       => 'required|integer|min:0',
            'precio_ultima_compra'  => 'required|numeric|min:0',
            'precio_venta'   => 'required|numeric|min:0',
            'activo'         => 'boolean',
        ];
    }
}
