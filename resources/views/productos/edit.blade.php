@extends('layouts.master')

@section('content')

    <div class="admin-container">

        <h1 class="titulo-seccion">Editar producto</h1>

        <form action="/admin/productos/update" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" value="{{ $producto->id }}">

            <label>Nombre</label>
            <input type="text" name="nombre" value="{{ $producto->nombre }}" required>

            <label>Descripción</label>
            <textarea name="descripcion">{{ $producto->descripcion }}</textarea>

            <label>Precio (€)</label>
            <input type="number" step="0.01" name="precio" value="{{ $producto->precio }}" required>

            <label>Modo de empleo</label>
            <textarea name="modo_empleo">{{ $producto->modo_empleo }}</textarea>

            <label>Ingredientes (INCI)</label>
            <textarea name="ingredientes_inci">{{ $producto->ingredientes_inci }}</textarea>

            <label>Categoría</label>
            <select name="categoria_id">
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}"
                            @if($categoria->id == $producto->categoria_id) selected @endif>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>

            <label>Imagen actual</label>

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

            <label>Subir nueva imagen</label>
            <input type="file" name="imagen" accept="image/*">

            <label>
                <input type="checkbox" name="destacado" @if($producto->destacado) checked @endif>
                Producto destacado
            </label>

            <label>
                <input type="checkbox" name="activo" @if($producto->activo) checked @endif>
                Producto activo
            </label>

            <button class="btn btn-primary">Actualizar</button>
        </form>

    </div>

@endsection
