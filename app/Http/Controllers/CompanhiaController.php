<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CompanhiaController extends Controller
{
    
    public function register(Request $request){
        $data = $request->validated([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|min:6',
        ]);
            
            $data['role'] = 'gestor_farmacia';
            $user = User::create($data);

            $companhia = $user->companhia()->create([
                'nif' => $request->nif,
                'logo' => $request->logo,
                'user_id' => $user->id
            ]);


            $companhia->farmacias()->create([
                'descricao' =>  $request->descricao,
                'nif' => $request->nif,
                'alvara' => $request->alvara,
                'endereco' => $request->endereco,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,

                'companhia_id' => $companhia->id,
                'user_id' => $user->id

            ]);

            // return redirect()->route();
    }

}
