<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    // Mostrar todas las categorías
    public function index()
    {
        $categorias = Categoria::orderBy('id', 'desc')->paginate(10);

        return view('categorias.index', [
            'categorias' => $categorias
        ]);
    }

    // Mostrar formulario de crear
    public function create()
    {
        return view('categorias.create');
    }

    // Guardar categoría nueva
    public function save(Request $request)
    {
        Categoria::create([
            'nombre' => $request->nombre,
            'slug' => $request->nombre,
            'descripcion' => $request->descripcion,
            'activo' => $request->activo ? 1 : 0
        ]);

        return redirect()->route('categorias.index')
            ->with('status', 'Categoría creada correctamente');
    }

    // Mostrar formulario de editar
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);

        return view('categorias.edit', [
            'categoria' => $categoria
        ]);
    }

    // Actualizar categoría
    public function update(Request $request)
    {
        $categoria = Categoria::findOrFail($request->id);

        $categoria->update([
            'nombre' => $request->nombre,
            'slug' => $request->nombre,
            'descripcion' => $request->descripcion,
            'activo' => $request->activo ? 1 : 0
        ]);

        return redirect()->route('categorias.index')
            ->with('status', 'Categoría actualizada correctamente');
    }

    // Eliminar categoría
    public function delete($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('status', 'Categoría borrada correctamente');
    }
}
