<?php 

namespace App\Services;

use App\Repositories\Interfaces\MedicamentoInterface;

class MedicamentoService
{
    public function __construct(public MedicamentoInterface $repository){}

    public function SearchMedicamento($search , $perPage , $latitude , $longitude, $min_price = null)
    {
        return $this->repository->SearchMedicamento(
            $search ,  
            $perPage , 
            $latitude , 
            $longitude,
            $min_price);
    }
}