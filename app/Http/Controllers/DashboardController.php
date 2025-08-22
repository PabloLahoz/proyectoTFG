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

    public function diagramas()
    {
        // Ventas agrupadas por mes (solo los que tienen ventas)
        $ventas = Pedido::selectRaw('MONTH(fecha_pedido) as mes, SUM(total_pedido) as total')
            ->groupBy('mes')
            ->pluck('total', 'mes');

        // Array de nombres de meses en español
        $mesesNombres = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo',
            4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
            7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre',
            10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre',
        ];

        // Construir arrays completos (12 meses)
        $labels = [];
        $data = [];
        foreach ($mesesNombres as $num => $nombre) {
            $labels[] = $nombre;
            $data[] = $ventas[$num] ?? 0; // si no hay ventas, poner 0
        }

        // Pedidos por estado
        $pedidosPorEstado = Pedido::selectRaw('estado, COUNT(*) as total')
            ->groupBy('estado')
            ->pluck('total','estado');

        return view('admin.diagramas', compact('labels', 'data', 'pedidosPorEstado'));
    }

}
