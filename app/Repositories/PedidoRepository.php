<?php 

namespace App\Repositories;

use App\Models\Pedido;
use App\Repositories\Interfaces\PedidoInterface;

class PedidoRepository implements PedidoInterface{

    //list historic of the orders by pharmacy
    public function getAllPedidosByPharmacy($perPage){
        return Pedido::with('farmacia')
                        ->where('status', 'Concluído')
                        ->orderByDesc('id')
                        ->paginate($perPage);
    }
    
}