<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $productos = Producto::where('activo', true)->latest()->take(3)->get();
        return view('home', compact('productos'));
    }
}
