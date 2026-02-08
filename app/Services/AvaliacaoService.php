<?php 

namespace App\Services;

use App\Repositories\Interfaces\AvaliacaoInterface;

class AvaliacaoService{

    public function __construct(public AvaliacaoInterface $repository){}

    public function createAvaliacao($data){
        return $this->repository->createAvaliacao($data);
    }

    public function updateAvaliacao($id, $data){
        return $this->repository->updateAvaliacao($id, $data);
    }

    public function deleteAvaliacao($id){
        return $this->repository->deleteAvaliacao($id);
    }
}