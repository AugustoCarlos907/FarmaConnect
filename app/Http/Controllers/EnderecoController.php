<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnderecoController extends Controller
{
    public function index(){
        return view('clientes.perfil.enderecos_map');
    }

    public function create(Request $request){
        $data = $request->validate([
            'name'=> 'required|string',
            'latitude'=> 'required',
            'longitude'=> 'required',
            'endereco' => 'required|string'
            ]);
            
        $data['user_id'] = Auth::user()->id;

        Endereco::create($data);

        return redirect()->route('perfil.clientes');
    }

    public function destroy($id){
        $endereco = Endereco::findOrFail($id);

        $endereco->delete();

        return redirect()->back()->with('success' , 'EndereÇo eliminado com sucesso');
    }
}
