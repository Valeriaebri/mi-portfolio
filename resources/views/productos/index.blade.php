@extends('layouts.master')

@section('content')

    <div class="admin-container">

        <h1 class="titulo-seccion">Productos</h1>

        <a href="/admin/productos/create" class="btn btn-primary">+ Añadir producto</a>

        @if(session('status'))
            <div class="alert success">{{ session('status') }}</div>
        @endif

        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Activo</th>
                <th>Destacado</th>
                <th>Acciones</th>
            </tr>
            </thead>

            <tbody>
            @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>

                    <td>
                        @php
                            $imgPublic = public_path('img/' . $producto->imagen);
                            $imgProductos = public_path('img/productos/' . $producto->imagen);
                        @endphp

                        @if($producto->imagen && file_exists($imgPublic))
                            <img src="/img/{{ $producto->imagen }}" class="tabla-img">

                        @elseif($producto->imagen && file_exists($imgProductos))
                            <img src="/img/productos/{{ $producto->imagen }}" class="tabla-img">

                        @else
                            <img src="/img/producto-placeholder.png" class="tabla-img">
                        @endif
                    </td>

                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->categoria->nombre }}</td>
                    <td>{{ $producto->precio }} €</td>

                    <td>{{ $producto->activo ? 'Sí' : 'No' }}</td>
                    <td>{{ $producto->destacado ? 'Sí' : 'No' }}</td>

                    <td>
                        <a href="/admin/productos/edit/{{ $producto->id }}" class="btn btn-primary">Editar</a>
                        <a href="/admin/productos/delete/{{ $producto->id }}" class="btn btn-danger"
                           onclick="return confirm('¿Seguro que quieres eliminar este producto?')">
                            Eliminar
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="paginacion">
            {{ $productos->links() }}
        </div>

    </div>

@endsection
