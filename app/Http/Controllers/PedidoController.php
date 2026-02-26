<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Carrito;

class PedidoController extends Controller
{
    // Mostrar pedidos del usuario
    public function index()
    {
        $pedidos = Pedido::where('user_id', auth()->id())
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

        $carrito = Carrito::where('user_id', $userId)->firstOrFail();

        if ($carrito->productos->isEmpty()) {
            return redirect()->back()->with('status', 'El carrito está vacío');
        }

        // Crear pedido
        $pedido = Pedido::create([
            'user_id' => $userId,
            'estado' => 'pendiente',
            'tipo' => 'normal',
            'total' => 0
        ]);

        // Copiar productos del carrito al pedido
        foreach ($carrito->productos as $producto) {
            $pedido->productos()->attach($producto->id, [
                'cantidad' => $producto->pivot->cantidad
            ]);
        }

        // Vaciar carrito
        $carrito->productos()->detach();

        return redirect()->route('pedidos.index')
            ->with('status', 'Pedido creado correctamente');
    }

    // Ver detalle de un pedido
    public function detalle($id)
    {
        $pedido = Pedido::with('productos')->findOrFail($id);

        return view('pedidos.detalle', [
            'pedido' => $pedido,
            'productos' => $pedido->productos
        ]);
    }
}
