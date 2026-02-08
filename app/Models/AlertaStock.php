<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlertaStock extends Model
{
    protected $fillable = [
        'stock_items_id',
        'tipo',
        'mensagem',
    ];

    public function stockItem()
    {
        return $this->belongsTo(StockItem::class, 'stock_items_id');
    }
}
