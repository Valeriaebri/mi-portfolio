@extends('layouts.master')

@section('content')

    <div class="admin-container">

        <h1 class="titulo-seccion">Crear categoría</h1>

        <form action="/admin/categorias/save" method="POST">
            @csrf

            <label>Nombre</label>
            <input type="text" name="nombre" required>

            <label>Descripción</label>
            <textarea name="descripcion"></textarea>

            <label>
                <input type="checkbox" name="activo" checked>
                Categoría activa
            </label>

            <button class="btn btn-primary">Guardar</button>
        </form>

    </div>

@endsection
