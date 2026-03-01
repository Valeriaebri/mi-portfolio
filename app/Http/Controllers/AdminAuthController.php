<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        // Si ya está logueado como admin → redirigir al panel
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Intentar login
        if (Auth::attempt($request->only('email', 'password'))) {

            // Si es admin → OK
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Si NO es admin → expulsarlo
            Auth::logout();
            return back()->withErrors([
                'email' => 'No tienes permisos de administrador.'
            ]);
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas.'
        ]);
    }
}
