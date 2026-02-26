<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    // Mostrar todas las categorías
    public function index()
    {
        $categorias = DB::table('categorias')
            ->orderBy('id', 'desc')
            ->paginate(10);


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
            'nombre' => $request->input('nombre'),
            'slug' => $request->input('nombre'), // si no quieres slug, lo quitamos
            'descripcion' => $request->input('descripcion'),
            'activo' => $request->input('activo') ? 1 : 0
        ]);

        return redirect()->action([CategoriaController::class, 'index']);
    }

    // Mostrar formulario de editar
    public function edit($id)
    {
        $categoria = DB::table('categorias')
            ->where('id', '=', $id)
            ->first();

        return view('categorias.edit', [
            'categoria' => $categoria
        ]);
    }

    // Actualizar categoría
    public function update(Request $request)
    {
        DB::table('categorias')
            ->where('id', '=', $request->input('id'))
            ->update([
                'nombre' => $request->input('nombre'),
                'slug' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'activo' => $request->input('activo') ? 1 : 0
            ]);

        return redirect()
            ->action([CategoriaController::class, 'index'])
            ->with('status', 'Categoría actualizada correctamente');
    }

    // Eliminar categoría
    public function delete($id)
    {
        DB::table('categorias')
            ->where('id', '=', $id)
            ->delete();

        return redirect()
            ->action([CategoriaController::class, 'index'])
            ->with('status', 'Categoría borrada correctamente');
    }
}
