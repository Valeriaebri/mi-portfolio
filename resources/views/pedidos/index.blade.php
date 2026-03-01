@extends('layouts.master')

@section('content')

    <h1 class="titulo-seccion">Mis pedidos</h1>

    @if(session('status'))
        <div class="alert success">{{ session('status') }}</div>
    @endif

    @if($pedidos->isEmpty())
        <p>No tienes pedidos todavía.</p>
    @else

        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>

            <tbody>
            @foreach($pedidos as $pedido)
                <tr>
                    <td>#{{ $pedido->id }}</td>
                    <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ number_format($pedido->total, 2) }} €</td>
                    <td>{{ ucfirst($pedido->estado) }}</td>
                    <td>
                        <a href="{{ route('pedidos.detalle', $pedido->id) }}" class="btn btn-primary btn-small">
                            Ver detalle
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="paginacion">
            {{ $pedidos->links() }}
        </div>

    @endif

@endsection
