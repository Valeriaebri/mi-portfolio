<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Carrito;
use Barryvdh\DomPDF\Facade\Pdf;

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

        // Calcular total
        $total = 0;
        foreach ($carrito->productos as $producto) {
            $total += $producto->precio * $producto->pivot->cantidad;
        }

        // Crear pedido
        $pedido = Pedido::create([
            'user_id' => $userId,
            'estado' => 'pendiente',
            'tipo' => 'normal',
            'total' => $total
        ]);

        // Copiar productos del carrito al pedido
        foreach ($carrito->productos as $producto) {
            $pedido->productos()->attach($producto->id, [
                'cantidad' => $producto->pivot->cantidad,
                'precio_unitario' => $producto->precio
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


    public function pdf($id)
    {
        $pedido = Pedido::with('productos')->findOrFail($id);

        $pdf = Pdf::loadView('pedidos.pdf', [
            'pedido' => $pedido,
            'productos' => $pedido->productos
        ]);

        return $pdf->download('pedido_'.$pedido->id.'.pdf');
    }

}
