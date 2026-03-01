@extends('layouts.master')

@section('content')

    <h1 class="titulo-seccion">Pedido #{{ $pedido->id }}</h1>

    <p><strong>Estado:</strong> {{ ucfirst($pedido->estado) }}</p>
    <p><strong>Total:</strong> {{ number_format($pedido->total, 2) }} €</p>
    <p><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>

    <a href="{{ route('pedidos.pdf', $pedido->id) }}" class="btn btn-primary btn-large" style="margin-bottom:20px;">
        Descargar PDF
    </a>

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

@endsection
