<?php

namespace App\Services;

use App\Models\Entrega;
use App\Models\Entregador;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EntregaService
{
    /* ═══════════════════════════════════════════════════════════════════════
     *  HAVERSINE — distância entre dois pontos geográficos (km)
     * ═══════════════════════════════════════════════════════════════════════ */
    public function calcularDistanciaKm(
        float $lat1, float $lng1,
        float $lat2, float $lng2
    ): float {
        if ($lat1 === $lat2 && $lng1 === $lng2) return 0.0;

        $R    = 6371.0;
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) ** 2
           + cos(deg2rad($lat1)) * cos(deg2rad($lat2))
           * sin($dLng / 2) ** 2;

        return round($R * 2 * asin(sqrt($a)), 2);
    }

    /* ═══════════════════════════════════════════════════════════════════════
     *  TAXA DE ENTREGA — modelo profissional (estilo Uber Eats / Glovo)
     *
     *  Fórmula usada pelos maiores sistemas de delivery:
     *
     *    taxa = BASE + (distanciaKm × tarifa_km) + encargo_servico
     *
     *  Com limites mínimo e máximo para proteger o entregador e o cliente.
     *
     *  Referências:
     *    • Glovo (EMEA): base ~250–350 + tarifa ~120–180 Kz/km
     *    • Uber Eats:    base fixa + custo/km + custo/min (omitimos tempo aqui)
     *    • Bolt Food:    base + km progressivo (mais barato para distâncias longas)
     *
     *  Para Angola/Luanda usamos valores calibrados ao mercado local:
     *    • BASE       = 500 Kz  (cobre custo fixo: combustível de arranque, etc.)
     *    • POR KM     = 150 Kz  (progressivo – não há penalização por fracção)
     *    • SERVIÇO    = 5 %     (encargo da plataforma, aplicado sobre subtotal)
     *    • MÍNIMO     = 800 Kz  (garante que vale a pena para o entregador)
     *    • MÁXIMO     = 8000 Kz (tecto para não assustar o cliente em rotas longas)
     *    • BÓNUS MULTI = +200 Kz por farmácia adicional (além da primeira)
     *      para compensar paragens extra
     * ═══════════════════════════════════════════════════════════════════════ */
    public function calcularTaxaEntrega(
        float $distanciaKmTotal,
        int   $numFarmacias = 1
    ): float {
        $base          = 500.00;
        $tarifaPorKm   = 150.00;
        $percentServico = 0.05;   // 5 %
        $minimo        = 800.00;
        $maximo        = 8000.00;
        $bonusFarmacia = 200.00;  // por cada farmácia extra

        /* Custo de deslocação */
        $custoKm = $distanciaKmTotal * $tarifaPorKm;

        /* Bónus de paragens múltiplas */
        $bonusMulti = max(0, $numFarmacias - 1) * $bonusFarmacia;

        /* Subtotal antes do encargo de serviço */
        $subtotal = $base + $custoKm + $bonusMulti;

        /* Encargo de serviço (sobre o subtotal) */
        $encargo = $subtotal * $percentServico;

        $taxa = $subtotal + $encargo;

        /* Aplicar limites */
        $taxa = max($minimo, min($maximo, $taxa));

        return round($taxa, 2);
    }

    /* ═══════════════════════════════════════════════════════════════════════
     *  DISTÂNCIA TOTAL DE UMA ROTA (lista de pontos lat/lng)
     * ═══════════════════════════════════════════════════════════════════════ */
    private function calcularDistanciaRota(array $pontos): float
    {
        $total = 0.0;
        for ($i = 0; $i < count($pontos) - 1; $i++) {
            $total += $this->calcularDistanciaKm(
                (float) $pontos[$i]['lat'],   (float) $pontos[$i]['lng'],
                (float) $pontos[$i+1]['lat'], (float) $pontos[$i+1]['lng']
            );
        }
        return round($total, 2);
    }

    /* ═══════════════════════════════════════════════════════════════════════
     *  ORDENAÇÃO DE FARMÁCIAS — algoritmo do vizinho mais próximo (greedy TSP)
     *
     *  Para N farmácias pequeno (≤ 8) este algoritmo é suficiente e muito
     *  mais rápido do que uma solução exacta (factorial).
     *  Para N > 8 seria necessário usar 2-opt ou OR-Tools.
     * ═══════════════════════════════════════════════════════════════════════ */
    private function ordenarFarmaciasPorProximidade(
        $farmacias,
        array $pontoPartida
    ): array {
        $restantes = $farmacias->map(fn($f) => [
            'id'        => $f->id,
            'nome'      => $f->name,
            'latitude'  => (float) $f->latitude,
            'longitude' => (float) $f->longitude,
        ])->values()->toArray();

        $ordenadas = [];
        $atual     = $pontoPartida;

        while (!empty($restantes)) {
            $idxMaisProximo = 0;
            $menorDist      = INF;

            foreach ($restantes as $idx => $farm) {
                $dist = $this->calcularDistanciaKm(
                    $atual['lat'], $atual['lng'],
                    $farm['latitude'], $farm['longitude']
                );
                if ($dist < $menorDist) {
                    $menorDist      = $dist;
                    $idxMaisProximo = $idx;
                }
            }

            $ordenadas[] = $restantes[$idxMaisProximo];
            $atual = [
                'lat' => $restantes[$idxMaisProximo]['latitude'],
                'lng' => $restantes[$idxMaisProximo]['longitude'],
            ];
            array_splice($restantes, $idxMaisProximo, 1);
            $restantes = array_values($restantes);
        }

        return $ordenadas;
    }

    /* ═══════════════════════════════════════════════════════════════════════
     *  MELHOR ENTREGADOR — minimiza distância total da rota
     *
     *  Critérios (por ordem de prioridade):
     *    1. status = 'Ativo' AND disponivel = true
     *    2. Minimiza: dist(entregador → farm_1 → ... → farm_N → cliente)
     * ═══════════════════════════════════════════════════════════════════════ */
    private function encontrarMelhorEntregador(Pedido $pedido): ?Entregador
    {
        $entregadores = Entregador::where('status', 'Ativo')
            ->where('disponivel', true)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        if ($entregadores->isEmpty()) {
            Log::warning("Nenhum entregador disponível para pedido #{$pedido->id}");
            return null;
        }

        /* Recupera farmácias do pedido (pode ser 1 ou várias) */
        $farmacias = $pedido->farmacias;
        $destino   = ['lat' => (float) $pedido->latitude, 'lng' => (float) $pedido->longitude];

        $melhor         = null;
        $menorDistancia = INF;

        foreach ($entregadores as $entregador) {
            $partida          = ['lat' => (float) $entregador->latitude, 'lng' => (float) $entregador->longitude];
            $farmsOrdenadas   = $this->ordenarFarmaciasPorProximidade($farmacias, $partida);

            /* Constrói array de pontos da rota completa */
            $pontos = [$partida];
            foreach ($farmsOrdenadas as $f) {
                $pontos[] = ['lat' => $f['latitude'], 'lng' => $f['longitude']];
            }
            $pontos[] = $destino;

            $distTotal = $this->calcularDistanciaRota($pontos);

            if ($distTotal < $menorDistancia) {
                $menorDistancia = $distTotal;
                $melhor         = $entregador;
            }
        }

        return $melhor;
    }

    /* ═══════════════════════════════════════════════════════════════════════
     *  CONSTRUIR ROTA DETALHADA
     *
     *  Devolve um array de pontos com metadados (tipo, nome, endereço)
     *  que é guardado em Entrega.rota (JSON) e consumido pelo mapa Leaflet.
     *
     *  Estrutura de cada ponto:
     *    { lat, lng, tipo: 'entregador'|'farmacia'|'cliente', nome, endereco? }
     * ═══════════════════════════════════════════════════════════════════════ */
    private function construirRota(Pedido $pedido, Entregador $entregador): array
    {
        $partida = [
            'lat'     => (float) $entregador->latitude,
            'lng'     => (float) $entregador->longitude,
            'tipo'    => 'entregador',
            'nome'    => 'Minha localização',
            'endereco'=> null,
        ];

        $farmacias       = $pedido->farmacias;
        $farmsOrdenadas  = $this->ordenarFarmaciasPorProximidade(
            $farmacias,
            ['lat' => $partida['lat'], 'lng' => $partida['lng']]
        );

        $destino = [
            'lat'     => (float) $pedido->latitude,
            'lng'     => (float) $pedido->longitude,
            'tipo'    => 'cliente',
            'nome'    => optional($pedido->user)->name ?? 'Cliente',
            'endereco'=> $pedido->endereco,
        ];

        $rota = [$partida];

        foreach ($farmsOrdenadas as $f) {
            $rota[] = [
                'lat'     => $f['latitude'],
                'lng'     => $f['longitude'],
                'tipo'    => 'farmacia',
                'nome'    => $f['nome'],
                'endereco'=> null,
            ];
        }

        $rota[] = $destino;

        return $rota;
    }

    /* ═══════════════════════════════════════════════════════════════════════
     *  CRIAR ENTREGA — ponto de entrada público
     *
     *  Chamado pelo PedidoController quando status → 'pago' e taxa_entrega > 0.
     *
     *  O que faz:
     *    1. Encontra o melhor entregador disponível
     *    2. Constrói a rota optimizada com todos os waypoints
     *    3. Calcula distância total real da rota
     *    4. Calcula taxa de entrega com o modelo profissional
     *    5. Persiste Entrega no BD
     *    6. Marca entregador como Ocupado
     * ═══════════════════════════════════════════════════════════════════════ */
    public function criarEntrega(Pedido $pedido): Entrega
    {
        return DB::transaction(function () use ($pedido) {

            $entregador = $this->encontrarMelhorEntregador($pedido);

            if (!$entregador) {
                throw new \RuntimeException('Nenhum entregador disponível no momento.');
            }

            /* Rota com todos os waypoints */
            $rota = $this->construirRota($pedido, $entregador);

            /* Distância total real da rota (entregador → farms → cliente) */
            $distanciaKm = $this->calcularDistanciaRota(
                array_map(fn($p) => ['lat' => $p['lat'], 'lng' => $p['lng']], $rota)
            );

            /* Número de farmácias na rota (para o bónus de paragens) */
            $numFarmacias = $pedido->farmacias->count();

            /* Taxa de entrega com fórmula profissional */
            $taxaEntrega = $this->calcularTaxaEntrega($distanciaKm, $numFarmacias);

            /* Persistir taxa e distância no pedido para uso posterior */
            $pedido->update([
                'distancia_km' => $distanciaKm,
                'taxa_entrega' => $taxaEntrega,
            ]);

            /* Criar entrega */
            $entrega = Entrega::create([
                'pedido_id'        => $pedido->id,
                'entregador_id'    => $entregador->id,
                'status'           => 'em_transito',
                'endereco_entrega' => $pedido->endereco,
                'distancia_km'     => $distanciaKm,
                'taxa_entrega'     => $taxaEntrega,
                'rota'             => json_encode($rota),   // consumido pelo Leaflet
                'data_saida'       => now(),
            ]);

            /* Marcar entregador como ocupado */
            $entregador->update([
                'status'     => 'Ocupado',
                'disponivel' => false,
            ]);

            Log::info("Entrega #{$entrega->id} criada", [
                'pedido'      => $pedido->id,
                'entregador'  => $entregador->id,
                'farmacias'   => $numFarmacias,
                'distancia'   => $distanciaKm,
                'taxa'        => $taxaEntrega,
            ]);

            return $entrega;
        });
    }

    /* ═══════════════════════════════════════════════════════════════════════
     *  HELPERS DE LEITURA (usados pelo EntregasController)
     * ═══════════════════════════════════════════════════════════════════════ */
    public function entregasConcluidasPorEntregador(int $entregadorId)
    {
        return Entrega::where('entregador_id', $entregadorId)
            ->where('status', 'entregue')
            ->latest()
            ->paginate(10);
    }

    public function entregasEmTransitoPorEntregador(int $entregadorId)
    {
        return Entrega::where('entregador_id', $entregadorId)
            ->where('status', 'em_transito')
            ->latest()
            ->paginate(10);
    }

    public function entregasCanceladasPorEntregador(int $entregadorId)
    {
        return Entrega::where('entregador_id', $entregadorId)
            ->where('status', 'cancelada')
            ->latest()
            ->paginate(10);
    }

    public function getEntregasDeHojeByEntregador(int $entregadorId)
    {
        return Entrega::where('entregador_id', $entregadorId)
            ->where('status', 'entregue')
            ->whereDate('created_at', today())
            ->latest()
            ->paginate(10);
    }

    public function getAllEntregasByEntregador(int $entregadorId)
    {
        return Entrega::where('entregador_id', $entregadorId)
            ->latest()
            ->paginate(10);
    }

    public function getLastEntregasByEntregador(int $entregadorId, int $limit = 4)
    {
        return Entrega::where('entregador_id', $entregadorId)
            ->where('status', 'entregue')
            ->latest()
            ->limit($limit)
            ->get();
    }
}