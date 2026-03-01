@extends('layouts.master')

@section('content')
    <style>
        body {
            background: #f7f4f9;
            font-family: 'Poppins', sans-serif;
        }

        .login-container {
            max-width: 420px;
            margin: 80px auto;
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            text-align: center;
        }

        .login-container h2 {
            font-weight: 600;
            margin-bottom: 25px;
            color: #5a2d82;
        }

        .login-container input {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
        }

        .login-container button {
            width: 100%;
            padding: 12px;
            background: #5a2d82;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.2s;
        }

        .login-container button:hover {
            background: #7a3bb0;
        }

        .error {
            background: #ffdddd;
            padding: 10px;
            border-left: 4px solid #ff4d4d;
            margin-bottom: 15px;
            border-radius: 6px;
            color: #a30000;
            font-size: 14px;
        }
    </style>

    <div class="login-container">
        <h2>Acceso Administrador</h2>

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="/admin/login">
            @csrf

            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>

            <button type="submit">Entrar</button>
        </form>
    </div>

@endsection
