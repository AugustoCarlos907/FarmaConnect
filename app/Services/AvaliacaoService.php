<?php 

namespace App\Services;

use App\Models\Avaliacao;
use App\Models\Entrega;
use App\Repositories\Interfaces\AvaliacaoInterface;

class AvaliacaoService{

    public Entrega $entrega;
    
    public function __construct(public AvaliacaoInterface $repository){}

    public function getAllAvaliacoesByFarmacia($farmaciaId){
        return $this->repository->getAllAvaliacoesByFarmacia($farmaciaId);
    }
    // public function createAvaliacao($data){
    //     return $this->repository->createAvaliacao($data);
    // }

    public function updateAvaliacao($id, $data){
        return $this->repository->updateAvaliacao($id, $data);
    }

    public function deleteAvaliacao($id){
        return $this->repository->deleteAvaliacao($id);
    }

    public function createAvaliacao($id, $classificacao, $comentario){
        $entrega =  $this->entrega = Entrega::find($id);

        if($entrega->status == 'entregue'){
            
            $avaliacao = Avaliacao::create([
                'classificacao' => $classificacao,
                'comentario' => $comentario,
                'farmacia_id' => $entrega->pedido->farmacia_id,
                'user_id' => auth()->id()
            ]);

        return $avaliacao;
        }

        throw new \Exception('Entrega não foi concluída, não é possível avaliar a farmácia.');
    }

    public function latestAvaliacoes($limit ){
        return Avaliacao::where('farmacia_id', auth()->user()->farmacia_id)
                        ->orderBy('created_at', 'desc')
                        ->limit($limit)
                        ->get();
    }

    public function allAvaliacoesByFarmacia($farmaciaId){
        return Avaliacao::where('farmacia_id', $farmaciaId)
                        ->orderBy('created_at', 'desc')
                        ->get();
    }

}