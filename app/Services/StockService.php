<?php 

namespace App\Services;

use App\Models\Medicamento;
use App\Models\StockItem;
use Illuminate\Support\Facades\Auth;


class StockService { 
    // public function __construct(
    //     public StockItem $stockItem
    // ){}


    public function statusStocks()
    {
        $farmaciaId = Auth::user()->farmacia_id;
        
        // Obter todos os medicamentos com sum do stock
        $medicamentos = Medicamento::whereHas('stockItems', function($q) use ($farmaciaId) {
            $q->where('farmacia_id', $farmaciaId);
        })->withSum(['stockItems as total_stock' => function($q) use ($farmaciaId) {
            $q->where('farmacia_id', $farmaciaId);
        }], 'quantidade')
        ->get(['id', 'name']); // Buscar apenas campos necessários
        
        // Contar por status usando collection
        $normal = $medicamentos->filter(function($item) {
            return ($item->total_stock ?? 0) >= 20;
        })->count();
        
        $baixo = $medicamentos->filter(function($item) {
            $stock = $item->total_stock ?? 0;
            return $stock >= 8 && $stock < 20;
        })->count();
        
        $critico = $medicamentos->filter(function($item) {
            $stock = $item->total_stock ?? 0;
            return $stock > 0 && $stock < 8;
        })->count();
        
        return [
            'normal' => $normal,
            'baixo' => $baixo,
            'critico' => $critico
        ];
    }
    
}