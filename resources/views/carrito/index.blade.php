@extends('layouts.master')

@section('content')

    <h1 class="titulo-seccion">Mi carrito</h1>

    @if(session('status'))
        <div class="alert success">{{ session('status') }}</div>
    @endif

    @if($productos->isEmpty())
        <p>No tienes productos en el carrito.</p>
    @else

        <table>
            <thead>
            <tr>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
            </thead>

            <tbody>
            @php $total = 0; @endphp

            @foreach($productos as $producto)
                @php
                    $subtotal = $producto->precio * $producto->pivot->cantidad;
                    $total += $subtotal;
                @endphp

                <tr>
                    <td>
                        @if($producto->imagen)
                            <img src="/img/{{ $producto->imagen }}" class="tabla-img">
                        @else
                            <img src="/img/producto-placeholder.png" class="tabla-img">
                        @endif
                    </td>

                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->categoria->nombre }}</td>
                    <td>{{ $producto->precio }} €</td>

                    <td>
                        <form action="/carrito/update" method="POST" class="form-inline">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                            <input type="number" name="cantidad" value="{{ $producto->pivot->cantidad }}" min="1" class="input-cantidad">
                            <button class="btn btn-primary btn-small">Actualizar</button>
                        </form>
                    </td>

                    <td>{{ number_format($subtotal, 2) }} €</td>

                    <td>
                        <a href="/carrito/delete/{{ $producto->id }}" class="btn btn-danger btn-small"
                           onclick="return confirm('¿Eliminar este producto del carrito?')">
                            Eliminar
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="carrito-total">
            <h2>Total: {{ number_format($total, 2) }} €</h2>

            <a href="/pedidos/crear" class="btn btn-primary btn-large">
                Crear pedido
            </a>
        </div>

    @endif

@endsection
