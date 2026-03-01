<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; }
        h1 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        th { background: #f2f2f2; }
        .total { margin-top: 20px; font-size: 16px; font-weight: bold; }
    </style>
</head>
<body>

<h1>Pedido #{{ $pedido->id }}</h1>

<p><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
<p><strong>Estado:</strong> {{ ucfirst($pedido->estado) }}</p>

<table>
    <thead>
    <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Subtotal</th>
    </tr>
    </thead>

    <tbody>
    @foreach($productos as $p)
        <tr>
            <td>{{ $p->nombre }}</td>
            <td>{{ $p->pivot->cantidad }}</td>
            <td>{{ number_format($p->pivot->precio_unitario, 2) }} €</td>
            <td>{{ number_format($p->pivot->precio_unitario * $p->pivot->cantidad, 2) }} €</td>
        </tr>
    @endforeach
    </tbody>
</table>

<p class="total">Total: {{ number_format($pedido->total, 2) }} €</p>

</body>
</html>
