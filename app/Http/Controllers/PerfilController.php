<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Auth;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    //     public function perfil()
    // {
    //     $user = auth()->user();

    //     return view('clientes.perfil.index', ['user' => $user]);
    // }
    public function UserProfile(){
        $user = Auth::user();
        $endereco = Endereco::where('user_id',$user->id )->first();

        return view('clientes.perfil.index' , [
            'endereco' => $endereco,
            'user' => $user
            ]);
    }
}
