<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    
    protected $fillable = [
        'pedido_id',
        'status',
        'metodo_pagamento',
        'valor',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function factura()
    {
        return $this->hasOne(Factura::class);
    }
}
