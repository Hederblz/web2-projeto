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
        // Pega APENAS os produtos do usuário logado (com a categoria para otimizar)
        $produtos = Auth::user()->produtos()->with('categoria')->get();
        
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        // Manda pro formulário APENAS as categorias do usuário logado
        $categorias = Auth::user()->categorias;
        
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

        // Segurança Extra: Garante que o usuário não fraudou o HTML enviando um ID de categoria de outra pessoa
        $categoria = Categoria::where('id', $request->categoria_id)->where('user_id', Auth::id())->firstOrFail();

        Produto::create([
            'nome' => $request->nome,
            'categoria_id' => $categoria->id,
            'preco' => $request->preco,
            'estoque' => $request->estoque,
            'descricao' => $request->descricao,
            'user_id' => Auth::id(), // Salva o dono do produto
        ]);

        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso.');
    }

    public function edit($id)
    {
        // Segurança: Busca o produto APENAS se for do usuário logado
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

        // Verifica a categoria novamente
        $categoria = Categoria::where('id', $request->categoria_id)->where('user_id', Auth::id())->firstOrFail();

        $produto->update([
            'nome' => $request->nome,
            'categoria_id' => $categoria->id,
            'preco' => $request->preco,
            'estoque' => $request->estoque,
            'descricao' => $request->descricao,
        ]);

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso.');
    }

    public function destroy($id)
    {
        // Segurança: Busca e deleta
        $produto = Produto::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $produto->delete();

        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso.');
    }
}