<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'user_id',
        'estado',
        'tipo',
        'tipo_envio',
        'forma_pago',
        'transaccion',
        'total'
    ];

    // 🔹 El pedido pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'pedido_producto')
            ->withPivot('cantidad', 'precio_unitario')
            ->withTimestamps();
    }

}
