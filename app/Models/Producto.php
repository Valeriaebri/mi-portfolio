<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Producto extends Model
{
    use hasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'precio',
        'stock',
        'modo_empleo',
        'ingredinetes_inci',
        'destacado',
        'activo',
        'categoria_id',
        'imagen',
    ];
    // 🔹 Un producto pertenece a una categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // 🔹 Un producto puede estar en muchos carritos
    public function carritoProductos()
    {
        return $this->hasMany(CarritoProducto::class);
    }


}
