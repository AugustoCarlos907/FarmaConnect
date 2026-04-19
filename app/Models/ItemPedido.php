<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model
{
    protected $table = 'item_pedidos';
    protected $fillable = [
        'quantidade',
        'preco_unitario',
        'subtotal',
        'stock_items_id',
        'prescricao_path',
        
        'pedido_id',
        'farmacia_id',
        'status_item'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function stockItem()
    {
        return $this->belongsTo(StockItem::class , 'stock_items_id');
    }

    public function farmacia(){
        return $this->belongsTo(Farmacia::class);
    }
    
}
