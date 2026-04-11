<?php 

namespace App\Services;

use App\Models\Medicamento;
use App\Repositories\Interfaces\MedicamentoInterface;
use Illuminate\Support\Facades\Auth;

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
        $lote,
        $requerReceita,
        $dataFabricacao = null, 
        $laboratorio = null, 
        $origem = null 
        ){

        $medicamento =  Medicamento::create([
            'name' => $name,
            'descricao' => $descricao,
            'preco' => $preco,
            'forma_farmaceutica' => $forma_farmaceutica,
            'dosagem' => $dosagem,
            'categoria_id' => $categoria_id,
            'requer_receita' => $requerReceita,
            'data_fabricacao' => $dataFabricacao,
            'laboratorio' => $laboratorio,
            'origem' => $origem
        ]);

        $medicamento->stockItems()->create([
            'quantidade' => $quantitade,
            'preco' => $preco,
            'data_validade' => $dataValidade,
            'lote' => $lote ?? 'UNKNOWN',
            'medicamento_id' => $medicamento->id,
            'farmacia_id' => Auth::user()->farmacia_id
            // 'ativo' => 1,
        ]);

        return $medicamento;
    }

    public function getMedicamentosByFarmacia($farmaciaId)
    {
        return $this->repository->getMedicamentosByFarmacia($farmaciaId);
    }
}