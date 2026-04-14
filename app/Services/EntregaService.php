<?php 

namespace App\Services;

use App\Models\Entrega;
use App\Models\Entregador;
use App\Models\Pedido;
use DB;
use Exception;
use Illuminate\Support\Facades\Auth;

class EntregaService{

    // Entregas concluídas
    public function entregasConcluidasPorEntregador($entregadorId) {
        return Entrega::where('status', 'entregue')
            ->where('entregador_id', $entregadorId)
            ->orderByDesc('id')
            ->paginate(10);
    }

    public function entregasEmTransitoPorEntregador($entregadorId) {
        return Entrega::where('status', 'em transito')
            ->where('entregador_id', $entregadorId)
            ->orderByDesc('id')
            ->paginate(10);
    }

    public function entregasCanceladasPorEntregador($entregadorId ) {
        return Entrega::where('status', 'cancelada')
            ->where('entregador_id', $entregadorId)
            ->orderByDesc('id')
            ->paginate(10);
    }

    // Entregas de hoje por entregador
    public function getEntregasDeHojeByEntregador($entregadorId ) {
        return Entrega::where(function($query) use ($entregadorId) {
                $query->where('entregador_id', $entregadorId)
                      ->where('status', 'entregue');
            })
            ->whereDate('created_at', now()->toDateString())
            ->orderByDesc('id')
            ->paginate(10);
    }

    public function getAllEntregasByEntregador(){
        return Entrega::where('entregador_id' , Auth::user()->id)
                        ->orderByDesc('id')
                        ->paginate(10);
    }

    public function getLastEntregasByEntregador($entregadorId) {
        return Entrega::where(function($query) use ($entregadorId){
            $query->where('entregador_id', $entregadorId)
                  ->where('status' , 'entregue');
        })->orderByDesc('id')
          ->limit(4)
          ->get();
    }

        
    /**
     * Calcula a distância em km entre dois pontos geográficos
     * usando a fórmula de Haversine.
     */
    public function calcularDistanciaKm(
        float $lat1, float $lng1,
        float $lat2, float $lng2
    ): float {
        $raioTerra = 6371; // km

        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) ** 2
        + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLng / 2) ** 2;

        $c = 2 * asin(sqrt($a));

        return round($raioTerra * $c, 2); // arredonda a 2 casas decimais
    }

    /**
     * Calcula a taxa de entrega com base na distância.
     * Regra: 300 Kz por cada 16 km (ou fracção).
     */
    public function calcularTaxaEntrega(float $distanciaKm): float
    {
        $taxaBase   = 1100.00;   // Kz por bloco de 16 km
        $blocoKm    = 16.0;
        $blocos     = ceil($distanciaKm / $blocoKm); // arredonda para cima

        return $taxaBase * max(1, $blocos); // mínimo 1 bloco mesmo que seja 0 km
    }

    /**
     * Cria a entrega, calcula distância e taxa automaticamente
     * a partir das coordenadas do endereço do pedido e da farmácia.
     */
    public function criarEntrega($pedido)
    {
        return DB::transaction(function () use ($pedido) {

            $entregador = $this->buscarEntregadorDisponivel($pedido);

            // if (!$entregador) {
            //     throw new \Exception(
            //         'Pedido recebido, mas sem entregador disponível no momento. Aguardando!'
            //     );
            // }

            // ── Coordenadas do endereço de entrega (do pedido)
            $endLat = $pedido->latitude  ?? $pedido->endereco_lat  ?? null;
            $endLng = $pedido->longitude ?? $pedido->endereco_lng  ?? null;

            // ── Coordenadas da farmácia
            $farmacia   = $pedido->farmacia;
            $farmLat    = $farmacia->latitude  ?? null;
            $farmLng    = $farmacia->longitude ?? null;

            // ── Cálculo (só se ambos os pontos estiverem disponíveis) 
        // Usa os valores já guardados no pedido (calculados no front)
        $distanciaKm = $pedido->distancia_km ?? 0;
        $taxaEntrega = $pedido->taxa_entrega ?? 0;


            // if ($endLat && $endLng && $farmLat && $farmLng) {
            //     $distanciaKm = $this->calcularDistanciaKm(
            //         (float) $farmLat, (float) $farmLng,
            //         (float) $endLat,  (float) $endLng
            //     );
            //     $taxaEntrega = $this->calcularTaxaEntrega($distanciaKm);
            // }

            // ── Criar a entrega 
            $entrega = Entrega::create([
                'pedido_id'        => $pedido->id,
                'entregador_id'    => $entregador->id,
                'status'           => 'em_transito',
                'endereco_entrega' => $pedido->endereco,
                'distancia_km'     => $distanciaKm,
                'taxa_entrega'     => $taxaEntrega ,
                'data_saida'       => now(),
            ]);


            $entregador->update(['status' => 'Ocupado']);

            return $entrega;
        });
    }

    public function criarRetirada($pedido)
    {
        return Entrega::create([
            'pedido_id'        => $pedido->id,
            'status'           => 'retirada',
            'taxa_entrega'     => 0,
            'distancia_km'     => 0,
            'endereco_entrega' => $pedido->farmacia->endereco,
            'data_saida'       => null, // ou now()
        ]);

    }

     private function buscarEntregadorDisponivel($pedido)
    {
        return Entregador::where('farmacia_id', $pedido->farmacia_id)
            ->where('status', 'Ativo')
            ->where('disponivel', true)
            ->orderBy('created_at') 
            ->first();
    }
    
}