<?php

namespace App\Http\Controllers;

use App\Services\EntregaService;
use Illuminate\Http\Request;

class EntregaController extends Controller
{
    public function __construct(public EntregaService $service){}

    
    public function getAllEntregasByEntregador(){
        $entrega = $this->service->getAllEntregasByEntregador(10);

        return response()->json(200);
    }
}