@extends('layouts.master')

@section('content')

    <div class="admin-container">

        <h1 class="titulo-seccion">Crear producto</h1>

        <form action="/admin/productos/save" method="POST" enctype="multipart/form-data">
            @csrf

            <label>Nombre</label>
            <input type="text" name="nombre" required>

            <label>Descripción</label>
            <textarea name="descripcion"></textarea>

            <label>Precio (€)</label>
            <input type="number" step="0.01" name="precio" required>

            <label>Modo de empleo</label>
            <textarea name="modo_empleo"></textarea>

            <label>Ingredientes (INCI)</label>
            <textarea name="ingredientes_inci"></textarea>

            <label>Categoría</label>
            <select name="categoria_id" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>

            <label>Imagen del producto</label>
            <input type="file" name="imagen" accept="image/*">

            <label>
                <input type="checkbox" name="destacado">
                Producto destacado
            </label>

            <label>
                <input type="checkbox" name="activo" checked>
                Producto activo
            </label>

            <button class="btn btn-primary">Guardar</button>
        </form>

    </div>

@endsection
