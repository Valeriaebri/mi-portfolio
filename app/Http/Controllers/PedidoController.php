<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    // Mostrar todos los pedidos del usuario
    public function index()
    {
        $userId = auth()->id();

        $pedidos = DB::table('pedidos')
            ->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('pedidos.index', [
            'pedidos' => $pedidos
        ]);
    }

    // Crear un pedido desde el carrito
    public function crearPedido()
    {
        $userId = auth()->id();

        // Obtener carrito del usuario
        $carrito = DB::table('carritos')
            ->where('user_id', $userId)
            ->first();

        if (!$carrito) {
            return redirect()->back()->with('status', 'No tienes productos en el carrito');
        }

        // Obtener productos del carrito
        $productos = DB::table('carrito_producto')
            ->where('carrito_id', $carrito->id)
            ->get();

        if ($productos->isEmpty()) {
            return redirect()->back()->with('status', 'El carrito está vacío');
        }

        // Crear pedido
        $pedidoId = DB::table('pedidos')->insertGetId([
            'user_id' => $userId,
            'estado' => 'pendiente',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Insertar líneas del pedido
        foreach ($productos as $producto) {
            DB::table('pedido_producto')->insert([
                'pedido_id' => $pedidoId,
                'producto_id' => $producto->producto_id,
                'cantidad' => $producto->cantidad
            ]);
        }

        // Vaciar carrito
        DB::table('carrito_producto')
            ->where('carrito_id', $carrito->id)
            ->delete();

        return redirect()
            ->action([PedidoController::class, 'index'])
            ->with('status', 'Pedido creado correctamente');
    }

    // Ver detalle de un pedido
    public function detalle($id)
    {
        $pedido = DB::table('pedidos')->where('id', $id)->first();

        $productos = DB::table('pedido_producto')
            ->join('productos', 'pedido_producto.producto_id', '=', 'productos.id')
            ->where('pedido_id', $id)
            ->select('productos.*', 'pedido_producto.cantidad')
            ->get();

        return view('pedidos.detalle', [
            'pedido' => $pedido,
            'productos' => $productos
        ]);
    }
}

