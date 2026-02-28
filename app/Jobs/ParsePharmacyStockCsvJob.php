<?php

namespace App\Jobs;

use App\Models\Medicamento;
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
            $this->stockFile->update(['status' => 'processando']);

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
                'CodigoArtigo', // código de barras ou SKU
                'NomeProduto',  // nome do medicamento
                'Quantidade',
                'Lote',
                'DataValidade',
                'PrecoUnitario',
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
                    $codigoArtigo,
                    $nomeProduto,
                    $quantidade,
                    $lote,
                    $dataValidade,
                    $precoUnitario
                ] = array_map(fn ($v) => trim((string)$v), $row);

                // Validação básica
                if (empty($codigoArtigo) || empty($nomeProduto)) {
                    Log::warning("Linha {$lineNumber}: Código ou nome do medicamento ausente");
                    continue;
                }

                // Separar nome e dosagem se possível
                $nome = $nomeProduto;
                $dosagem = null;
                if (preg_match('/(.+?)\s+(\d+\s*mg|ml|g|mcg|UI|%)$/i', $nomeProduto, $matches)) {
                    $nome = trim($matches[1]);
                    $dosagem = trim($matches[2]);
                }

                // Exemplo: descrição, forma_farmaceutica e categoria_id podem ser extraídos de outras fontes ou deixados nulos
                $descricao = null;
                $forma_farmaceutica = null;
                $categoria_id = null;

                $medicamento = Medicamento::updateOrCreate(
                    [
                        'name' => $nome,
                    ],
                    [
                        'descricao' => $descricao,
                        'forma_farmaceutica' => $forma_farmaceutica,
                        'dosagem' => $dosagem,
                        'categoria_id' => $categoria_id,
                    ]
                );

                // Quantidade
                $quantidade = is_numeric($quantidade) ? (int) $quantidade : 0;
                // Preço
                $preco = is_numeric($precoUnitario)
                    ? number_format((float) $precoUnitario, 2, '.', '')
                    : '0.00';
                // Data de validade
                $dataValidade = $this->parseDate($dataValidade);

                $rows[] = [
                    'stock_file_id' => $this->stockFile->id,
                    'pharmacy_id'   => $this->stockFile->farmacia_id,
                    'medicamento_id'=> $medicamento->id,
                    'quantidade'    => $quantidade,
                    'preco'         => $preco,
                    'data_validade' => $dataValidade,
                    'lote'          => $lote ?: null,
                    'ativo'         => '1',
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
                'status' => 'concluido',
                'processed_at' => now(),
            ]);

            app(AlertService::class)->checkLowPriceItems();
            Log::info("Stock processado com sucesso. Arquivo ID {$this->stockFile->id}");

        } catch (Exception $e) {
            $this->stockFile->update(['status' => 'erro']);
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