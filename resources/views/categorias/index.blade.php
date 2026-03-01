@extends('layouts.master')

@section('content')

    <div class="admin-container">

        <h1 class="titulo-seccion">Categorías</h1>

        <a href="/admin/categorias/create" class="btn btn-primary">+ Añadir categoría</a>

        @if(session('status'))
            <div class="alert success">{{ session('status') }}</div>
        @endif

        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Slug</th>
                <th>Activo</th>
                <th>Acciones</th>
            </tr>
            </thead>

            <tbody>
            @foreach($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->nombre }}</td>
                    <td>{{ $categoria->slug }}</td>
                    <td>{{ $categoria->activo ? 'Sí' : 'No' }}</td>

                    <td>
                        <a href="/admin/categorias/edit/{{ $categoria->id }}" class="btn btn-primary">Editar</a>
                        <a href="/admin/categorias/delete/{{ $categoria->id }}" class="btn btn-danger"
                           onclick="return confirm('¿Seguro que quieres eliminar esta categoría?')">
                            Eliminar
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@endsection
