<?php 

namespace App\Services;

use App\Models\Entrega;
use App\Models\Entregador;
use App\Models\Pedido;
use DB;

class EntregaService{

    // Entregas concluídas
    public function entregasConcluidasPorEntregador($entregadorId, $perPage = 10) {
        return Entrega::where('status', 'concluída')
            ->where('entregador_id', $entregadorId)
            ->orderByDesc('id')
            ->paginate($perPage);
    }

    public function entregasEmTransitoPorEntregador($entregadorId, $perPage = 10) {
        return Entrega::where('status', 'em transito')
            ->where('entregador_id', $entregadorId)
            ->orderByDesc('id')
            ->paginate($perPage);
    }

    public function entregasCanceladasPorEntregador($entregadorId, $perPage ) {
        return Entrega::where('status', 'cancelada')
            ->where('entregador_id', $entregadorId)
            ->orderByDesc('id')
            ->paginate($perPage);
    }

    // Entregas de hoje por entregador
    public function getEntregasDeHojeByEntregador($entregadorId, $perPage ) {
        return Entrega::where(function($query) use ($entregadorId) {
                $query->where('entregador_id', $entregadorId)
                      ->where('status', 'concluída');
            })
            ->whereDate('created_at', now()->toDateString())
            ->orderByDesc('id')
            ->paginate($perPage);
    }

    public function getAllEntregasByEntregador($perPage){
        return Entrega::with('entregador')
                        ->orderByDesc('id')
                        ->get();
    }

    public function getLastEntregasByEntregador($entregadorId, $limit) {
        return Entrega::where('entregador_id', $entregadorId)
            ->orderByDesc('id')
            ->limit($limit)
            ->get();
    }

    
    // Cálculo da taxa de entrega com base na distância
    public function calcularTaxaEntrega(float $distanciaKm): float
    {
        $taxaBase = 200.00; // Taxa base fixa
        $custoPorKm = 1.00; // Custo adicional por km

        return $taxaBase + ($custoPorKm * $distanciaKm);
    }



    public function criarEntrega(Pedido $pedido)
    {
        return DB::transaction(function () use ($pedido) {

            if($pedido['status'] !== 'Aprovado'){
            throw new \Exception('Pedido não está pronto para entrega');
            }

            $entregador = $this->buscarEntregadorDisponivel($pedido);

            $entrega = Entrega::create([
                'pedido_id' => $pedido->id,
                'entregador_id' => $entregador?->id,
                'status' => $entregador ? 'entregue' : 'pendente',
                'endereco_entrega' => $pedido->endereco,
                'latitude' => $pedido->latitude,
                'longitude' => $pedido->longitude,
            ]);

            if ($entregador) {
                $entregador->update(['status' => 'ocupado']);
            }

            return $entrega;
        });
    }

     private function buscarEntregadorDisponivel(Pedido $pedido)
    {
        return Entregador::where('farmacia_id', $pedido->farmacia_id)
            ->where('status', 'Ativo')
            ->where('disponivel', true)
            ->orderBy('created_at') // depois podemos melhorar para geolocalização
            ->first();
    }
    
}