<?php

namespace App\Jobs;

use App\Models\StockFile;
use App\Models\StockItem;
use App\Services\AlertService;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use SplFileObject;
use Illuminate\Support\Facades\Log;

class ParsePharmacyStockCsvJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    public function __construct(public StockFile $stockFile)
    {}

    public function handle(): void
    {
        try {
            $this->stockFile->update(['status' => 'processing']);

            $path = storage_path('app/' . $this->stockFile->file_path);

            if (!file_exists($path)) {
                throw new Exception("Arquivo CSV não encontrado: {$path}");
            }

            $file = new SplFileObject($path);
            $file->setFlags(
                SplFileObject::READ_CSV |
                SplFileObject::SKIP_EMPTY |
                SplFileObject::DROP_NEW_LINE
            );

            $expectedHeader = [
                'medicamento_id',
                'quantidade',
                'preco',
                'data_validade',
                'lote',
                'ativo',
            ];

            // Cabeçalho
            $header = $file->fgetcsv();

            if (!$header || !is_array($header)) {
                throw new Exception('CSV vazio ou inválido');
            }

            $header = array_map('trim', $header);
            $header[0] = preg_replace('/^\xEF\xBB\xBF/', '', $header[0]);

            if ($header !== $expectedHeader) {
                throw new Exception(
                    'Estrutura inválida. Esperado: ' .
                    json_encode($expectedHeader) .
                    ' | Recebido: ' .
                    json_encode($header)
                );
            }

            $rows = [];
            $lineNumber = 1;

            while (!$file->eof()) {
                $lineNumber++;
                $row = $file->fgetcsv();

                if (!$row || !is_array($row) || count($row) < 6) {
                    continue;
                }

                [
                    $medicamentoId,
                    $quantidade,
                    $preco,
                    $dataValidade,
                    $lote,
                    $ativo
                ] = array_map(fn ($v) => trim((string)$v), $row);

                // medicamento_id obrigatório
                if (!is_numeric($medicamentoId)) {
                    Log::warning("Linha {$lineNumber}: medicamento_id inválido");
                    continue;
                }

                // Quantidade
                $quantidade = is_numeric($quantidade) ? (int) $quantidade : 0;

                // Preço
                $preco = is_numeric($preco)
                    ? number_format((float) $preco, 2, '.', '')
                    : '0.00';

                // Data de validade
                $dataValidade = $this->parseDate($dataValidade);

                // Ativo
                $ativo = in_array(strtolower($ativo), ['1', 'true', 'ativo', 'sim'])
                    ? '1'
                    : '0';

                $rows[] = [
                    'stock_file_id' => $this->stockFile->id,
                    'pharmacy_id'   => $this->stockFile->company_id,
                    'medicamento_id'=> (int) $medicamentoId,
                    'quantidade'    => $quantidade,
                    'preco'         => $preco,
                    'data_validade' => $dataValidade,
                    'lote'          => $lote ?: null,
                    'ativo'         => $ativo,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ];
            }

            if (empty($rows)) {
                throw new Exception('Nenhuma linha válida encontrada no CSV');
            }

            collect($rows)->chunk(500)->each(function ($chunk) {
                StockItem::insert($chunk->toArray());
            });

            $this->stockFile->update([
                'status' => 'extracted',
                'processed_at' => now(),
            ]);

            app(AlertService::class)->checkLowPriceItems();

            Log::info("Stock processado com sucesso. Arquivo ID {$this->stockFile->id}");

        } catch (Exception $e) {
            $this->stockFile->update(['status' => 'failed']);
            Log::error('Erro ao processar stock CSV', [
                'file_id' => $this->stockFile->id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    private function parseDate(?string $date): ?string
    {
        try {
            return $date ? date('Y-m-d', strtotime($date)) : null;
        } catch (\Throwable) {
            return null;
        }
    }
}