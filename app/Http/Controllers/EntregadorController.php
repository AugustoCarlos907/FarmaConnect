<?php

namespace App\Http\Controllers;

use App\Models\Entregador;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EntregadorController extends Controller
{
    




    public function ganhos(){
        return view('entregadores.dashboard.ganhos');
    }
    public function relatorios(){
        return view('entregadores.relatorios.index');
    }

    public function perfil($id){
        $entregador = Entregador::where('user_id' , $id)->firstOrFail();
        return view('entregadores.dashboard.perfil' , ['entregador' => $entregador]);
    }

    public function avaliacoes(){
        return view('entregadores.dashboard.avaliacoes');
    }

    public function updateStatus(Request $request)
    {
    $entregador = Auth::user()->entregador;
    $entregador->update([
        'status' => $request->status,
        'disponivel' => $request->disponivel
    ]);
    return response()->json(['ok' => true]);
    }

    public function atualizarLocalizacao(Request $request)
    {
        $request->validate([
            'latitude'  => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $entregador = Auth::user()->entregador; 

        if (!$entregador) {
            return response()->json(['error' => 'Perfil de entregador não encontrado.'], 404);
        }

        $entregador->update([
            'latitude'  => $request->latitude,
            'longitude' => $request->longitude,
            'ultima_atividade' => Carbon::now(), 
        ]);

        return  $entregador;
        }
    
}
