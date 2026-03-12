<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    protected $fillable = [
        'user_id',
        'stock_item_id',
        'quantidade',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stockItem()
    {
        return $this->belongsTo(StockItem::class);
    }

    // ── Helper

    // Preço da linha (preco do medicamento × quantidade)
    public function getSubtotalAttribute(): float
    {
        return $this->stockItem->medicamento->preco * $this->quantidade;
    }
}