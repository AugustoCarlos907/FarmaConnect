<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relatorio extends Model
{
    protected $fillable = [
        'data_inicio',
        'data_fim',
        'total_vendas',
        'total_receita',
        'tipo_relatorio',

        'farmacia_id',
        'pedido_id',
    ];

    public function farmacia()
    {
        return $this->belongsTo(Farmacia::class);
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
