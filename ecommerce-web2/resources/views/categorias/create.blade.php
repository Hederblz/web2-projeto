@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-dark mb-0">Nova Categoria</h2>
                <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm fw-medium px-3 rounded-2">
                    Voltar
                </a>
            </div>

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <form action="{{ route('categorias.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="nome" class="form-label fw-semibold text-secondary">Nome da Categoria</label>
                            <input type="text" name="nome" id="nome" class="form-control form-control-lg bg-light border-0" placeholder="Ex: Eletrônicos" required autofocus>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('categorias.index') }}" class="btn btn-light px-4 py-2 fw-medium rounded-3 text-decoration-none text-dark">Cancelar</a>
                            <button type="submit" class="btn btn-primary shadow-sm px-4 py-2 fw-semibold rounded-3">
                                Salvar Categoria
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection