<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthClienteController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {

            // Si es admin, lo mandamos al panel admin
            if (Auth::user()->role === 'admin') {
                return redirect('/admin');
            }

            // Si es cliente, a pedidos o home
            return redirect('/');
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas']);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'nif' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'nif' => $request->nif,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'cliente',
            'total_pedidos' => 0,
            'foto' => 'foto'
        ]);

        Auth::login($user);

        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

