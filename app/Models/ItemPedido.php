<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model
{
    protected $fillable = [
        'quantidade',
        'preco_unitario',
        'subtotal',
        
        'pedido_id',
        'stock_item_id',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function stockItem()
    {
        return $this->belongsTo(StockItem::class);
    }

    
}
