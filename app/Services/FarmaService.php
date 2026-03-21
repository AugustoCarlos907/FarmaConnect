<?php 

namespace App\Services;

use App\Models\Medicamento;
use App\Models\User;
use App\Models\Farmacia;
use App\Repositories\Interfaces\FarmaInterface;

class FarmaService{
    public function __construct( public FarmaInterface $repository){}

    public function getAllFarmacias($perPage){
        return $this->repository->getAllFarmacias($perPage);
    }

    public function entregadoresByPharmacy($farmaciaId, $perPage){
        return $this->repository->entregadoresByPharmacy($farmaciaId, $perPage);
    }

    public function itemStockByPharmacy($farmaciaId){
        return $this->repository->itemStockByPharmacy($farmaciaId);
    }

    public function listMedicamentosByPharmacy($farmaciaId, $perPage)
    {
        return Medicamento::whereHas('stockItems', function ($q) use ($farmaciaId) {
                $q->where('farmacia_id', $farmaciaId);
            })
            ->with('categoria')
            ->withSum(['stockItems as total_stock' => function ($q) use ($farmaciaId) {
                $q->where('farmacia_id', $farmaciaId);
            }], 'quantidade')
            ->withMin(['stockItems as data_validade' => function ($q) use ($farmaciaId) {
                $q->where('farmacia_id', $farmaciaId);
            }], 'data_validade')
            // ->select('id', 'name', 'preco', 'categoria_id')
            ->paginate($perPage);
    }

    public function getClientes()
    {
        $farmaciaId = auth()->user()->farmacia->id;

        return User::whereHas('pedidos.farmacia', function($q) use ($farmaciaId) {
                $q->where('id', $farmaciaId);
            })
            ->with(['pedidos' => function($q) use ($farmaciaId) {
                // Isto garante que $cliente->pedidos traga APENAS os desta farmácia
                $q->where('farmacia_id', $farmaciaId);
            }])
            ->paginate(10);
    }


    public function getPharmacyDocs(){
        return Farmacia::where('id', auth()->user()->farmacia->id)
                        ->first(['alvara', 'nif' ]);
    }
}