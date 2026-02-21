<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    protected $fillable = [
        'pedido_id',
        'entregador_id',
        // 'avaliacao_id',
        'status',
        'taxa_entrega',
        'distancia_km',
        'data_saida',
        'data_entrega',
        'observacoes'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function entregador()
    {
        return $this->belongsTo(Entregador::class);
    }

    public function avaliacao()
    {
        return $this->belongsTo(Avaliacao::class);
    }
}
