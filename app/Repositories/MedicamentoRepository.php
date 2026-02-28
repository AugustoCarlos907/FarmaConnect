<?php 

namespace App\Repositories;

use App\Models\Medicamento;
use App\Models\StockItem;
use App\Repositories\Interfaces\MedicamentoInterface;

class MedicamentoRepository implements MedicamentoInterface
{
public function searchMedicamento($search, $perPage, $userLat, $userLng , $min_price = null)
{
    $distanceFormula = "
        (6371 * acos(
            cos(radians(?)) *
            cos(radians(farmacias.latitude)) *
            cos(radians(farmacias.longitude) - radians(?)) +
            sin(radians(?)) *
            sin(radians(farmacias.latitude))
        ))";

        $query = StockItem::selectRaw("
                stock_items.*,
                {$distanceFormula} AS distancia
            ", [$userLat, $userLng, $userLat])
            ->join('medicamentos', 'stock_items.medicamento_id', '=', 'medicamentos.id')
            ->join('farmacias', 'stock_items.farmacia_id', '=', 'farmacias.id')
            ->where('stock_items.quantidade', '>', 0)
            ->where('stock_items.ativo', 1)
            ->where(function ($query) use ($search) {
                $query->where('medicamentos.name', 'LIKE', "%{$search}%")
                      ->orWhere('medicamentos.descricao', 'LIKE', "%{$search}%")
                      ->orWhere('medicamentos.principio_ativo', 'LIKE', "%{$search}%");
            });

        if (!is_null($min_price)) {
            $query->where('stock_items.preco', '>=', $min_price);
        }

        return $query
            ->orderBy('distancia', 'asc')
            ->orderBy('stock_items.preco', 'asc')
            ->with(['medicamento', 'farmacia'])
            ->paginate($perPage);
}

    
   public function getMedicamentoByCategoria($perPage)
   {
        return Medicamento::with('categoria')
                            ->orderBy('name')
                            ->paginate($perPage);
   }
}