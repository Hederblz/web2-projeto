@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-dark mb-0">Editar Produto</h2>
                <a href="{{ route('produtos.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm fw-medium px-3 rounded-2">
                    Voltar
                </a>
            </div>

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="nome" class="form-label fw-semibold text-secondary">Nome do Produto</label>
                            <input type="text" name="nome" id="nome" class="form-control form-control-lg bg-light border-0" value="{{ $produto->nome }}" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="categoria_id" class="form-label fw-semibold text-secondary">Categoria</label>
                            <select name="categoria_id" id="categoria_id" class="form-select form-select-lg bg-light border-0" required>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ $produto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="preco" class="form-label fw-semibold text-secondary">Preço</label>
                                <div class="input-group input-group-lg shadow-none">
                                    <span class="input-group-text bg-light border-0 text-secondary">R$</span>
                                    <input type="number" step="0.01" name="preco" id="preco" class="form-control bg-light border-0" value="{{ $produto->preco }}" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <label for="estoque" class="form-label fw-semibold text-secondary">Estoque</label>
                                <input type="number" name="estoque" id="estoque" class="form-control form-control-lg bg-light border-0" value="{{ $produto->estoque }}" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="descricao" class="form-label fw-semibold text-secondary">Descrição</label>
                            <textarea name="descricao" id="descricao" class="form-control bg-light border-0" rows="4">{{ $produto->descricao }}</textarea>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5">
                            <a href="{{ route('produtos.index') }}" class="btn btn-light px-4 py-2 fw-medium rounded-3 text-decoration-none text-dark">Cancelar</a>
                            <button type="submit" class="btn btn-warning shadow-sm px-4 py-2 fw-semibold rounded-3" style="color: #664d03; background-color: #ffc107; border: none;">
                                Atualizar Produto
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
