@extends('layouts.app')

@section('content')
<h2>Editar Categoria</h2>

<form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nome" class="form-label">Nome da Categoria</label>
        <input type="text" name="nome" id="nome" class="form-control" value="{{ $categoria->nome }}" required>
    </div>
    <button type="submit" class="btn btn-success">Atualizar</button>
    <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Voltar</a>
</form>
@endsection