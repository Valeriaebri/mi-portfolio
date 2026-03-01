<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{

    public function run(): void
    {
        Categoria::create([
            'nombre' => 'Serums',
            'slug' => 'serums',
            'descripcion' => 'Tratamientos concentrados',
            'activo' => 1
        ]);

        Categoria::create([
            'nombre' => 'Cremas',
            'slug' => 'cremas',
            'descripcion' => 'Cremas hidratantes y nutritivas',
            'activo' => 1
        ]);

        Categoria::create([
            'nombre' => 'Limpieza',
            'slug' => 'limpieza',
            'descripcion' => 'Productos de limpieza facial',
            'activo' => 1
        ]);
        Categoria::create([
            'id' => 4,
            'nombre' => 'Aceites',
            'slug' => 'aceites',
            'activo' => 1 ]);
    }
}
