<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    
    protected $fillable = [
        'quantidade',
        'preco',
        'data_validade',
        'lote',
        'ativo',
        'medicamento_id'
        
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
