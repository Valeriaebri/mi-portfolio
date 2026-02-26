<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\Producto;

class CarritoController extends Controller
{
    // Mostrar el carrito del usuario
    public function index()
    {
        $userId = auth()->id();

        $carrito = Carrito::firstOrCreate(['user_id' => $userId]);

        $productos = $carrito->productos()
            ->with('categoria')
            ->get();

        return view('carrito.index', [
            'productos' => $productos
        ]);
    }

    // Añadir producto al carrito
    public function add($productoId)
    {
        $userId = auth()->id();

        $carrito = Carrito::firstOrCreate(['user_id' => $userId]);

        // Si ya existe, suma 1. Si no, lo crea.
        $carrito->productos()->syncWithoutDetaching([
            $productoId => ['cantidad' => \DB::raw('cantidad + 1')]
        ]);

        return redirect()->back()->with('status', 'Producto añadido al carrito');
    }

    // Eliminar producto del carrito
    public function delete($productoId)
    {
        $userId = auth()->id();

        $carrito = Carrito::where('user_id', $userId)->firstOrFail();

        $carrito->productos()->detach($productoId);

        return redirect()->back()->with('status', 'Producto eliminado del carrito');
    }

    // Actualizar cantidad
    public function update(Request $request)
    {
        $carrito = Carrito::where('user_id', auth()->id())->firstOrFail();

        $carrito->productos()->updateExistingPivot(
            $request->producto_id,
            ['cantidad' => $request->cantidad]
        );

        return redirect()->back()->with('status', 'Cantidad actualizada');
    }
}
