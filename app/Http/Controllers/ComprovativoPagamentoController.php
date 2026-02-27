<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessarComprovativoJob;
use App\Models\Pagamento;
use Illuminate\Http\Request;

class ComprovativoPagamentoController extends Controller
{
    public function uploadComprovativo(Request $request , $id){
       $request->validate([
        'arquivo' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120'
        ]);

        $pagamento = Pagamento::findOrFail($id);

        $path = $request->file('arquivo')->store('comprovativos');

        $comprovativo = $pagamento->comprovativo()->create([
            'arquivo_path' => $path,
            'status_validacao' => 'pendente'
        ]);


        ProcessarComprovativoJob::dispatch($comprovativo);
        return response()->json(['message' => 'Comprovativo enviado com sucesso.'], 200);
    }

    
}
