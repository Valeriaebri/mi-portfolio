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

    // El carrito pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación N:N con productos usando la tabla pivote carrito_producto
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'carrito_producto')
            ->withPivot('cantidad')
            ->withTimestamps();
    }
}
