@extends('layouts.app')

@section('content')
<h2>Editar Produto</h2>

<form action="{{ route('produtos.update', $produto->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nome" class="form-label">Nome do Produto</label>
        <input type="text" name="nome" id="nome" class="form-control" value="{{ $produto->nome }}" required>
    </div>

    <div class="mb-3">
        <label for="categoria_id" class="form-label">Categoria</label>
        <select name="categoria_id" id="categoria_id" class="form-control" required>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ $produto->categoria_id == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input type="number" step="0.01" name="preco" id="preco" class="form-control" value="{{ $produto->preco }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="estoque" class="form-label">Estoque</label>
            <input type="number" name="estoque" id="estoque" class="form-control" value="{{ $produto->estoque }}" required>
        </div>
    </div>

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea name="descricao" id="descricao" class="form-control" rows="3">{{ $produto->descricao }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">Atualizar</button>
    <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Voltar</a>
</form>
@endsection
