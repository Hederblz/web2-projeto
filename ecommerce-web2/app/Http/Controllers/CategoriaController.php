<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::forUser(Auth::id());
        
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        // Cria a categoria e já atrela ao usuário logado
        Categoria::create([
            'nome' => $request->nome,
            'user_id' => Auth::id(),
        ]);

        Categoria::clearUserCache(Auth::id());

        return redirect()->route('categorias.index')->with('success', 'Categoria criada com sucesso.');
    }

    public function edit($id)
    {
        // Segurança: Busca a categoria APENAS se for do usuário logado
        $categoria = Categoria::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        // Segurança: Busca a categoria
        $categoria = Categoria::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $categoria->update([
            'nome' => $request->nome,
        ]);

        Categoria::clearUserCache(Auth::id());

        return redirect()->route('categorias.index')->with('success', 'Categoria atualizada com sucesso.');
    }

    public function destroy($id)
    {
        // Segurança: Busca e deleta
        $categoria = Categoria::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $categoria->delete();

        Categoria::clearUserCache(Auth::id());

        return redirect()->route('categorias.index')->with('success', 'Categoria excluída com sucesso.');
    }
}