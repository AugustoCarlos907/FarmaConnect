<?php 

namespace App\Repositories;

use App\Models\Medicamento;
use App\Repositories\Interfaces\MedicamentoInterface;

class MedicamentoRepository implements MedicamentoInterface
{
    public function SearchMedicamento($search , $perPage)
    {
        return Medicamento::with('farmacia')
                            ->where('name', 'LIKE', "%{$search}%")
                            ->orWhere('descricao', 'LIKE', "%{$search}%")
                            ->orWhere('principio_ativo', 'LIKE', "%{$search}%")
                            ->groupBy('categoria_id')
                            ->orderBy('dosagem', 'desc')
                            ->paginate($perPage);

    }

    
   
}