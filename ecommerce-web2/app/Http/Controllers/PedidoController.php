<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::forUser(Auth::id());
        
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $produtos = Produto::forUser(Auth::id());
        
        return view('pedidos.create', compact('produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_cliente' => 'required|string|max:255',
            'produtos'     => 'required|array', 
            'quantidades'  => 'required|array', 
        ]);

        $totalDoPedido = 0;
        $dadosParaPivot = [];

        foreach ($request->produtos as $index => $produto_id) {
            
            $quantidade = $request->quantidades[$index] ?? 1;

            $produto = Produto::where('id', $produto_id)
                              ->where('user_id', Auth::id())
                              ->firstOrFail();

            if ($produto->estoque < $quantidade) {
                return back()->withErrors("O produto {$produto->nome} não tem estoque suficiente.");
            }

            $produto->estoque -= $quantidade;
            $produto->save();

            $totalDoPedido += ($produto->preco * $quantidade);

            $dadosParaPivot[$produto->id] = [
                'quantidade' => $quantidade,
                'preco_unitario' => $produto->preco
            ];
        }

        $pedido = Pedido::create([
            'user_id'      => Auth::id(),
            'nome_cliente' => $request->nome_cliente,
            'status'       => 'Pendente',
            'total'        => $totalDoPedido
        ]);

        $pedido->produtos()->sync($dadosParaPivot);

        Pedido::clearUserCache(Auth::id());
        Produto::clearUserCache(Auth::id());

        return redirect()->route('pedidos.index')->with('success', 'Venda registrada com sucesso!');
    }

    public function show($id)
    {
        $pedido = Pedido::where('id', $id)->where('user_id', Auth::id())->with('produtos')->firstOrFail();
        
        return view('pedidos.show', compact('pedido'));
    }

    public function edit($id)
    {
        $pedido = Pedido::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        return view('pedidos.edit', compact('pedido'));
    }

    public function update(Request $request, $id)
    {
        $pedido = Pedido::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'status' => 'required|in:Pendente,Pago,Cancelado',
        ]);

        $pedido->update([
            'status' => $request->status,
        ]);

        Pedido::clearUserCache(Auth::id());

        return redirect()->route('pedidos.index')->with('success', 'Status do pedido atualizado!');
    }

    public function destroy($id)
    {
        $pedido = Pedido::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        $pedido->delete();

        Pedido::clearUserCache(Auth::id());

        return redirect()->route('pedidos.index')->with('success', 'Pedido excluído com sucesso.');
    }
}