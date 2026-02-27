<?php

namespace App\Http\Controllers;

use App\Models\Companhia;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FarmaciaController extends Controller
{
    //list all pharmacies next to me with all detaills (avaluations and etc)
    //by long and lat

public function registerEntregadores(Request $request)
{
    $user = Auth::user();

    // Permissão
    if ($user->role !== 'gestor_farmacia') {
        abort(403, 'Sem permissão');
    }

    if (!$user->farmacia_id) {
        abort(400, 'Gestor não possui farmácia associada');
    }

    //  Validação
    $data = $request->validate([
        // Dados do utilizador (login do entregador)
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',

        // Dados do entregador
        'descricao' => 'nullable|string',
        'numero_bi' => 'nullable|string|unique:entregadores,numero_bi',
        'matricula_veiculo' => 'nullable|string',
        'foto_perfil' => 'nullable|string',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
    ]);

    DB::beginTransaction();

    try {

        //  Criar utilizador
        $entregadorUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'entregador',
        ]);

        //  Criar entregador
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

}