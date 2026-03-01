@extends('layouts.master')

@section('content')

    <div class="container" style="max-width: 500px; margin: 50px auto;">
        <h2>Iniciar sesión</h2>

        <form method="POST" action="/login">
            @csrf

            <label>Email</label>
            <input type="email" name="email" required class="form-control">

            <label>Contraseña</label>
            <input type="password" name="password" required class="form-control">

            <button type="submit" class="btn btn-primary" style="margin-top: 20px;">
                Entrar
            </button>
        </form>

        <p style="margin-top: 15px;">
            ¿No tienes cuenta? <a href="/register">Regístrate aquí</a>
        </p>
    </div>

@endsection
