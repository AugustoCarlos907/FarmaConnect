<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function search(Request $request){

        $search = $request->input('query');

        $categoria = Categoria::when($search , function($query , $categoria){
                    $query->where('name' , 'LIKE' , "%{$categoria}%")
                            ->orWhere('descricao' , 'LIKE' , "%{$categoria}%");
        })->paginate(6);

        return response()->json($categoria);
    }
}
