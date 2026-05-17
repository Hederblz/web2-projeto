@extends('layouts.app')

@section('content')
<div class="container py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark mb-0">Categorias</h2>
        <a href="{{ route('categorias.create') }}" class="btn btn-primary shadow-sm px-4 py-2 fw-semibold rounded-3 d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="me-2" viewBox="0 0 16 16">
              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
            Nova Categoria
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="text-uppercase text-secondary fw-semibold py-3 px-4" style="font-size: 0.85rem; border-bottom: 2px solid #eaeaea;">
                                ID
                            </th>
                            <th scope="col" class="text-uppercase text-secondary fw-semibold py-3 px-4" style="font-size: 0.85rem; border-bottom: 2px solid #eaeaea;">
                                Nome da Categoria
                            </th>
                            <th scope="col" class="text-uppercase text-secondary fw-semibold py-3 px-4 text-center" style="font-size: 0.85rem; border-bottom: 2px solid #eaeaea;">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse ($categorias as $categoria)
                            <tr>
                                <td class="px-4 py-3 text-muted">
                                    #{{ $categoria->id }}
                                </td>
                                <td class="px-4 py-3 fw-medium text-dark">
                                    {{ $categoria->nome }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning btn-sm shadow-sm fw-medium px-3 me-2 rounded-2" style="color: #664d03; background-color: #ffc107; border: none;">
                                            Editar
                                        </a>
                                        
                                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir a categoria {{ $categoria->nome }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm shadow-sm fw-medium px-3 rounded-2" style="border: none;">
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5">
                                    <div class="text-muted d-flex flex-column align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="mb-3 opacity-50" viewBox="0 0 16 16">
                                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                            <path d="M4.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-7z"/>
                                        </svg>
                                        <h5 class="fw-bold mb-1">Nenhuma categoria encontrada</h5>
                                        <p class="small mb-0">Clique em "Nova Categoria" para começar a cadastrar.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection