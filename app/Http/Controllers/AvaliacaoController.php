<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvaliacaoController extends Controller
{
    public function __construct(public \App\Services\AvaliacaoService $service){}

    public function index(){
        $user = auth()->user();

        if($user->role != 'gestor_farmacia'){ 
            abort(403, 'Acesso negado.');
        }

        $farmaciaId = $user->farmacia_id;
        $avaliacoes = $this->service->getAllAvaliacoesByFarmacia($farmaciaId);

        return view('farmacias.dashboard.avaliacoes', compact('avaliacoes'));
    }

    public function create(Request $request , $id){
        try {
            $request->validate([
            'classificacao' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string|max:255'
        ]);

        // $pedido = Auth::user()->pedidos()->latest()->first();
        $this->service->createAvaliacao(
            $id,
            $request->classificacao,
            $request->comentario
        );

         return response()->json(['success' => true]);
    
        } catch (\Exception $e) {
            return back()->withErrors('Não é possível criar a avaliacao' .$e->getMessage());
        }
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
