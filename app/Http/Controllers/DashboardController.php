<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $totalPedidos = Pedido::sum('total_pedido');
        $cantidadPedidos = Pedido::count();
        $productosBajosStock = Producto::where('cantidad', '<', 5)->get();
        $pedidosRecientes = Pedido::orderBy('created_at', 'desc')->take(5)->get();
        return view('admin.dashboard', compact('totalPedidos', 'cantidadPedidos', 'productosBajosStock', 'pedidosRecientes'));
    }
}
