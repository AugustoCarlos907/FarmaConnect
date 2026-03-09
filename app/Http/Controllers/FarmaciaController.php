<?php

namespace App\Http\Controllers;

use App\Models\Companhia;
use App\Models\Entregador;
use App\Models\User;
use App\Services\FarmaService;
use App\Services\MedicamentoService;
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
        public FarmaService $farmaService
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
            $entregadorUser = User::create([
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
                'user_id' => $entregadorUser->id,
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

    
    public function dashboard(){
        return view('farmacias.dashboard.index');
    }


    public function EntregadorByFarmacia()
    {
        $user = Auth::user();
        if ($user->role !== 'gestor_farmacia') {
            abort(403, 'Sem permissão');
        }
        $entregadores = Entregador::where('farmacia_id', $user->farmacia_id)
                                    ->get();

        $countEntregadores = $entregadores->count();

        return response()->json([
            'entregadores' => $entregadores,
            'count' => $countEntregadores
        ]);
    }

    //stock
    public function listMedicamentos(){
        $medicamentos = $this->medicamentoService->getMedicamentosByFarmacia(Auth::user()->farmacia_id);
        return view('farmacias.medicamentos.index', compact('medicamentos'));
    }

    public function addMedicamento(){
        return view('farmacias.medicamentos.create');
    }

    public function uploadCsvDoc(){
        return view('farmacias.medicamentos.upload_csv');
    }


    //pedidos



    //Entregadores


    //Relatorios
    public function relatorios(){
        return view('farmacias.relatorios.index');
    }

    public function avaliacoes(){
        return view('farmacias.avaliacoes.index');
    }

    
}