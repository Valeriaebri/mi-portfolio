<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Producto::create([
            'nombre' => 'Serum Vitamina C',
            'slug' => 'serum-vitamina-c',
            'descripcion' => 'Ilumina y unifica el tono',
            'precio' => 29.99,
            'stock' => 50,
            'modo_empleo' => 'Aplicar por la mañana',
            'ingredientes_inci' => 'Ascorbic Acid, Glycerin',
            'destacado' => 1,
            'activo' => 1,
            'categoria_id' => 1
        ]);

        Producto::create([
            'nombre' => 'Crema Hidratante',
            'slug' => 'crema-hidratante',
            'descripcion' => 'Hidratación profunda',
            'precio' => 19.99,
            'stock' => 40,
            'modo_empleo' => 'Aplicar mañana y noche',
            'ingredientes_inci' => 'Aloe Vera, Shea Butter',
            'destacado' => 0,
            'activo' => 1,
            'categoria_id' => 2
        ]);
    }
}
