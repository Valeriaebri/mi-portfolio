<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarritoController extends Controller
{
    // Mostrar el carrito del usuario
    public function index()
    {
        // Si no está logueado → redirigir
        if (!Auth::check()) {
            return redirect('/login')->with('status', 'Debes iniciar sesión para ver tu carrito.');
        }

        $userId = Auth::id();

        // Crear carrito si no existe
        $carrito = Carrito::firstOrCreate(['user_id' => $userId]);

        // Obtener productos con categoría y cantidad del pivot
        $productos = $carrito->productos()
            ->with('categoria')
            ->get();

        return view('carrito.index', compact('productos'));
    }

    // Añadir producto al carrito
    public function add($productoId)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('status', 'Debes iniciar sesión para añadir productos.');
        }

        $userId = Auth::id();
        $carrito = Carrito::firstOrCreate(['user_id' => $userId]);

        // Si ya existe, sumar 1. Si no, crear con cantidad = 1
        $productoPivot = $carrito->productos()->where('producto_id', $productoId)->first();

        if ($productoPivot) {
            // Ya existe → sumar 1
            $carrito->productos()->updateExistingPivot($productoId, [
                'cantidad' => DB::raw('cantidad + 1')
            ]);
        } else {
            // No existe → crear
            $carrito->productos()->attach($productoId, ['cantidad' => 1]);
        }

        return redirect()->back()->with('status', 'Producto añadido al carrito');
    }

    // Eliminar producto del carrito
    public function delete($productoId)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $carrito = Carrito::where('user_id', Auth::id())->firstOrFail();

        $carrito->productos()->detach($productoId);

        return redirect()->back()->with('status', 'Producto eliminado del carrito');
    }

    // Actualizar cantidad
    public function update(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $carrito = Carrito::where('user_id', Auth::id())->firstOrFail();

        $carrito->productos()->updateExistingPivot(
            $request->producto_id,
            ['cantidad' => $request->cantidad]
        );

        return redirect()->back()->with('status', 'Cantidad actualizada');
    }
}
