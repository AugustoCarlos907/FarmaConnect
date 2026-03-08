<?php

namespace App\Http\Controllers;

use App\Models\Companhia;
use App\Models\User;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        //  gestor da companhia
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
            abort(403);
        }

        // Corrigir acesso à companhia (pegar a primeira companhia associada ao usuário)
        $companhia = $authUser->companhia()->first();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'descricao' => 'required|string',
            'nif' => 'required|string',
            'alvara' => 'required|string',
            'alvara_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'endereco' => 'required|string',
            'rua' => 'required|string',
            'bairro' => 'nullable|string',
            'municipio' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'gestor_name' => 'required|string|max:255',
            'gestor_email' => 'required|email|unique:users,email',
            'gestor_password' => 'required|min:6'
        ]);


        DB::transaction(function () use ($data, $companhia) {
            if(request()->hasFile('alvara_file')){
                $path = request()->file('alvara_file')
                        ->store('alvaras', 'public');
                $data['alvara'] = $path;
            }

            $farmacia = $companhia->farmacias()->create([
                'name' => $data['name'],
                // 'descricao' => $data['descricao'],
                'nif' => $data['nif'],
                'alvara' => $data['alvara'] ?? null,
                'endereco' => $data['endereco'],
                'rua' => $data['rua'] ?? null,
                'bairro' => $data['bairro'] ?? null,
                'municipio' => $data['municipio'] ?? null,
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
                'companhia_id' => $companhia->id,
                'iban' => 'IBAN123456789',
                'numero_express' => 'EXP123456789'
            ]);

            User::create([
                'name' => $data['gestor_name'],
                'email' => $data['gestor_email'],
                'password' => bcrypt($data['gestor_password']),
                'role' => 'gestor_farmacia',
                'companhia_id' => $farmacia->companhia->id,
                'farmacia_id' => $farmacia->id,
            ]);
        });

        dd('Farmácia criada com sucesso!');
        // return back()->with('success', 'Farmácia criada com sucesso!');
    }



}
