<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
user Cart
class CartController extends Controller
{
    public function add(Request $request) {
        $producto = Producto::find($request->id);
        if (empty($producto)) {
            return redirect('/');
        }
        Cart::add($producto);
    }
}
