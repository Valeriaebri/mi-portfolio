@extends('layouts.master')

@section('content')

    <div class="admin-container">

        <h1 class="titulo-seccion">Editar categoría</h1>

        <form action="/admin/categorias/update" method="POST">
            @csrf

            <input type="hidden" name="id" value="{{ $categoria->id }}">

            <label>Nombre</label>
            <input type="text" name="nombre" value="{{ $categoria->nombre }}" required>

            <label>Descripción</label>
            <textarea name="descripcion">{{ $categoria->descripcion }}</textarea>

            <label>
                <input type="checkbox" name="activo" @if($categoria->activo) checked @endif>
                Categoría activa
            </label>

            <button class="btn btn-primary">Actualizar</button>
        </form>

    </div>

@endsection
