<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Farmacia;
use App\Services\AvaliacaoService;
use App\Services\CategoriaService;
use App\Services\EntregaService;
use App\Services\FarmaService;
use App\Services\MedicamentoService;
use App\Services\PedidoService;
use Illuminate\Http\Request;

class ClientHomePageController extends Controller
{
    public function __construct(
        public MedicamentoService $medicamentoService,
        public PedidoService $pedidoService,
        public EntregaService $entregaService,
        public AvaliacaoService $avaliacaoService,
        public FarmaService $farmaService,
        public CategoriaService $categoriaService

    ){}



    public function farmacias($perPage = 6)
    {

        $farmacias = $this->farmaService->getAllFarmacias($perPage );

        $farmaDestaque = Farmacia::withAvg('avaliacoes', 'classificacao')
            ->having('avaliacoes_avg_classificacao', '>', 2.5)
            ->get();
                                    
        return view('clientes.dashboard.farmacias', [
            'farmacias' => $farmacias,
            'farmaDestaque' => $farmaDestaque
        ]);
    }

    public function produtos()
    {
        $categorias = Categoria::with('medicamentos')->paginate(12);

        return view('clientes.dashboard.produtos' , ['categorias'=>$categorias]);
    }

    public function produtosPorCategoria($id)
    {
           $categoria = Categoria::with(['medicamentos.stockItems.farmacia' ])
                                 ->findOrFail($id);

            return view('clientes.dashboard.produtos_categoria', [
                'categoria' => $categoria
            ]);    
    }

    public function searchCategorias(Request $request)
    {
            $query = $request->input('query');
            $categorias = $this->categoriaService->searchCategoria($query);
    
            return view('clientes.dashboard.produtos' , ['categorias'=>$categorias]);
    }

}