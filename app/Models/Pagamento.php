<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    
    protected $fillable = [
        'pedido_id',
        'status',
        'metodo',
        'valor',
        'data_pagamento'
    ];

    public function comprovativo(){
        return $this->hasOne(ComprovativoPagamento::class);
    }
    
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function factura()
    {
        return $this->hasOne(Factura::class);
    }
}
