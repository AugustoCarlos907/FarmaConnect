<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $fillable = [
        'user_id',
        'farmacia_id',
        'status',
        'data_pedido',
        'endereco',
        'latitude',
        'longitude',
        'total',
        'metodo_pagamento',
        'comprovativo_express',
        'prescricao_path'
    ];


    protected $casts = [
        'data_pedido' => 'datetime',
    ];
    
    public function user()
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

    public function pagamento(){
        return $this->hasOne(Pagamento::class);
    }

    public function entrega(){
        return $this->hasOne(Entrega::class);
    }

    public function factura(){
        return $this->hasOne(Factura::class);
    }
}
