<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function search(Request $request){

        $search = $request->input('query');

        $categorias = Categoria::when($search , function($query , $categoria){
                    $query->where('name' , 'LIKE' , "%{$categoria}%")
                            ->orWhere('descricao' , 'LIKE' , "%{$categoria}%");
        })->paginate(6);

        return view('clientes.dashboard.categoria_resultado' , compact('categorias'));
    }
}
