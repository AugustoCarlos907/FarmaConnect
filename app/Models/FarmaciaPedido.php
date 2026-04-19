<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmaciaPedido extends Model
{
    protected $table = 'farmacia_pedido';

    protected $fillable = [
        'pedido_id',
        'farmacia_id',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];
    
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function farmacia()
    {
        return $this->belongsTo(Farmacia::class);
    }
}
