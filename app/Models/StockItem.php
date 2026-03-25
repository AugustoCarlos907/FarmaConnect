<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    
    protected $fillable = [
        'quantidade',
        'data_validade',
        'lote',
        'preco',
        'ativo',
        'medicamento_id',
        'farmacia_id'
        
    ];

    protected $casts = [
        'data_validade' => 'datetime',
    ];

    public function farmacia()
    {
        return $this->belongsTo(Farmacia::class);
    }

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class);
    }

    public function temStock(int $quantidade): bool
    {
        return $this->quantidade >= $quantidade;
    }

    public function baixarStock(int $quantidade): void
    {
        $this->decrement('quantidade', $quantidade);
    }
}
