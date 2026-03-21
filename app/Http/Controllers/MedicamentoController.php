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
        $minPrice = $request->input('min_price');

        // Obter latitude/longitude do usuário autenticado (supondo que existam no user)
        $user = $request->user();
        $userLat = $user->latitude ?? null;
        $userLng = $user->longitude ?? null;

        // Se não tiver localização, podemos usar um valor padrão (ex: Luanda)
        if (is_null($userLat) || is_null($userLng)) {
            $userLat = -8.8383; // coordenadas de exemplo (Luanda)
            $userLng = 13.2344;
        }

        $medicamentos = $this->service->SearchMedicamento(
            $search, 
            $perPage,
            $userLat,
            $userLng,
            $minPrice
            );

        return view('clientes.dashboard.produto_resultado' , compact('medicamentos'));
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
