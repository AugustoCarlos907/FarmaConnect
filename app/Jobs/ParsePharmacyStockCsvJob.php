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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use SplFileObject;

/**
 * ParsePharmacyStockCsvJob
 * ─────────────────────────────────────────────────────────────────────────────
 * Processa um ficheiro CSV de stock de farmácia de duas formas distintas,
 * controladas pelo campo `tipo` do StockFile:
 *
 *   "entrada"   → Entrada em lote (cria ou actualiza medicamentos)
 *                 Lógica de correspondência:
 *                   1. Correspondência EXACTA por nome                    → soma stock
 *                   2. Correspondência SIMILAR (nome + dosagem)           → soma stock
 *                   3. Sem correspondência                                → cria novo
 *
 *   "inventario" → Ajuste de inventário em lote
 *                  Apenas actualiza o stock de medicamentos já existentes.
 *                  Não cria novos medicamentos.
 *                  O campo `Quantidade` pode ser positivo (adicionar)
 *                  ou negativo (subtrair), mas nunca desce abaixo de 0.
 *
 * Header do CSV (campos obrigatórios marcados com *):
 *   CodigoArtigo*, NomeProduto*, Quantidade*, Lote, DataValidade,
 *   PrecoUnitario, Categoria, Dosagem, PrecoMedicamento, RequerReceita,
 *   FormafFarmaceutica, Descricao, Laboratorio, Origem, DataFabricacao
 *
 * Campos opcionais → linha é processada mesmo que venham vazios.
 * ─────────────────────────────────────────────────────────────────────────────
 */
class ParsePharmacyStockCsvJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    // Número máximo de tentativas automáticas em caso de falha
    public int $tries = 3;

    // Colunas que o CSV DEVE conter (obrigatórias para validação do header)
    private const REQUIRED_COLUMNS = [
        'CodigoArtigo',
        'NomeProduto',
        'Quantidade',
    ];

    // Colunas opcionais — podem estar ausentes ou vazias sem quebrar o job
    private const OPTIONAL_COLUMNS = [
        'Lote',
        'DataValidade',
        'PrecoUnitario',
        'Categoria',
        'Dosagem',
        'PrecoMedicamento',
        'RequerReceita',
        'FormaFarmaceutica',   // NOVO — adicionado ao header
        'Descricao',           // NOVO — adicionado ao header
        'Laboratorio',         // NOVO — adicionado ao header
        'Origem',              // NOVO — adicionado ao header
        'DataFabricacao',      // NOVO — adicionado ao header
    ];

    public function __construct(
        public StockFile $stockFile
    ) {}

    /* ═══════════════════════════════════════════════════════════════════════
     * PONTO DE ENTRADA
     * ═══════════════════════════════════════════════════════════════════════ */
    public function handle(): void
    {
        try {
            $this->stockFile->update(['status' => 'processando']);

            // Tipo do ficheiro: "entrada" (default) ou "inventario"
            // Definido pelo controller ao criar o StockFile
            $tipo = $this->stockFile->tipo ?? 'entrada';

            $linhas = $this->lerCsv();

            if (empty($linhas)) {
                throw new Exception('Nenhuma linha válida encontrada no CSV.');
            }

            // Separar em dois fluxos distintos
            if ($tipo === 'inventario') {
                $this->processarAjusteInventario($linhas);
            } else {
                $this->processarEntradaEmLote($linhas);
            }

            $this->stockFile->update(['status' => 'concluido']);

            // Disparar alerta de preço baixo após qualquer alteração de stock

            
            // app(AlertService::class)->checkLowPriceItems();



            Log::info("CSV processado com sucesso.", [
                'file_id' => $this->stockFile->id,
                'tipo'    => $tipo,
                'linhas'  => count($linhas),
            ]);

        } catch (Exception $e) {
            $this->stockFile->update(['status' => 'erro']);

            Log::error('Erro ao processar CSV de stock', [
                'file_id' => $this->stockFile->id,
                'tipo'    => $this->stockFile->tipo ?? 'entrada',
                'erro'    => $e->getMessage(),
            ]);

            // Re-lança para o worker marcar como falhado e tentar de novo
            throw $e;
        }
    }

    /* ═══════════════════════════════════════════════════════════════════════
     * LEITURA DO CSV
     *
     * Devolve array de linhas associativas [ 'NomeProduto' => '...', ... ]
     * Trata BOM UTF-8, colunas em falta, e linhas incompletas.
     * ═══════════════════════════════════════════════════════════════════════ */
    private function lerCsv(): array
    {
        $path = storage_path('app/' . $this->stockFile->file_path);

        if (!file_exists($path)) {
            throw new Exception("Ficheiro CSV não encontrado: {$path}");
        }

        $file = new SplFileObject($path);
        $file->setFlags(
            SplFileObject::READ_CSV |
            SplFileObject::SKIP_EMPTY |
            SplFileObject::DROP_NEW_LINE
        );

        // ── Ler e normalizar o header ───────────────────────────────────────
        $header = $file->fgetcsv();

        if (!$header || !is_array($header)) {
            throw new Exception('CSV vazio ou impossível de ler.');
        }

        // Remover BOM UTF-8 da primeira coluna, se existir
        $header    = array_map('trim', $header);
        $header[0] = preg_replace('/^\xEF\xBB\xBF/', '', $header[0]);

        // Verificar se as colunas obrigatórias estão presentes
        foreach (self::REQUIRED_COLUMNS as $col) {
            if (!in_array($col, $header)) {
                throw new Exception(
                    "Coluna obrigatória ausente no header: '{$col}'. " .
                    "Header recebido: " . implode(', ', $header)
                );
            }
        }

        $allColumns  = array_merge(self::REQUIRED_COLUMNS, self::OPTIONAL_COLUMNS);
        $linhasValidas = [];
        $lineNumber  = 1;

        // ── Ler linha a linha ───────────────────────────────────────────────
        while (!$file->eof()) {
            $lineNumber++;
            $row = $file->fgetcsv();

            if (!$row || !is_array($row)) {
                continue;
            }

            // Mapear cada valor à coluna correspondente pelo header real do CSV
            // Isto garante compatibilidade mesmo que o CSV tenha menos colunas
            // do que o esperado, ou que as colunas estejam noutra ordem
            $dados = [];
            foreach ($header as $idx => $coluna) {
                // Valor da célula ou string vazia se a coluna não existir na linha
                $dados[$coluna] = isset($row[$idx]) ? trim((string) $row[$idx]) : '';
            }

            // Garantir que todas as colunas opcionais existem (mesmo vazias)
            // para que o código downstream possa aceder sem isset()
            foreach ($allColumns as $col) {
                if (!array_key_exists($col, $dados)) {
                    $dados[$col] = '';
                }
            }

            // Ignorar linhas sem nome ou código do produto
            if (empty($dados['CodigoArtigo']) && empty($dados['NomeProduto'])) {
                Log::warning("Linha {$lineNumber}: CodigoArtigo e NomeProduto ausentes — ignorada.");
                continue;
            }

            // Linha número para rastreamento em logs
            $dados['_linha'] = $lineNumber;

            $linhasValidas[] = $dados;
        }

        return $linhasValidas;
    }

    /* ═══════════════════════════════════════════════════════════════════════
     * FLUXO 1 — ENTRADA EM LOTE
     *
     * Para cada linha do CSV:
     *   a) Procura correspondência EXACTA por nome (case-insensitive)
     *   b) Se não, procura correspondência SIMILAR: mesmo radical de nome
     *      + mesma dosagem (normalizada)
     *   c) Se encontrou correspondência → SOMA a quantidade ao StockItem
     *      existente mais recente para esta farmácia
     *   d) Se não encontrou → CRIA novo Medicamento + novo StockItem
     *
     * Toda a operação corre dentro de uma transacção por lote de 500 linhas.
     * ═══════════════════════════════════════════════════════════════════════ */
    private function processarEntradaEmLote(array $linhas): void
    {
        // Categoria padrão — usada quando a categoria do CSV não existe na BD
        $categoriaPadrao = Categoria::firstOrCreate(
            ['name' => 'Outros'],
            ['descricao' => 'Categoria padrão para medicamentos sem categoria definida']
        );

        // Processar em lotes de 100 para não saturar a memória
        $chunks = array_chunk($linhas, 100);

        foreach ($chunks as $chunk) {
            DB::transaction(function () use ($chunk, $categoriaPadrao) {
                foreach ($chunk as $dados) {
                    $this->processarLinhaEntrada($dados, $categoriaPadrao);
                }
            });
        }
    }

    /**
     * Processa uma única linha no modo ENTRADA.
     * Decide se cria novo medicamento ou soma ao existente.
     */
    private function processarLinhaEntrada(array $d, Categoria $categoriaPadrao): void
    {
        $nomeCsv    = $d['NomeProduto'];
        $dosagemCsv = $this->normalizarDosagem($d['Dosagem'] ?? '');
        $linha      = $d['_linha'];

        // ── Correspondência EXACTA (nome idêntico, case-insensitive) ─────────
        $medicamento = Medicamento::whereRaw('LOWER(name) = ?', [strtolower($nomeCsv)])->first();

        // ── Correspondência SIMILAR (radical do nome + dosagem igual) ─────────
        // Ex: "Dipirona 500mg" no CSV ↔ "Dipirona" na BD com dosagem "500mg"
        if (!$medicamento && !empty($dosagemCsv)) {
            // Extrai a primeira palavra do nome CSV como radical de busca
            $radical = strtolower(explode(' ', trim($nomeCsv))[0]);

            $medicamento = Medicamento::whereRaw('LOWER(name) LIKE ?', ["%{$radical}%"])
                ->whereRaw('LOWER(COALESCE(dosagem, \'\')) = ?', [$dosagemCsv])
                ->first();

            if ($medicamento) {
                Log::info("Linha {$linha}: correspondência similar — '{$nomeCsv}' → '{$medicamento->name}'");
            }
        }

        // ── Determinar categoria ──────────────────────────────────────────────
        $categoria = null;
        if (!empty($d['Categoria'])) {
            $categoria = Categoria::whereRaw('LOWER(name) = ?', [strtolower($d['Categoria'])])->first();
        }
        // Se a categoria não existir na BD usa a padrão (não cria categorias novas aqui)
        $categoria = $categoria ?? $categoriaPadrao;

        if ($categoria->id === $categoriaPadrao->id && !empty($d['Categoria'])) {
            Log::warning("Linha {$linha}: Categoria '{$d['Categoria']}' não encontrada. Usando categoria padrão.");
        }

        // ── CRIAR ou ACTUALIZAR o modelo Medicamento ──────────────────────────
        $dadosMedicamento = [
            'categoria_id'       => $categoria->id,
            // Só sobrepõe campos preenchidos no CSV — não apaga dados existentes
            'descricao'          => !empty($d['Descricao'])         ? $d['Descricao']         : ($medicamento?->descricao ?? 'UNKNOWN'),
            'forma_farmaceutica' => !empty($d['FormaFarmaceutica']) ? $d['FormaFarmaceutica'] : ($medicamento?->forma_farmaceutica ?? 'UNKNOWN'),
            'dosagem'            => !empty($d['Dosagem'])           ? $d['Dosagem']           : $medicamento?->dosagem,
            'laboratorio'        => !empty($d['Laboratorio'])       ? $d['Laboratorio']       : $medicamento?->laboratorio,
            'origem'             => !empty($d['Origem'])            ? $d['Origem']            : $medicamento?->origem,
            'data_fabricacao'    => !empty($d['DataFabricacao'])    ? $this->parseDate($d['DataFabricacao']) : $medicamento?->data_fabricacao,
            'requer_receita'     => $this->parseBool($d['RequerReceita'] ?? ''),
        ];

        // Só actualiza o preço do medicamento se vier preenchido no CSV
        if (!empty($d['PrecoMedicamento']) && is_numeric($d['PrecoMedicamento'])) {
            $dadosMedicamento['preco'] = (float) $d['PrecoMedicamento'];
        } elseif (!$medicamento) {
            // Novo medicamento sem preço → 0.00
            $dadosMedicamento['preco'] = 0.00;
        }

        if ($medicamento) {
            // ACTUALIZAR apenas campos preenchidos (não sobrepõe com valores vazios)
            $medicamento->update(array_filter($dadosMedicamento, fn($v) => $v !== null && $v !== ''));
        } else {
            // CRIAR novo medicamento
            $medicamento = Medicamento::create(array_merge(
                ['name' => $nomeCsv],
                $dadosMedicamento
            ));
            Log::info("Linha {$linha}: novo medicamento criado → '{$nomeCsv}' (ID {$medicamento->id})");
        }

        // ── STOCK ITEM — soma ao existente ou cria novo ───────────────────────
        $quantidadeCsv = is_numeric($d['Quantidade']) ? (int) $d['Quantidade'] : 0;
        $precoCsv      = is_numeric($d['PrecoUnitario']) ? (float) $d['PrecoUnitario'] : ($medicamento->preco ?? 0);
        $validade      = $this->parseDate($d['DataValidade'] ?? '');
        $lote          = !empty($d['Lote']) ? $d['Lote'] : null;

        // Procura stock item existente para esta farmácia + medicamento + lote
        // Se o lote vier vazio, procura qualquer stock item desta farmácia + medicamento
        $stockQuery = StockItem::where('medicamento_id', $medicamento->id)
            ->where('farmacia_id', $this->stockFile->farmacia_id);

        if ($lote) {
            // Com lote especificado: procura exacto (mesmo lote)
            $stockItem = $stockQuery->where('lote', $lote)->first();
        } else {
            // Sem lote: soma ao stock item mais recente desta farmácia
            $stockItem = $stockQuery->latest()->first();
        }

        if ($stockItem) {
            // SOMA a quantidade ao stock existente
            $stockItem->increment('quantidade', $quantidadeCsv);

            // Actualiza validade e preço se vierem preenchidos e forem diferentes
            $actualizar = [];
            if ($validade && $stockItem->data_validade?->toDateString() !== $validade) {
                $actualizar['data_validade'] = $validade;
            }
            if ($precoCsv > 0 && $stockItem->preco != $precoCsv) {
                $actualizar['preco'] = $precoCsv;
            }
            if (!empty($actualizar)) {
                $stockItem->update($actualizar);
            }

            Log::info("Linha {$linha}: stock somado — '{$medicamento->name}' +{$quantidadeCsv} un.");
        } else {
            // CRIAR novo stock item
            StockItem::create([
                'medicamento_id' => $medicamento->id,
                'farmacia_id'    => $this->stockFile->farmacia_id,
                'quantidade'     => $quantidadeCsv,
                'preco'          => $precoCsv,
                'data_validade'  => $validade,
                'lote'           => $lote,
                'ativo'          => true,
            ]);

            Log::info("Linha {$linha}: novo stock item criado — '{$medicamento->name}' {$quantidadeCsv} un.");
        }
    }

    /* ═══════════════════════════════════════════════════════════════════════
     * FLUXO 2 — AJUSTE DE INVENTÁRIO EM LOTE
     *
     * Apenas actualiza o stock de medicamentos JÁ EXISTENTES.
     * Não cria nenhum medicamento novo.
     *
     * O campo `Quantidade` pode ser:
     *   +N  →  adicionar N unidades ao stock actual
     *   -N  →  retirar N unidades (nunca desce abaixo de 0)
     *    0  →  ignorar (sem alteração)
     *
     * Correspondência: exacta por nome (case-insensitive).
     * ═══════════════════════════════════════════════════════════════════════ */
    private function processarAjusteInventario(array $linhas): void
    {
        $chunks = array_chunk($linhas, 100);

        foreach ($chunks as $chunk) {
            DB::transaction(function () use ($chunk) {
                foreach ($chunk as $d) {
                    $this->processarLinhaAjuste($d);
                }
            });
        }
    }

    private function processarLinhaAjuste(array $d): void
    {
        $nomeCsv   = $d['NomeProduto'];
        $ajuste    = is_numeric($d['Quantidade']) ? (int) $d['Quantidade'] : 0;
        $linha     = $d['_linha'];

        // Ignorar linhas com ajuste zero
        if ($ajuste === 0) {
            Log::warning("Linha {$linha}: Quantidade = 0 → ignorada (sem alteração).");
            return;
        }

        // Procura o medicamento na BD (correspondência exacta por nome)
        $medicamento = Medicamento::whereRaw('LOWER(name) = ?', [strtolower($nomeCsv)])->first();

        if (!$medicamento) {
            // Modo inventário NÃO cria medicamentos — apenas regista o aviso
            Log::warning("Linha {$linha}: Medicamento '{$nomeCsv}' não encontrado na BD — linha ignorada no ajuste de inventário.");
            return;
        }

        // Procura o stock item desta farmácia
        $lote      = !empty($d['Lote']) ? $d['Lote'] : null;
        $stockQuery = StockItem::where('medicamento_id', $medicamento->id)
            ->where('farmacia_id', $this->stockFile->farmacia_id);

        $stockItem = $lote
            ? $stockQuery->where('lote', $lote)->first()
            : $stockQuery->latest()->first();

        if (!$stockItem) {
            Log::warning("Linha {$linha}: Sem stock item para '{$nomeCsv}' nesta farmácia — ignorado.");
            return;
        }

        if ($ajuste > 0) {
            // Adição de stock
            $stockItem->increment('quantidade', $ajuste);
            Log::info("Linha {$linha}: ajuste positivo — '{$nomeCsv}' +{$ajuste} un.");
        } else {
            // Subtracção — nunca desce abaixo de 0
            $retirar  = abs($ajuste);
            $novoStock = max(0, $stockItem->quantidade - $retirar);
            $stockItem->update(['quantidade' => $novoStock]);
            Log::info("Linha {$linha}: ajuste negativo — '{$nomeCsv}' -{$retirar} un. (stock: {$novoStock})");
        }
    }

    /* ═══════════════════════════════════════════════════════════════════════
     * HELPERS
     * ═══════════════════════════════════════════════════════════════════════ */

    /**
     * Converte string de data em formato Y-m-d.
     * Aceita: d/m/Y, Y-m-d, Y-m, m/Y, etc.
     * Devolve null se não conseguir parsear.
     */
    private function parseDate(?string $date): ?string
    {
        try {
            if (empty($date)) return null;
            // Tentar vários formatos comuns em farmácias angolanas
            $formatos = ['d/m/Y', 'Y-m-d', 'd-m-Y', 'm/Y', 'Y-m', 'd/m/y'];
            foreach ($formatos as $formato) {
                $dt = \DateTime::createFromFormat($formato, $date);
                if ($dt) {
                    return $dt->format('Y-m-d');
                }
            }
            // Fallback com strtotime
            $ts = strtotime($date);
            return $ts ? date('Y-m-d', $ts) : null;
        } catch (\Throwable) {
            return null;
        }
    }

    /**
     * Normaliza dosagem para comparação: "500 mg" → "500mg", "500MG" → "500mg"
     */
    private function normalizarDosagem(?string $dosagem): string
    {
        if (empty($dosagem)) return '';
        // Remove espaços entre número e unidade, converte para minúsculas
        return strtolower(preg_replace('/\s+/', '', trim($dosagem)));
    }

    /**
     * Converte string para boolean.
     * Valores positivos: "sim", "1", "true", "yes", "s"
     */
    private function parseBool(?string $valor): bool
    {
        return in_array(strtolower(trim((string) $valor)), ['sim', '1', 'true', 'yes', 's']);
    }
}