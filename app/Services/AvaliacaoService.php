<?php 

namespace App\Services;

use App\Models\Avaliacao;
use App\Models\Entrega;
use App\Repositories\Interfaces\AvaliacaoInterface;

class AvaliacaoService{

    
    public function __construct(public AvaliacaoInterface $repository, public Entrega $entrega){}

    // public function createAvaliacao($data){
    //     return $this->repository->createAvaliacao($data);
    // }

    public function updateAvaliacao($id, $data){
        return $this->repository->updateAvaliacao($id, $data);
    }

    public function deleteAvaliacao($id){
        return $this->repository->deleteAvaliacao($id);
    }

    public function createAvaliacao($classificacao, $comentario){
        if($this->entrega->status == 'entregue'){
            
            $avaliacao = Avaliacao::create([
                'classificacao' => $classificacao,
                'comentario' => $comentario,
                'farmacia_id' => $this->entrega->pedido->farmacia_id,
                'user_id' => $this->entrega->pedido->user_id
            ]);

        return $avaliacao;
        }

        throw new \Exception('Entrega não foi concluída, não é possível avaliar a farmácia.');
    }
}