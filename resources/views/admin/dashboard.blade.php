@extends('layouts.master')

@section('content')

    <div class="grid-container">

        <h1 class="titulo-seccion">Panel de Administración</h1>

        <p style="margin-bottom: 25px;">
            Bienvenido, <strong>{{ auth()->user()->name }}</strong>.
            Desde aquí puedes gestionar el contenido de la web.
        </p>

        <div class="admin-info">

            <h2 style="margin-bottom: 10px;">Información general</h2>

            <ul style="line-height: 1.8; font-size: 16px;">
                <li>Productos totales: <strong>{{ \App\Models\Producto::count() }}</strong></li>
                <li>Categorías creadas: <strong>{{ \App\Models\Categoria::count() }}</strong></li>
                <li>Pedidos realizados: <strong>{{ \App\Models\Pedido::count() }}</strong></li>
                <li>Usuarios registrados: <strong>{{ \App\Models\User::count() }}</strong></li>
            </ul>

            <p style="margin-top: 25px;">
                Usa el menú superior para acceder a cada sección.
            </p>

        </div>

    </div>

@endsection
