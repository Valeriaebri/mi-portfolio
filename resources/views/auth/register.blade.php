@extends('layouts.master')

@section('content')

    <div class="container" style="max-width: 600px; margin: 50px auto;">
        <h2>Crear cuenta</h2>

        <form method="POST" action="/register">
            @csrf

            <label>Nombre</label>
            <input type="text" name="nombre" required class="form-control">

            <label>Apellidos</label>
            <input type="text" name="apellidos" required class="form-control">

            <label>NIF</label>
            <input type="text" name="nif" required class="form-control">

            <label>Email</label>
            <input type="email" name="email" required class="form-control">

            <label>Contraseña</label>
            <input type="password" name="password" required class="form-control">

            <label>Repetir contraseña</label>
            <input type="password" name="password_confirmation" required class="form-control">

            <button type="submit" class="btn btn-success" style="margin-top: 20px;">
                Registrarme
            </button>
        </form>

    </div>

@endsection
