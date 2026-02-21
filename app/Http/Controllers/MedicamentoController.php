<?php

namespace App\Http\Controllers;

use App\Services\MedicamentoService;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    public function __construct(public MedicamentoService $service ){}

    public function index(Request $request , $perPage = 10)
    {
        $search = $request->input('search');

        $this->service->SearchMedicamento($search, $perPage);

        // return response()->json($medicamentos);
    }


    //list medication comparation with prices in nearby pharmacies
    
}
