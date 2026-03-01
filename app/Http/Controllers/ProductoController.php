<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoController extends Controller
{
    // Mostrar todos los productos
    public function general()
    {
        // TIENDA PÚBLICA
        $productos = Producto::paginate(12);
        return view('productos.general', compact('productos'));
    }

    public function index()
    {
        // PANEL ADMIN
        $productos = Producto::with('categoria')->paginate(15);
        return view('productos.index', compact('productos'));
    }


    // Mostrar formulario de crear
    public function create()
    {
        $categorias = Categoria::all();

        return view('productos.create', [
            'categorias' => $categorias
        ]);
    }

    // Guardar producto nuevo
    public function save(Request $request)
    {
        $nombreImagen = null;

        if ($request->hasFile('imagen')) {
            $archivo = $request->file('imagen');
            $nombreImagen = time() . '_' . $archivo->getClientOriginalName();
            $archivo->move(public_path('img'), $nombreImagen);
        }

        Producto::create([
            'nombre' => $request->nombre,
            'slug' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'modo_empleo' => $request->modo_empleo,
            'ingredientes_inci' => $request->ingredientes_inci,
            'destacado' => $request->destacado ? 1 : 0,
            'activo' => $request->activo ? 1 : 0,
            'categoria_id' => $request->categoria_id,
            'imagen' => $nombreImagen
        ]);

        return redirect()->route('admin.productos')
            ->with('status', 'Producto creado correctamente');
    }

    // Mostrar formulario de editar
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();

        return view('productos.edit', [
            'producto' => $producto,
            'categorias' => $categorias
        ]);
    }

    // Actualizar producto
    public function update(Request $request)
    {
        $producto = Producto::findOrFail($request->id);

        $nombreImagen = $producto->imagen;

        if ($request->hasFile('imagen')) {
            $archivo = $request->file('imagen');
            $nombreImagen = time() . '_' . $archivo->getClientOriginalName();
            $archivo->move(public_path('img'), $nombreImagen);
        }

        $producto->update([
            'nombre' => $request->nombre,
            'slug' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'modo_empleo' => $request->modo_empleo,
            'ingredientes_inci' => $request->ingredientes_inci,
            'destacado' => $request->destacado ? 1 : 0,
            'activo' => $request->activo ? 1 : 0,
            'categoria_id' => $request->categoria_id,
            'imagen' => $nombreImagen
        ]);

        return redirect()->route('admin.productos')
            ->with('status', 'Producto actualizado correctamente');
    }

    // Eliminar producto
    public function delete($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('admin.productos')
            ->with('status', 'Producto eliminado correctamente');
    }
}
