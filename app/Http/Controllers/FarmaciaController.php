<?php

namespace App\Http\Controllers;

use App\Models\Companhia;
use App\Models\Entregador;
use App\Models\Farmacia;
use App\Models\Medicamento;
use App\Models\User;
use App\Services\FarmaService;
use App\Services\MedicamentoService;
use App\Services\PedidoService;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FarmaciaController extends Controller
{
    //list all pharmacies next to me with all detaills (avaluations and etc)
    //by long and lat
    public function __construct(
        public MedicamentoService $medicamentoService,
        public FarmaService $farmaService,
        public PedidoService $pedidoService
    ){}

    public function registerEntregadores(Request $request)
    {
        $user = Auth::user();

    
        if ($user->role !== 'gestor_farmacia') {
            abort(403, 'Sem permissão');
        }

        if (!$user->farmacia_id) {
            abort(400, 'Gestor não possui farmácia associada');
        }

    
        $data = $request->validate([
            
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',

            //  entregador
            'descricao' => 'nullable|string',
            'numero_bi' => 'nullable|string|unique:entregadores,numero_bi',
            'matricula_veiculo' => 'nullable|string',
            'foto_perfil' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        DB::beginTransaction();

        try {

            //   utilizador
            $entregador = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'entregador',
            ]);

            //   entregador
            $user->farmacia->entregadores()->create([
                'descricao' => $data['descricao'] ?? null,
                'numero_bi' => $data['numero_bi'] ?? null,
                'matricula_veiculo' => $data['matricula_veiculo'] ?? null,
                'foto_perfil' => $data['foto_perfil'] ?? null,
                'latitude' => $data['latitude'] ?? null,
                'longitude' => $data['longitude'] ?? null,
                'farmacia_id' => $user->farmacia_id,
                'user_id' => $entregador->id,
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Entregador criado com sucesso'
            ], 201);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'error' => 'Erro ao criar entregador',
                'details' => $e->getMessage()
            ], 500);
        }
    }

       

    //stock
    // public function listMedicamentos(){
    //     $medicamentos = $this->farmaService->listMedicamentosByPharmacy(Auth::user()->farmacia_id, 10);
    //     return view('farmacias.dashboard.medicamentos', compact('medicamentos'));
    // }

    public function listMedicamentos(Request $request)
    {
        $farmaciaId = Auth::user()->farmacia_id;

        // 1. Query base (sem paginar ainda)
        $query = Medicamento::whereHas('stockItems', function ($q) use ($farmaciaId) {
            $q->where('farmacia_id', $farmaciaId);
        })
        ->with('categoria')
        ->withSum(['stockItems as total_stock' => function ($q) use ($farmaciaId) {
            $q->where('farmacia_id', $farmaciaId);
        }], 'quantidade')
        ->withMin(['stockItems as data_validade' => function ($q) use ($farmaciaId) {
            $q->where('farmacia_id', $farmaciaId);
        }], 'data_validade');

        // 2. Filtro por pesquisa (nome)
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 3. Filtro por categoria
        if ($request->filled('categoria')) {
            $query->whereHas('categoria', function($q) use ($request) {
                $q->where('name', $request->categoria);
            });
        }

        // 4. Filtro por stock (usando having na subconsulta)
        if ($request->filled('stock')) {
            $stockFilter = $request->stock;
            if ($stockFilter == 'ok') {
                $query->having('total_stock', '>=', 20);
            } elseif ($stockFilter == 'low') {
                $query->havingBetween('total_stock', [8, 19]);
            } elseif ($stockFilter == 'critical') {
                $query->havingBetween('total_stock', [1, 7]);
            } elseif ($stockFilter == 'out') {
                $query->having('total_stock', 0);
            }
        }

        // 5. Ordenação
        if ($request->filled('sort')) {
            $sort = explode('-', $request->sort);
            $key = $sort[0];
            $dir = $sort[1] ?? 'asc';
            if ($key == 'name') {
                $query->orderBy('name', $dir);
            } elseif ($key == 'price') {
                $query->orderBy('preco', $dir);
            } elseif ($key == 'stock') {
                $query->orderBy('total_stock', $dir);
            }
        } else {
            // Ordenação padrão por nome
            $query->orderBy('name', 'asc');
        }

        // 6. Paginar (depois de todos os filtros)
        $medicamentos = $query->paginate(20)->appends($request->query());

        return view('farmacias.dashboard.medicamentos', compact('medicamentos'));
    }

    public function addMedicamento(){
        return view('farmacias.medicamentos.create');
    }

    public function uploadCsvDoc(){
        return view('farmacias.medicamentos.upload_csv');
    }


    //pedidos

    public function pedidos($perPage = 10)
    {
        $pedidos = $this->pedidoService->getAllPedidosByPharmacy($perPage);
        $pedidosHoje = $this->pedidoService->getPedidosDeHojeByPharmacy($perPage);
        $countPedidos = $pedidos->count();

        return view('farmacias.dashboard.pedidos', compact('pedidos', 'countPedidos', 'pedidosHoje'));
    }

    //Entregadores
    public function entregadores($perPage = 10){

        $farmaId = Auth::user()->farmacia_id;
        
        Entregador::doesntHave('entregas')->update([
        'status' => 'Ativo',
        'disponivel' => true]);
        
        $entregadores = $this->farmaService->entregadoresByPharmacy($farmaId, $perPage);
        return view('farmacias.dashboard.entregadores', compact('entregadores'));
    }

    //Clientes
    public function clientes(){
        $clientes = $this->farmaService->getClientes();

        return view('farmacias.dashboard.clientes' , compact('clientes'));
    }
    
    //avaliacoes
    // public function avaliacoes(){
    //     return view('farmacias.dashboard.avaliacoes');
    // }

    
    //documentos
    public function documentos(){
        $documentos = $this->farmaService->getPharmacyDocs();
        return view('farmacias.dashboard.documentos' , compact('documentos'));
    }

    //Relatorios
    public function relatorios(){
        return view('farmacias.relatorios.index');
    }


    public function search(Request $request){

        $search = $request->input('query');

        // $farmacias = Farmacia::when($search, function ($query, $search) {
        //                         return $query->where('name', 'LIKE', "%{$search}%")
        //                                     ->orWhere('descricao', 'LIKE', "%{$search}%"); 
        //                     })->paginate(6);

        $farmacias = Farmacia::where(function ($query) use  ($search){
                                 $query->where('name', 'LIKE', "%{$search}%")
                                            ->orWhere('bairro', 'LIKE', "%{$search}%")
                                            ->orWhere('descricao', 'LIKE', "%{$search}%");
                            })->paginate(6);
                                   
        return view('clientes.dashboard.farmacias_resultado' , compact('farmacias'));
    }
    
}