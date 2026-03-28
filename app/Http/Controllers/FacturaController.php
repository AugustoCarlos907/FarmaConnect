<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Pedido;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    
    public function index($id){

        $pedido = Pedido::findOrFail($id);

        $userId = Auth()->user()->id;

        $factura = Factura::where('pedido_id' , $pedido->id)
                            ->where('user_id' , $userId)
                            ->first();

        if (!$factura) {
            return redirect()->back()->with('error', 'A fatura para este pedido ainda não foi gerada.');
        }
        
        $pdf = Pdf::loadView('clientes.dashboard.facturas' , compact('factura'));

        return $pdf->download('FACTURA-FARMACONNECT'.$factura->id.'.pdf');
        
    }

}
