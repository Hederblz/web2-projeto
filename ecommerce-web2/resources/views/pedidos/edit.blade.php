@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-dark mb-0">Atualizar Status</h2>
                <a href="{{ route('pedidos.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm fw-medium px-3 rounded-2">
                    Voltar
                </a>
            </div>

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-secondary">Pedido</label>
                            <input type="text" class="form-control form-control-lg bg-light border-0" value="#{{ str_pad($pedido->id, 4, '0', STR_PAD_LEFT) }} - {{ $pedido->nome_cliente }}" disabled>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="form-label fw-semibold text-secondary">Situação do Pagamento/Envio</label>
                            <select name="status" id="status" class="form-select form-select-lg bg-light border-0" required>
                                <option value="Pendente" {{ $pedido->status == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                                <option value="Pago" {{ $pedido->status == 'Pago' ? 'selected' : '' }}>Pago / Concluído</option>
                                <option value="Cancelado" {{ $pedido->status == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                        </div>
                        
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary shadow-sm py-2 fw-semibold rounded-3">
                                Salvar Alteração
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection