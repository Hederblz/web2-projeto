@extends('layouts.app')

@section('content')
<div class="container py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark mb-0">Pedidos</h2>
        <a href="{{ route('pedidos.create') }}" class="btn btn-primary shadow-sm px-4 py-2 fw-semibold rounded-3 d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="me-2" viewBox="0 0 16 16">
              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
            Novo Pedido
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-uppercase text-secondary fw-semibold py-3 px-4" style="font-size: 0.85rem; border-bottom: 2px solid #eaeaea;">Pedido</th>
                            <th class="text-uppercase text-secondary fw-semibold py-3 px-4" style="font-size: 0.85rem; border-bottom: 2px solid #eaeaea;">Cliente</th>
                            <th class="text-uppercase text-secondary fw-semibold py-3 px-4" style="font-size: 0.85rem; border-bottom: 2px solid #eaeaea;">Itens</th>
                            <th class="text-uppercase text-secondary fw-semibold py-3 px-4" style="font-size: 0.85rem; border-bottom: 2px solid #eaeaea;">Total</th>
                            <th class="text-uppercase text-secondary fw-semibold py-3 px-4" style="font-size: 0.85rem; border-bottom: 2px solid #eaeaea;">Status</th>
                            <th class="text-uppercase text-secondary fw-semibold py-3 px-4 text-center" style="font-size: 0.85rem; border-bottom: 2px solid #eaeaea;">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse ($pedidos as $pedido)
                            <tr>
                                <td class="px-4 py-3 text-muted fw-bold">
                                    #{{ str_pad($pedido->id, 4, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-4 py-3 fw-medium text-dark">
                                    {{ $pedido->nome_cliente }}
                                </td>
                                <td class="px-4 py-3 text-muted">
                                    {{ $pedido->produtos->count() }} itens
                                </td>
                                <td class="px-4 py-3 fw-bold text-success">
                                    R$ {{ number_format($pedido->total, 2, ',', '.') }}
                                </td>
                                <td class="px-4 py-3">
                                    @php
                                        $badgeClass = match($pedido->status) {
                                            'Pago'      => 'bg-success text-success border-success',
                                            'Cancelado' => 'bg-danger text-danger border-danger',
                                            default     => 'bg-warning text-warning border-warning',
                                        };
                                    @endphp
                                    <span class="badge border bg-opacity-10 {{ $badgeClass }} px-2 py-1 rounded-pill">
                                        {{ $pedido->status }}
                                    </span>
                                </td>
                               <td class="px-4 py-3 text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-outline-secondary btn-sm shadow-sm fw-medium px-3 rounded-2">
                                            Ver
                                        </a>
        
                                        <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-warning btn-sm shadow-sm fw-medium px-3 rounded-2 text-dark" style="background-color: #ffc107; border: none;">
                                            Status
                                        </a>
        
                                        <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir o pedido #{{ $pedido->id }}?');">
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
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted d-flex flex-column align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="mb-3 opacity-50" viewBox="0 0 16 16">
                                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z"/>
                                        </svg>
                                        <h5 class="fw-bold mb-1">Nenhum pedido encontrado</h5>
                                        <p class="small mb-0">Clique em "Novo Pedido" para registrar sua primeira venda.</p>
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