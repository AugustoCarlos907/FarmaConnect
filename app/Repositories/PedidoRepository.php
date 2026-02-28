<?php 

namespace App\Repositories;

use App\Models\Pedido;
use App\Repositories\Interfaces\PedidoInterface;

class PedidoRepository implements PedidoInterface{

    // Lista todos os pedidos de hoje por farmácia
    public function getPedidosDeHojeByPharmacy($perPage)
    {
        return Pedido::with('farmacia')
            ->where('status', 'Concluído')
            ->whereDate('created_at', now()->toDateString())
            ->orderByDesc('id')
            ->paginate($perPage);
    }
    
    //list historic of the orders by pharmacy
    public function getAllPedidosByPharmacy($perPage){
        return Pedido::with('farmacia')
                        ->where('status', 'Concluído')
                        ->orderByDesc('id')
                        ->paginate($perPage);
    }
    
}