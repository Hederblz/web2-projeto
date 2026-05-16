@extends('layouts.app')

@section('content')
<h2>Nova Categoria</h2>

<form action="{{ route('categorias.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nome" class="form-label">Nome da Categoria</label>
        <input type="text" name="nome" id="nome" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Voltar</a>
</form>
@endsection