<?php

namespace App\Http\Controllers;

use App\Services\EntregaService;
use Illuminate\Http\Request;

class EntregaController extends Controller
{
    public function __construct(public EntregaService $service){}


    public function concluidasPorEntregador($entregadorId)
    {
        $entregas = $this->service->entregasConcluidasPorEntregador($entregadorId);
        return response()->json($entregas);
    }

    public function emTransitoPorEntregador($entregadorId)
    {
        $entregas = $this->service->entregasEmTransitoPorEntregador($entregadorId);
        return response()->json($entregas);
    }

    public function canceladasPorEntregador($entregadorId)
    {
        $entregas = $this->service->entregasCanceladasPorEntregador($entregadorId);
        return response()->json($entregas);
    }

    public function deHojePorEntregador(Request $request, $entregadorId)
    {
        $entregas = $this->service->entregasDeHojePorEntregador($entregadorId);
        return response()->json($entregas);
    }

    public function getAllEntregasByEntregador(){
        $entrega = $this->service->getAllEntregasByEntregador(10);

        return response()->json($entrega);
    }
}