<?php

namespace App\Jobs;

use App\Models\ComprovativoPagamento;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use thiagoalessio\TesseractOCR\TesseractOCR;

class ProcessarComprovativoJob implements ShouldQueue{
    use Queueable;
    
    private function extrairValor($texto)
    {
        // Exemplo: procura por "Valor: 123.45" ou "Valor 123,45"
        if (preg_match('/valor[:\s]*([\d.,]+)/i', $texto, $matches)) {
            return str_replace(',', '.', $matches[1]);
        }
        // Tenta encontrar o primeiro número decimal
        if (preg_match('/([\d]+[.,][\d]{2})/', $texto, $matches)) {
            return str_replace(',', '.', $matches[1]);
        }
        return null;
    }

    // Extrai o IBAN do texto do comprovativo
    private function extrairIBAN($texto)
    {
        // Exemplo: procura por IBAN padrão (PT50...)
        if (preg_match('/([A-Z]{2}\d{2}[ ]?\d{4}[ ]?\d{4}[ ]?\d{4}[ ]?\d{4}[ ]?\d{0,2})/i', $texto, $matches)) {
            return preg_replace('/\s+/', '', $matches[1]);
        }
        return null;
    }

    // Extrai a data do texto do comprovativo
    private function extrairData($texto)
    {
        // Exemplo: procura por datas no formato dd/mm/yyyy ou yyyy-mm-dd
        if (preg_match('/(\d{2}[\/\-]\d{2}[\/\-]\d{4})/', $texto, $matches)) {
            return $matches[1];
        }
        if (preg_match('/(\d{4}[\/\-]\d{2}[\/\-]\d{2})/', $texto, $matches)) {
            return $matches[1];
        }
        return null;
    }

    private function reconciliar($valor, $iban, $data){
    $pagamento = $this->comprovativo->pagamento;

    if (
        $valor == $pagamento->valor &&
        $iban == $pagamento->iban_destino
    ) {
        $pagamento->update([
            'status' => 'confirmado',
            'confirmado_em' => now()
        ]);

        $pedido = $pagamento->pedido;
        $pedido->update([
            'status' => 'pago'
        ]);

        $this->comprovativo->update([
            'status_validacao' => 'valido'
        ]);

        // $this->gerarFactura($pagamento);

    } else {
        $this->comprovativo->update([
            'status_validacao' => 'invalido'
        ]);
    }
}


    /**
     * Create a new job instance.
     */
    public function __construct(public ComprovativoPagamento $comprovativo)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->comprovativo->update([
            'status_validacao' => 'processando'
        ]);

        $caminho = storage_path('app/'.$this->comprovativo->arquivo_path);

        // OCR (Tesseract)
        $textoExtraido = (new TesseractOCR($caminho))->run();

        // Parse básico
        $valor = $this->extrairValor($textoExtraido);
        $iban  = $this->extrairIBAN($textoExtraido);
        $data  = $this->extrairData($textoExtraido);

        $this->comprovativo->update([
            'dados_extraidos' => json_encode([
                'valor' => $valor,
                'iban' => $iban,
                'data' => $data
            ])
        ]);

        $this->reconciliar($valor, $iban, $data);
        // Opcional: enviar notificação ao usuário sobre o status do comprovativo
    
    }

   
}
