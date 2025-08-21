<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura Pedido #{{ $pedido->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .logo {
            font-size: 20px;
            font-weight: bold;
            color: #2563eb;
        }
        .empresa {
            text-align: right;
            font-size: 12px;
        }
        h1 {
            text-align: center;
            margin: 10px 0 20px 0;
            font-size: 18px;
        }
        .info {
            margin-bottom: 20px;
        }
        .info p {
            margin: 2px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background: #f3f4f6;
        }
        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 14px;
            font-weight: bold;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #666;
        }
    </style>
</head>
<body>
<!-- Encabezado con logo + empresa -->
<div class="header">
    <div class="logo">Palets Épila</div>
    <div class="empresa">
        Palets Épila S.L.<br>
        C/ Ejemplo 123<br>
        Zaragoza, España<br>
        CIF: B-12345678
    </div>
</div>

<h1>Factura Pedido #{{ $pedido->id }}</h1>

<!-- Info cliente y pedido -->
<div class="info">
    <p><strong>Cliente:</strong> {{ $pedido->cliente->name }} {{ $pedido->cliente->apellidos ?? '' }}</p>
    <p><strong>Email:</strong> {{ $pedido->cliente->email }}</p>
    <p><strong>Dirección de envío:</strong> {{ $pedido->direccion_envio }}, {{ $pedido->codigo_postal }} {{ $pedido->ciudad }} ({{ $pedido->provincia }})</p>
    <p><strong>Teléfono:</strong> {{ $pedido->telefono_contacto }}</p>
    <p><strong>Fecha:</strong> {{ $pedido->fecha_pedido->format('d/m/Y') }}</p>
    <p><strong>Método de pago:</strong> {{ ucfirst($pedido->metodo_pago) }}</p>
    <p><strong>Estado:</strong> {{ ucfirst($pedido->estado) }}</p>
</div>

<!-- Tabla de productos -->
<table>
    <thead>
    <tr>
        <th>Producto</th>
        <th>Precio unitario</th>
        <th>Cantidad</th>
        <th>Subtotal</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pedido->detalles as $detalle)
        <tr>
            <td>{{ $detalle->producto->nombre }}</td>
            <td>€ {{ number_format($detalle->precio_unitario, 2) }}</td>
            <td>{{ $detalle->cantidad }}</td>
            <td>€ {{ number_format($detalle->precio_unitario * $detalle->cantidad, 2) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<!-- Total -->
<p class="total">Total: € {{ number_format($pedido->total_pedido, 2) }}</p>

<!-- Pie de factura -->
<div class="footer">
    Gracias por confiar en Palets Épila.<br>
    Esta factura ha sido generada automáticamente el {{ now()->format('d/m/Y H:i') }}.
</div>
</body>
</html>
