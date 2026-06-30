<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::forUser(Auth::id());
        
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        $categorias = Categoria::forUser(Auth::id());
        
        return view('produtos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'preco' => 'required|numeric',
            'estoque' => 'required|integer',
            'descricao' => 'nullable|string'
        ]);

        $categoria = Categoria::where('id', $request->categoria_id)->where('user_id', Auth::id())->firstOrFail();

        Produto::create([
            'nome' => $request->nome,
            'categoria_id' => $categoria->id,
            'preco' => $request->preco,
            'estoque' => $request->estoque,
            'descricao' => $request->descricao,
            'user_id' => Auth::id(),
        ]);

        Produto::clearUserCache(Auth::id());

        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso.');
    }

    public function edit($id)
    {
        $produto = Produto::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $categorias = Auth::user()->categorias;
        
        return view('produtos.edit', compact('produto', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'nome' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'preco' => 'required|numeric',
            'estoque' => 'required|integer',
            'descricao' => 'nullable|string'
        ]);


        $categoria = Categoria::where('id', $request->categoria_id)->where('user_id', Auth::id())->firstOrFail();

        $produto->update([
            'nome' => $request->nome,
            'categoria_id' => $categoria->id,
            'preco' => $request->preco,
            'estoque' => $request->estoque,
            'descricao' => $request->descricao,
        ]);

        Produto::clearUserCache(Auth::id());

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $produto = Produto::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $produto->delete();

        Produto::clearUserCache(Auth::id());

        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso.');
    }
}