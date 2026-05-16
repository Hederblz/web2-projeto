@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Produtos</h2>
    <a href="{{ route('produtos.create') }}" class="btn btn-primary">Novo Produto</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($produtos as $produto)
        <tr>
            <td>{{ $produto->id }}</td>
            <td>{{ $produto->nome }}</td>
            <td>{{ $produto->categoria->nome ?? 'Sem Categoria' }}</td>
            <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
            <td>{{ $produto->estoque }}</td>
            <td>
                <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection