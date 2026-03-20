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

        $medicamentos = $this->service->SearchMedicamento(
            $request->$search, 
            $perPage,
            $request->user()->latitude,
            $request->user()->longitude,
            $request->min_price
            );

        return response()->json($medicamentos);
    }


    //list medication comparation with prices in nearby pharmacies
    public function listMedicamentosByCategoria($perPage = 10)
    {
        $medicamentos = $this->service->getMedicamentoByCategoria($perPage);

        return response()->json($medicamentos);
    }

        public function create(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'descricao' => 'required|string',
                'forma_farmaceutica' => 'required|string',
                'dosagem' => 'required|string',
                'categoria_id' => 'required|integer|exists:categorias,id',
                'quantidade' => 'required|integer|min:1',
                'preco' => 'required|numeric|min:0',
                'data_validade' => 'required|date',
                'lote' => 'nullable|string|max:255',
                // 'farmacia_id' => 'required|integer|exists:farmacias,id',
                // 'ativo' => 'required|boolean'

            ]);
    
            $medicamentos = $this->service->createMedicamento(
                $validatedData['name'],
                $validatedData['descricao'],
                $validatedData['forma_farmaceutica'],
                $validatedData['dosagem'],
                $validatedData['categoria_id'],
                $validatedData['quantidade'],
                $validatedData['preco'],
                $validatedData['data_validade'],
                $validatedData['lote'] ?? null,
            );
    
            return redirect()->route('medicamentos.farmacias');
        }
}
