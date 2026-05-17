@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Categorias</h2>
    <a href="{{ route('categorias.create') }}" class="btn btn-primary">Nova Categoria</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categorias as $categoria)
        <tr>
            <td>{{ $categoria->id }}</td>
            <td>{{ $categoria->nome }}</td>
            <td>
                <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="d-inline">
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