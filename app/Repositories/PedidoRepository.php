<?php 

namespace App\Repositories;

use App\Models\Pedido;
use App\Repositories\Interfaces\PedidoInterface;
use Illuminate\Support\Facades\Auth;

class PedidoRepository implements PedidoInterface{

    // Lista todos os pedidos de hoje por farmácia
    public function getPedidosDeHojeByPharmacy($perPage)
    {
        return Pedido::where('farmacia_id' , Auth::user()->farmacia_id )
            ->whereDate('created_at', now()->toDateString())
            ->orderByDesc('id')
            ->paginate($perPage);
    }
    
    //list historic of the orders by pharmacy
    public function getAllPedidosByPharmacy($perPage){
        return Pedido::where('farmacia_id' , Auth::user()->farmacia_id)
                        ->orderByDesc('id')
                        ->paginate($perPage);
    }
    
}