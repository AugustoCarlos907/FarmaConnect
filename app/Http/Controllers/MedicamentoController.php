<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\Medicamento;
use App\Models\StockItem;
use App\Services\MedicamentoService;
use Illuminate\Http\Request;
use thiagoalessio\TesseractOCR\TesseractOCR;

class MedicamentoController extends Controller
{
    public function __construct(public MedicamentoService $service ){}

    public function index(Request $request , $perPage = 10)
    {
        $search = $request->input('search');
        $minPrice = $request->input('min_price');

        $user = $request->user();
        $userLat = $user->latitude ?? null;
        $userLng = $user->longitude ?? null;

        if (is_null($userLat) || is_null($userLng)) {
            $userLat = -8.8383; // coordenadas de exemplo (Luanda)
            $userLng = 13.2344;
        }

        $medicamentos = $this->service->SearchMedicamento(
            $search, 
            $perPage,
            $userLat,
            $userLng,
            $minPrice
            );

        return view('clientes.dashboard.produto_resultado' , compact('medicamentos'));
    }


    public function listMedicamentosByCategoria($perPage = 10)
    {
        $medicamentos = $this->service->getMedicamentoByCategoria($perPage);

        return response()->json($medicamentos);
    }

    public function create(Request $request){
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'descricao' => 'required|string',
                'forma_farmaceutica' => 'required|string',
                'dosagem' => 'required|string',
                'categoria_id' => 'required|integer|exists:categorias,id',
                'quantidade' => 'required|integer|min:1',
                'preco' => 'required|numeric|min:0',
                'data_validade' => 'required|date',
                'lote' => 'nullable|string|max:255',
                'requer_receita' => 'required|',
                'data_fabricacao' => 'nullable|date',
                'laboratorio' => 'nullable|string|max:255',
                'origem' => 'required|in:indiano,portugues',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 

                // 'farmacia_id' => 'required|integer|exists:farmacias,id',
                // 'ativo' => 'required|boolean'

            ]);

            if ($request->hasFile('img')) {
                $file = $request->file('img');
                
                // Gera um nome único e guarda na pasta storage/app/public/img
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('img', $filename, 'public');
                
                // Passamos apenas o nome (ex: 1712953200.jpg) para o serviço
                $path = $filename;
            } else {
                $path = null;
            }
    
            $medicamentos = $this->service->createMedicamento(
                $validatedData['name'],
                $validatedData['descricao'],
                $path,
                $validatedData['forma_farmaceutica'],
                $validatedData['dosagem'],
                $validatedData['categoria_id'],
                $validatedData['quantidade'],
                $validatedData['preco'],
                $validatedData['data_validade'],
                $validatedData['lote'] ?? null,
                $validatedData['requer_receita'],
                $validatedData['data_fabricacao'] ?? null, 
                $validatedData['laboratorio'] ?? null,     
                $validatedData['origem']                   

            );
    
            return redirect()->route('medicamentos.farmacias');
        }

    public function destroy($id){
        $medicamento = Medicamento::findOrFail($id);

        $medicamento->delete();

        return redirect()->route('medicamentos.farmacias')->with('success' , 'Medicamento Eliminado');
    }


public function searchByPrescription(Request $request)
{
    $request->validate([
        'prescricao_image' => 'required|image|max:5120'
    ]);

    $image = $request->file('prescricao_image');
    $path = $image->store('temp_receitas', 'public');
    $fullPath = storage_path('app/public/' . $path);

    try {
        $textoExtraido = (new TesseractOCR($fullPath))
            ->lang('por')
            ->run();
    } catch (\Exception $e) {
        \Log::error('Erro OCR: ' . $e->getMessage());
        return redirect()->back()->withErrors('Não foi possível ler a receita. Tente uma imagem mais nítida.');
    } finally {
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    // Normalizar texto: remover pontuação, converter minúsculas
    $textoLimpo = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $textoExtraido);
    $palavras = array_unique(preg_split('/\s+/', $textoLimpo, -1, PREG_SPLIT_NO_EMPTY));
    $palavras = array_map('strtolower', $palavras);
    
    // Ignorar palavras muito curtas e ordenar as mais longas primeiro (mais relevantes)
    $palavras = array_filter($palavras, fn($p) => strlen($p) >= 3);
    usort($palavras, fn($a, $b) => strlen($b) - strlen($a));
    $palavras = array_slice($palavras, 0, 15); // limite de 15 palavras

    // Buscar medicamentos por correspondência no nome
    $medicamentosEncontrados = collect();
    foreach ($palavras as $palavra) {
        $meds = Medicamento::where('name', 'LIKE', "%{$palavra}%")->get();
        $medicamentosEncontrados = $medicamentosEncontrados->merge($meds);
    }
    $medicamentosEncontrados = $medicamentosEncontrados->unique('id');

    if ($medicamentosEncontrados->isEmpty()) {
        return redirect()->route('produtos.clientes')
            ->with('warning', 'Nenhum medicamento identificado na receita. Tente uma imagem mais clara.');
    }

    $adicionados = 0;
    foreach ($medicamentosEncontrados as $medicamento) {
        // Buscar o stock item com MENOR PREÇO, ativo e com estoque (opcional)
        $stockItem = $medicamento->stockItems()
            ->where('ativo', true)
            ->where('quantidade', '>', 0) // se existir controle de estoque
            ->orderBy('preco', 'asc')
            ->first();

        if ($stockItem) {
            $carrinho = Carrinho::where('user_id', auth()->id())
                                ->where('stock_item_id', $stockItem->id)
                                ->first();
            if ($carrinho) {
                $carrinho->increment('quantidade');
            } else {
                Carrinho::create([
                    'user_id'       => auth()->id(),
                    'stock_item_id' => $stockItem->id,
                    'quantidade'    => 1
                ]);
            }
            $adicionados++;
        }
    }

    if ($adicionados === 0) {
        return redirect()->route('produtos.clientes')
            ->with('warning', 'Os medicamentos identificados estão indisponíveis no momento.');
    }

    return redirect()->route('carrinho.clientes')
        ->with('success', "Foram adicionados {$adicionados} medicamento(s) ao carrinho com base na receita (sempre o menor preço disponível).");
}

public function ajusteStock(Request $request, $id)
{
    $request->validate(['quantidade' => 'required|integer|not_in:0']);

    $farmaciaId = auth()->user()->farmacia_id;
    $stockItem = StockItem::where('medicamento_id', $id)
                         ->where('farmacia_id', $farmaciaId)
                         ->firstOrFail();

    $novaQuantidade = $stockItem->update(['quantidade' => $request->quantidade]);
    if ($novaQuantidade < 0) {
        return back()->withErrors(['quantidade' => 'Stock não pode ficar negativo.']);
    }

    // $stockItem->update(['quantidade' => $novaQuantidade]);
    return back()->with('success', 'Stock actualizado com sucesso.');
}

}
