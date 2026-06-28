@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-dark mb-0">Registrar Pedido</h2>
                <a href="{{ route('pedidos.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm fw-medium px-3 rounded-2">
                    Voltar
                </a>
            </div>

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('pedidos.store') }}" method="POST">
                        @csrf
                        
                        <h5 class="fw-bold text-secondary mb-3 pb-2 border-bottom">Dados do Cliente</h5>
                        <div class="mb-4">
                            <label for="nome_cliente" class="form-label fw-semibold text-secondary">Nome do Cliente</label>
                            <input type="text" name="nome_cliente" id="nome_cliente" class="form-control form-control-lg bg-light border-0" placeholder="Ex: Ruan Carlos" required autofocus>
                        </div>
                        
                        <h5 class="fw-bold text-secondary mb-3 pb-2 border-bottom mt-5">Carrinho de Compras</h5>
                        
                        <div id="itens-pedido">
                            <div class="row align-items-end item-row mb-3">
                                <div class="col-8">
                                    <label class="form-label fw-semibold text-secondary">Produto</label>
                                    <select name="produtos[]" class="form-select form-select-lg bg-light border-0" required>
                                        <option value="" disabled selected>Selecione um produto...</option>
                                        @foreach($produtos as $produto)
                                            <option value="{{ $produto->id }}">{{ $produto->nome }} (R$ {{ number_format($produto->preco, 2, ',', '.') }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label class="form-label fw-semibold text-secondary">Qtd</label>
                                    <input type="number" name="quantidades[]" class="form-control form-control-lg bg-light border-0" value="1" min="1" required>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-outline-primary btn-sm fw-semibold mt-2 rounded-3" onclick="adicionarProduto()">
                            + Adicionar outro produto
                        </button>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5">
                            <a href="{{ route('pedidos.index') }}" class="btn btn-light px-4 py-2 fw-medium rounded-3 text-decoration-none text-dark">Cancelar</a>
                            <button type="submit" class="btn btn-primary shadow-sm px-4 py-2 fw-semibold rounded-3">
                                Finalizar Venda
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // Função para duplicar os campos e permitir adicionar vários produtos!
    function adicionarProduto() {
        const container = document.getElementById('itens-pedido');
        const linhaOriginal = container.querySelector('.item-row');
        const novaLinha = linhaOriginal.cloneNode(true);
        
        // Limpa os valores ao criar a linha nova
        novaLinha.querySelector('select').value = '';
        novaLinha.querySelector('input[type="number"]').value = '1';
        
        container.appendChild(novaLinha);
    }
</script>
@endsection