<?php

namespace App\Http\Controllers;

use App\Models\Entregador;
use Illuminate\Http\Request;

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

    
}
