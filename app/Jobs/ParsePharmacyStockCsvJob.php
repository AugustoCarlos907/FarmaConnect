<?php

namespace App\Jobs;

use App\Models\Categoria;
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
                'CodigoArtigo',
                'NomeProduto',
                'Quantidade',
                'Lote',
                'DataValidade',
                'PrecoUnitario',
                'Categoria',
                'Dosagem',
                'PrecoMedicamento',
                'RequerReceita'
            ];

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

            // Obter ou criar categoria padrão (para casos onde a categoria não existe)
            $categoriaPadrao = Categoria::firstOrCreate(
                ['name' => 'Outros'],
                ['descricao' => 'Categoria padrão para medicamentos sem categoria definida']
            );

            $rows = [];
            $lineNumber = 1;

            while (!$file->eof()) {
                $lineNumber++;
                $row = $file->fgetcsv();
                // if (!$row || !is_array($row) || count($row) < count($expectedHeader)) {
                //     continue;
                // }

                if (!$row || !is_array($row)) {
                    continue;
                }
                // Garante que a linha tenha exatamente 10 elementos (preenche com vazio se faltar)
                $row = array_pad($row, count($expectedHeader), '');
                [
                    $codigoArtigo,
                    $nomeProduto,
                    $quantidade,
                    $lote,
                    $dataValidade,
                    $precoUnitario,
                    $categoriaNome,
                    $dosagem,
                    $precoMedicamento,
                    $requerReceita
                ] = array_map(fn($v) => trim((string)$v), $row);
                // Converter requer_receita para booleano
                $requerReceitaBool = in_array(strtolower($requerReceita), ['sim', '1', 'true', 'yes']) ? true : false;

                if (empty($codigoArtigo) || empty($nomeProduto)) {
                    Log::warning("Linha {$lineNumber}: Código ou nome do medicamento ausente");
                    continue;
                }

                // Buscar categoria pelo nome (exato)
                $categoria = null;
                if (!empty($categoriaNome)) {
                    $categoria = Categoria::where('name', $categoriaNome)->first();
                }

                // Se não encontrou, usar a categoria padrão
                if (!$categoria) {
                    $categoria = $categoriaPadrao;
                    Log::warning("Linha {$lineNumber}: Categoria '{$categoriaNome}' não encontrada. Usando categoria padrão '{$categoriaPadrao->name}'.");
                }

                $medicamentoData = [
                    'descricao'          => 'UNKNOWN',
                    'forma_farmaceutica' => 'UNKNOWN',
                    'dosagem'            => $dosagem ?: null,
                    'categoria_id'       => $categoria->id,
                    'preco'              => is_numeric($precoMedicamento) ? (float) $precoMedicamento : 0.00,
                    'requer_receita'     => $requerReceitaBool,
                ];

                $medicamento = Medicamento::updateOrCreate(
                    ['name' => $nomeProduto],
                    $medicamentoData
                );

                $quantidadeStock = is_numeric($quantidade) ? (int) $quantidade : 0;
                $precoStock = is_numeric($precoUnitario) ? (float) $precoUnitario : 0.00;
                $validade = $this->parseDate($dataValidade);

                $rows[] = [
                    'medicamento_id' => $medicamento->id,
                    'farmacia_id'    => $this->stockFile->farmacia_id,
                    'quantidade'     => $quantidadeStock,
                    'preco'          => $precoStock,
                    'data_validade'  => $validade,
                    'lote'           => $lote ?: null,
                    'ativo'          => true,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ];
            }

            if (empty($rows)) {
                throw new Exception('Nenhuma linha válida encontrada no CSV');
            }

            collect($rows)->chunk(500)->each(function ($chunk) {
                StockItem::insert($chunk->toArray());
            });

            $this->stockFile->update(['status' => 'concluido']);
            app(AlertService::class)->checkLowPriceItems();
            Log::info("Stock processado com sucesso. Arquivo ID {$this->stockFile->id}");

        } catch (Exception $e) {
            $this->stockFile->update(['status' => 'erro']);
            Log::error('Erro ao processar stock CSV', [
                'file_id' => $this->stockFile->id,
                'error'   => $e->getMessage()
            ]);
            throw $e;
        }
    }

    private function parseDate(?string $date): ?string
    {
        try {
            if (empty($date)) return null;
            $timestamp = strtotime($date);
            return $timestamp ? date('Y-m-d', $timestamp) : null;
        } catch (\Throwable) {
            return null;
        }
    }
}