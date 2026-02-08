<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    public function __construct(public \App\Services\AvaliacaoService $service){}

    public function create(Request $request){
        $data = $request->validated();

        $this->service->createAvaliacao($data);

        return response()->json(['message' => 'Avaliação criada com sucesso!'], 201);
    }

    public function update(Request $request, $id){
        $data = $request->validated();

        $this->service->updateAvaliacao($id, $data);

        return response()->json(['message' => 'Avaliação atualizada com sucesso!']);
    }

    public function delete($id){
        $this->service->deleteAvaliacao($id);
        
        return response()->json(['message' => 'Avaliação deletada com sucesso!']);
    }
}
