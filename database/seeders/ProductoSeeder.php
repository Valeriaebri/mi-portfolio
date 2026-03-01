<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        Producto::create([
            'nombre' => 'Kiwi Minogue',
            'slug' => 'kiwi-minogue',
            'descripcion' => 'Tratamiento facial multifunción para mejorar la textura, luminosidad y aspecto general de la piel.',
            'precio' => 35.00,
            'stock' => 50,
            'modo_empleo' => 'Aplicar sobre la piel limpia antes de la crema.',
            'ingredientes_inci' => 'Aqua, Glycerin, Kiwi Extract...',
            'destacado' => 1,
            'activo' => 1,
            'categoria_id' => 1,
            'imagen' => 'kiwi-minogue.png'
        ]);

        Producto::create([
            'nombre' => 'Piña Turner',
            'slug' => 'pina-turner',
            'descripcion' => 'Protege, regula y matifica. Protección frente a UVB, UVA, infrarrojos, luz azul y polución.',
            'precio' => 28.50,
            'stock' => 50,
            'modo_empleo' => 'Aplicar cada mañana como último paso de la rutina.',
            'ingredientes_inci' => 'Zinc Oxide, Titanium Dioxide, Pineapple Extract...',
            'destacado' => 1,
            'activo' => 1,
            'categoria_id' => 1,
            'imagen' => 'pina-turner.png'
        ]);

        Producto::create([
            'nombre' => 'Dua Lime',
            'slug' => 'dua-lime',
            'descripcion' => 'Serum renovador. Reduce y previene imperfecciones.',
            'precio' => 29.90,
            'stock' => 50,
            'modo_empleo' => 'Aplicar mañana y noche sobre la piel limpia.',
            'ingredientes_inci' => 'Citrus Aurantifolia Extract, Glycerin...',
            'destacado' => 1,
            'activo' => 1,
            'categoria_id' => 1,
            'imagen' => 'dua-lime.png'
        ]);

        Producto::create([
            'nombre' => 'Madorange',
            'slug' => 'madorange',
            'descripcion' => 'Serum iluminador. Antioxidante y antiarrugas.',
            'precio' => 31.50,
            'stock' => 40,
            'modo_empleo' => 'Aplicar 3-4 gotas antes de la crema.',
            'ingredientes_inci' => 'Vitamin C Derivatives, Citrus Extract...',
            'destacado' => 1,
            'activo' => 1,
            'categoria_id' => 1,
            'imagen' => 'madorange.png'
        ]);

        Producto::create([
            'nombre' => 'Mango Cyrus',
            'slug' => 'mango-cyrus',
            'descripcion' => 'Crema perfeccionadora. Hidrata, unifica el tono y protege de factores ambientales.',
            'precio' => 31.90,
            'stock' => 40,
            'modo_empleo' => 'Aplicar mañana y noche sobre rostro y cuello.',
            'ingredientes_inci' => 'Mangifera Indica Extract, Shea Butter...',
            'destacado' => 0,
            'activo' => 1,
            'categoria_id' => 2,
            'imagen' => 'mango-cyrus.png'
        ]);

        Producto::create([
            'nombre' => 'Grape Kelly',
            'slug' => 'grape-kelly',
            'descripcion' => 'Aceite reparador. Regenera tu rostro y nutre tu barba.',
            'precio' => 27.50,
            'stock' => 30,
            'modo_empleo' => 'Aplicar 2-3 gotas sobre rostro o barba.',
            'ingredientes_inci' => 'Vitis Vinifera Seed Oil, Tocopherol...',
            'destacado' => 0,
            'activo' => 1,
            'categoria_id' => 4,
            'imagen' => 'grape-kelly.png'
        ]);

        Producto::create([
            'nombre' => 'Cactus Perry',
            'slug' => 'cactus-perry',
            'descripcion' => 'Crema rejuvenecedora. Redensifica y reafirma.',
            'precio' => 33.50,
            'stock' => 35,
            'modo_empleo' => 'Aplicar mañana y noche.',
            'ingredientes_inci' => 'Opuntia Ficus-Indica Extract, Hyaluronic Acid...',
            'destacado' => 1,
            'activo' => 1,
            'categoria_id' => 2,
            'imagen' => 'cactus-perry.png'
        ]);

        Producto::create([
            'nombre' => 'Elton Lemon',
            'slug' => 'elton-lemon',
            'descripcion' => 'Tónico facial. Solución limpiadora, exfoliante y equilibrante.',
            'precio' => 22.90,
            'stock' => 60,
            'modo_empleo' => 'Aplicar con algodón antes del sérum.',
            'ingredientes_inci' => 'Citrus Limon Extract, Glycerin...',
            'destacado' => 0,
            'activo' => 1,
            'categoria_id' => 3,
            'imagen' => 'elton-lemon.png'
        ]);
    }
}
