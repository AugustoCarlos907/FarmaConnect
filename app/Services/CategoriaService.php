<?php 

namespace App\Services;

use App\Models\Categoria;

class CategoriaService{
    
    public function searchCategoria($query){
        return Categoria::where('name', 'LIKE', "%$query%")
                        ->orWhere('descricao', 'LIKE', "%$query%")
                        ->get();
    }
}