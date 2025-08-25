<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $totalPedidos = Pedido::where('estado', 'entregado')->sum('total_pedido');
        $cantidadPedidos = Pedido::where('estado', 'entregado')->count();
        $productosBajosStock = Producto::where('cantidad', '<', 5)->get();
        $pedidosRecientes = Pedido::where('estado', 'entregado')->orderBy('created_at', 'desc')->take(5)->get();
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

        $colores = [
            'rgba(34, 197, 94, 0.7)',   // verde
            'rgba(59, 130, 246, 0.7)', // azul
            'rgba(239, 68, 68, 0.7)',  // rojo
            'rgba(234, 179, 8, 0.7)',  // amarillo
            'rgba(168, 85, 247, 0.7)', // violeta
            'rgba(236, 72, 153, 0.7)'  // rosa
        ];

        $coloresEstados = [];
        $i = 0;
        foreach ($pedidosPorEstado as $estado => $total) {
            $coloresEstados[$estado] = $colores[$i % count($colores)];
            $i++;
        }

        return view('admin.diagramas', compact('labels','data','pedidosPorEstado','coloresEstados'));
    }

}
