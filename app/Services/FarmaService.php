<?php 

namespace App\Services;

use App\Repositories\Interfaces\FarmaInterface;

class FarmaService{
    public function __construct( public FarmaInterface $repository){}

    public function getAllFarmacias($perPage){
        return $this->repository->getAllFarmacias($perPage);
    }
}