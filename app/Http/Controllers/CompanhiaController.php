<?php

namespace App\Http\Controllers;

use App\Models\Companhia;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class CompanhiaController extends Controller
{
    
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|min:6',
            'nif' => 'required|string',
            'logo' => 'nullable|string'
        ]);

        $companhia = Companhia::create([
            'nif' => $data['nif'],
            'logo' => $data['logo'] ?? null,
        ]);

        // Criar gestor da companhia
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => 'gestor_companhia',
            'companhia_id' => $companhia->id
        ]);

        return response()->json([
            'message' => 'Companhia e gestor criados com sucesso'
        ]);
    }

    public function login(){

    }

    public function registerFarmacia(Request $request)
    {
        $authUser = Auth::user();

        if ($authUser->role !== 'gestor_companhia') {
            abort(403, 'Sem permissão.');
        }

        if (!$authUser->companhia) {
            abort(400, 'Utilizador não possui companhia.');
        }

        $data = $request->validate([
            'descricao' => 'required|string',
            'nif' => 'required|string',
            'alvara' => 'required|string',
            'endereco' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'iban' => 'nullable|string',
            'numero_express' => 'nullable|string',
            // Dados do gestor da farmácia
            'gestor_name' => 'required|string|max:255',
            'gestor_email' => 'required|email|unique:users,email',
            'gestor_password' => 'required|min:6'
        ]);

        //  Criar farmácia
        $farmacia = $authUser->companhia->farmacias()->create([
            'descricao' => $data['descricao'],
            'nif' => $data['nif'],
            'alvara' => $data['alvara'],
            'endereco' => $data['endereco'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'iban' => $data['iban'] ?? null,
            'numero_express' => $data['numero_express'] ?? null,
            'companhia_id' => $authUser->companhia->id,
        ]);

        //  Criar gestor da farmácia
        User::create([
            'name' => $data['gestor_name'],
            'email' => $data['gestor_email'],
            'password' => bcrypt($data['gestor_password']),
            'role' => 'gestor_farmacia',
            'companhia_id' => $authUser->companhia->id,
            'farmacia_id' => $farmacia->id,
        ]);

        return response()->json([
            'message' => 'Farmácia e gestor criados com sucesso'
        ]);
    }



}
