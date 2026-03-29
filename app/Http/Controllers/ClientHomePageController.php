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



    public function produtosPorCategoria(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        $query = $categoria->medicamentos()->with(['stockItems.farmacia']);

        // Filtro de preço
        if ($request->filled('preco_min')) {
            $query->where('preco', '>=', $request->preco_min);
        }
        // if ($request->filled('preco_max')) {
        //     $query->where('preco', '<=', $request->preco_max);
        // }

        // Filtro "em stock" – exige stock_items com quantidade > 0
        if ($request->boolean('em_stock')) {
            $query->whereHas('stockItems', function($q) {
                $q->where('quantidade', '>', 0)->where('ativo', 1);
            });
        }

        // Filtro "com desconto" – se existir campo preco_desconto
        // if ($request->boolean('com_desconto')) {
        //     $query->whereNotNull('preco_desconto')->where('preco_desconto', '>', 0);
        // }

        // Filtro "sem receita médica" – assumindo campo requer_receita = false
        if ($request->boolean('sem_receita')) {
            $query->where('requer_receita', false);
        }

        // Filtro por farmácias
        if ($request->filled('farmacias')) {
            $farmaciaIds = $request->farmacias;
            $query->whereHas('stockItems', function($q) use ($farmaciaIds) {
                $q->whereIn('farmacia_id', $farmaciaIds);
            });
        }

        // Ordenação
        switch ($request->get('sort', 'default')) {
            case 'preco_az':
                $query->orderBy('preco', 'asc');
                break;
            case 'preco_za':
                $query->orderBy('preco', 'desc');
                break;
            case 'name_az':
                $query->orderBy('name', 'asc');
                break;
            case 'novo':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('id', 'desc');
        }

        $medicamentos = $query->paginate(10);

        return view('clientes.dashboard.produtos_categoria', [
            'categoria'    => $categoria,
            'medicamentos' => $medicamentos
        ]);
    }

    public function searchCategorias(Request $request)
    {
            $query = $request->input('query');
            $categorias = $this->categoriaService->searchCategoria($query);
    
            return view('clientes.dashboard.produtos' , ['categorias'=>$categorias]);
    }

    

}