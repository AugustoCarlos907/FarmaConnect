<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Carrinho;
use App\Models\StockItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarrinhoController extends Controller
{
    private function carrinhoDoUser()
    {
        return Carrinho::with([
                'stockItem.medicamento.categoria',
                'stockItem.farmacia',
            ])
            ->where('user_id', Auth::id())
            ->get();
    }

    public function index()
    {
        $itens = $this->carrinhoDoUser();
        $total = $itens->sum(fn($item) => $item->subtotal);

        return view('clientes.dashboard.carrinho', compact('itens', 'total'));
    }

    public function adicionar(Request $request)
    {
        $request->validate([
            'stock_item_id' => 'required|exists:stock_items,id',
            'quantidade'    => 'integer|min:1',
        ]);

        $stockItem  = StockItem::findOrFail($request->stock_item_id);
        $quantidade = $request->quantidade ?? 1;

        // Verifica se já existe no carrinho deste user
        $itemExistente = Carrinho::where('user_id', Auth::id())
                                 ->where('stock_item_id', $stockItem->id)
                                 ->first();

        $novaQty = $quantidade + ($itemExistente?->quantidade ?? 0);

        // Valida stock suficiente
        if (!$stockItem->temStock($novaQty)) {
            return back()->with('erro', 'Stock insuficiente para a quantidade pedida.');
        }

        if ($itemExistente) {
            // Apenas actualiza a quantidade
            $itemExistente->update(['quantidade' => $novaQty]);
        } else {
            // Cria novo registo
            Carrinho::create([
                'user_id'       => Auth::id(),
                'stock_item_id' => $stockItem->id,
                'quantidade'    => $quantidade,
            ]);
        }

        return back()->with('sucesso', 'Produto adicionado ao carrinho!');
    }

    public function actualizar(Request $request, Carrinho $carrinho)
    {
        // Garante que o carrinho pertence ao user autenticado
        abort_if($carrinho->user_id !== Auth::id(), 403);

        $request->validate(['quantidade' => 'required|integer|min:1']);

        if (!$carrinho->stockItem->temStock($request->quantidade)) {
            return back()->with('erro', 'Stock insuficiente.');
        }

        $carrinho->update(['quantidade' => $request->quantidade]);

        return back()->with('sucesso', 'Quantidade actualizada.');
    }

    public function remover(Carrinho $carrinho)
    {
        abort_if($carrinho->user_id !== Auth::id(), 403);

        $carrinho->delete();

        return back()->with('sucesso', 'Item removido do carrinho.');
    }

    public function limpar()
    {
        Carrinho::where('user_id', Auth::id())->delete();

        return back()->with('sucesso', 'Carrinho limpo.');
    }
}