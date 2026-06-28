@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ route('produtos.create') }}">

<div class="produtos-page">

    <div class="page-header">
        <div>
            <p class="page-header__eyebrow">Detalhes da Venda</p>
            <h1 class="page-header__title">Pedido #{{ str_pad($pedido->id, 4, '0', STR_PAD_LEFT) }}</h1>
        </div>
        <a href="{{ route('pedidos.index') }}" class="p-btn p-btn--ghost">
            ← Voltar
        </a>
    </div>

    <div class="form-card" style="margin-bottom: 24px; padding: 24px 32px;">
        <div class="p-row">
            <div>
                <p class="p-label" style="margin-bottom: 4px;">Cliente</p>
                <h4 style="margin: 0; color: var(--p-text); font-weight: 700;">{{ $pedido->nome_cliente }}</h4>
            </div>
            <div>
                <p class="p-label" style="margin-bottom: 4px;">Data da Compra</p>
                <p style="margin: 0; color: var(--p-text-2); font-weight: 500;">{{ $pedido->created_at->format('d/m/Y \à\s H:i') }}</p>
            </div>
            <div>
                <p class="p-label" style="margin-bottom: 4px;">Status</p>
                @php
                    $statusConfig = [
                        'Pendente'  => 'background: #fff8e6; color: #c07a00; border-color: #fde68a;',
                        'Pago'      => 'background: #e6f4ea; color: #16a34a; border-color: #bbf7d0;',
                        'Cancelado' => 'background: #fce8e6; color: #dc2626; border-color: #fecaca;',
                    ];
                    $style = $statusConfig[$pedido->status] ?? $statusConfig['Pendente'];
                @endphp
                <span class="badge-cat" style="{{ $style }} font-size: 0.85rem;">
                    {{ $pedido->status }}
                </span>
            </div>
            <div>
                <p class="p-label" style="margin-bottom: 4px;">Total do Pedido</p>
                <h3 style="margin: 0; color: var(--p-success); font-family: var(--p-font-d); font-weight: 800;">
                    R$ {{ number_format($pedido->total, 2, ',', '.') }}
                </h3>
            </div>
        </div>
    </div>

    <div class="table-card">
        <div style="overflow-x: auto;">
            <table class="p-table">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Preço Unitário</th>
                        <th>Quantidade</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedido->produtos as $produto)
                        <tr>
                            <td><span class="td-name">{{ $produto->nome }}</span></td>
                            
                            <td><span class="td-price" style="color: var(--p-text-2);">R$ {{ number_format($produto->pivot->preco_unitario, 2, ',', '.') }}</span></td>
                            
                            <td><span class="td-stock">{{ $produto->pivot->quantidade }} un</span></td>
                            
                            <td>
                                <span class="td-price">
                                    R$ {{ number_format($produto->pivot->preco_unitario * $produto->pivot->quantidade, 2, ',', '.') }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection