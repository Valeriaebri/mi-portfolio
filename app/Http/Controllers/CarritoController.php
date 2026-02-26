<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarritoController extends Controller
{
    // Mostrar el carrito del usuario
    public function index()
    {
        $userId = auth()->id();

        // Buscar carrito del usuario
        $carrito = DB::table('carritos')
            ->where('user_id', $userId)
            ->first();

        if (!$carrito) {
            return view('carrito.index', ['productos' => []]);
        }

        // Obtener productos del carrito
        $productos = DB::table('carrito_producto')
            ->join('productos', 'carrito_producto.producto_id', '=', 'productos.id')
            ->where('carrito_id', $carrito->id)
            ->select('productos.*', 'carrito_producto.cantidad', 'carrito_producto.id as linea_id')
            ->get();

        return view('carrito.index', [
            'productos' => $productos
        ]);
    }

    // Añadir producto al carrito
    public function add($productoId)
    {
        $userId = auth()->id();

        // Buscar o crear carrito
        $carrito = DB::table('carritos')->where('user_id', $userId)->first();

        if (!$carrito) {
            $carritoId = DB::table('carritos')->insertGetId([
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } else {
            $carritoId = $carrito->id;
        }

        // Comprobar si el producto ya está en el carrito
        $linea = DB::table('carrito_producto')
            ->where('carrito_id', $carritoId)
            ->where('producto_id', $productoId)
            ->first();

        if ($linea) {
            // Aumentar cantidad
            DB::table('carrito_producto')
                ->where('id', $linea->id)
                ->update([
                    'cantidad' => $linea->cantidad + 1
                ]);
        } else {
            // Insertar nuevo producto
            DB::table('carrito_producto')->insert([
                'carrito_id' => $carritoId,
                'producto_id' => $productoId,
                'cantidad' => 1
            ]);
        }

        return redirect()->back()->with('status', 'Producto añadido al carrito');
    }

    // Eliminar producto del carrito
    public function delete($productoId)
    {
        $userId = auth()->id();

        $carrito = DB::table('carritos')->where('user_id', $userId)->first();

        if ($carrito) {
            DB::table('carrito_producto')
                ->where('carrito_id', $carrito->id)
                ->where('producto_id', $productoId)
                ->delete();
        }

        return redirect()->back()->with('status', 'Producto eliminado del carrito');
    }

    // Actualizar cantidad
    public function update(Request $request)
    {
        DB::table('carrito_producto')
            ->where('id', $request->input('linea_id'))
            ->update([
                'cantidad' => $request->input('cantidad')
            ]);

        return redirect()->back()->with('status', 'Cantidad actualizada');
    }
}
