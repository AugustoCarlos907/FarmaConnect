<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntregadorController extends Controller
{
    


    public function entregas(){
        return view('entregadores.entregas.index');
    }

    public function relatorios(){
        return view('entregadores.relatorios.index');
    }

    public function perfil(){
        return view('entregadores.perfil.index');
    }

    
}
