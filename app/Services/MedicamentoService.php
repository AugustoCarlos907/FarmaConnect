<?php 

namespace App\Services;

use App\Models\Medicamento;
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

    public function getMedicamentoByCategoria($perPage)
    {
        return $this->repository->getMedicamentoByCategoria($perPage);
    }

    public function createMedicamento(
        $name , 
        $descricao  , 
        $forma_farmaceutica , 
        $dosagem , 
        $categoria_id,
        $quantitade ,
        $preco,
        $dataValidade,
        $lote
        )
    {
        $medicamento =  Medicamento::create([
            'name' => $name,
            'descricao' => $descricao,
            'forma_farmaceutica' => $forma_farmaceutica,
            'dosagem' => $dosagem,
            'categoria_id' => $categoria_id
        ]);

        $medicamento->stockItems()->create([
            'quantidade' => $quantitade,
            'preco' => $preco,
            'data_validade' => $dataValidade,
            'lote' => $lote,
            'ativo' => 1,
            'medicamento_id' => $medicamento->id
        ]);

        return $medicamento;
    }

    public function getMedicamentosByFarmacia($farmaciaId)
    {
        return $this->repository->getMedicamentosByFarmacia($farmaciaId);
    }
}