<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    protected $fillable = [
        'pedido_id',
        'entregador_id',
        'status',
        'endereco_entrega',
        'taxa_entrega',
        'distancia_km',
        'data_saida',
        'data_entrega',
        'observacoes',
        // 'avaliacao_id',
        'rota',
        'codigo_confirmacao'
    ];

    protected $appends = ['rota_array'];


    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function entregador()
    {
        return $this->belongsTo(Entregador::class);
    }


    public function getRotaArrayAttribute()
    {
        return $this->rota ? json_decode($this->rota, true) : [];
    }
}
