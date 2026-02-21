<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'user_id',
        'farmacia_id',
        'status',
        'total',
        'data_pedido',
        // 'endereco_entrega',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function farmacia()
    {
        return $this->belongsTo(Farmacia::class);
    }

    public function items()
    {
        return $this->hasMany(ItemPedido::class);
    }
}
