<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    // Mostrar todos los productos
    public function index()
    {
        $productos = DB::table('productos')
            ->orderBy('id', 'desc')
            ->paginate(10);


        return view('productos.index', [
            'productos' => $productos
        ]);
    }

    // Formulario de crear producto
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
            $archivo->move(public_path('uploads'), $nombreImagen);
        }

        DB::table('productos')->insert([
            'nombre' => $request->input('nombre'),
            'slug' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'precio' => $request->input('precio'),
            'modo_empleo' => $request->input('modo_empleo'),
            'ingredientes_inci' => $request->input('ingredientes_inci'),
            'destacado' => $request->input('destacado') ? 1 : 0,
            'activo' => $request->input('activo') ? 1 : 0,
            'categoria_id' => $request->input('categoria_id'),
            'imagen' => $nombreImagen,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/productos')->with('status', 'Producto creado');
    }


    // Formulario de editar producto
    public function edit($id)
    {
        $producto = DB::table('productos')
            ->where('id', '=', $id)
            ->first();

        $categorias = Categoria::all();

        return view('productos.edit', [
            'producto' => $producto,
            'categorias' => $categorias
        ]);
    }

    // Actualizar producto
    public function update(Request $request)
    {
        $nombreImagen = $request->input('imagen_actual');

        if ($request->hasFile('imagen')) {
            $archivo = $request->file('imagen');
            $nombreImagen = time() . '_' . $archivo->getClientOriginalName();
            $archivo->move(public_path('uploads'), $nombreImagen);
        }

        DB::table('productos')
            ->where('id', '=', $request->input('id'))
            ->update([
                'nombre' => $request->input('nombre'),
                'slug' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'precio' => $request->input('precio'),
                'modo_empleo' => $request->input('modo_empleo'),
                'ingredientes_inci' => $request->input('ingredientes_inci'),
                'destacado' => $request->input('destacado') ? 1 : 0,
                'activo' => $request->input('activo') ? 1 : 0,
                'categoria_id' => $request->input('categoria_id'),
                'imagen' => $nombreImagen,
                'updated_at' => now()
            ]);

        return redirect('/productos')->with('status', 'Producto actualizado');
    }


    // Eliminar producto
    public function delete($id)
    {
        DB::table('productos')
            ->where('id', '=', $id)
            ->delete();

        return redirect()
            ->action([ProductoController::class, 'index'])
            ->with('status', 'Producto borrado correctamente');
    }
}
