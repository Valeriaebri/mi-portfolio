<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $table = 'carritos';

    protected $fillable = [
        'user_id'
    ];

    // 🔹 El carrito pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔹 El carrito tiene muchos productos (tabla intermedia)
    public function carritoProductos()
    {
        return $this->hasMany(CarritoProducto::class);
    }
}
