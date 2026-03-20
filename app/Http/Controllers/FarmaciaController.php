<?php

namespace App\Http\Controllers;

use App\Models\Companhia;
use App\Models\Entregador;
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
    public function listMedicamentos(){
        $medicamentos = $this->farmaService->listMedicamentosByPharmacy(Auth::user()->farmacia_id, 10);
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


    
}