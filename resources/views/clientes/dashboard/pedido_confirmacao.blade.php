<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Confirmado — FarmaConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Podes incluir o mesmo CSS do carrinho ou um específico */
        .confirmation-card {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(0,0,0,.08);
            padding: 2rem;
            margin-top: 2rem;
            text-align: center;
        }
        .success-icon {
            font-size: 4rem;
            color: #16a34a;
            margin-bottom: 1rem;
        }
        .delivery-detail {
            background: var(--soft);
            border-radius: 16px;
            padding: 1rem;
            margin-top: 1.5rem;
            display: inline-block;
        }
        .order-info {
            text-align: left;
            margin-top: 2rem;
        }
    </style>
</head>
<body>

@include('clientes.dashboard.header')

<div class="container mt-5 mb-5">
    <div class="confirmation-card">
        <div class="success-icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <h2 class="mb-3">Pedido confirmado! 🎉</h2>
        <p class="text-muted">Obrigado pela sua compra. O seu pedido foi enviado para a farmácia.</p>

        <div class="delivery-detail">
            <p class="mb-1"><strong>🚚 Taxa de entrega:</strong> 
                {{ number_format($entrega->taxa_entrega ?? 0, 0, ',', '.') }} Kz
            </p>
            <p class="mb-0"><strong>📍 Distância percorrida:</strong> 
                {{ number_format($entrega->distancia_km ?? 0, 2, ',', '.') }} km
            </p>
        </div>

        <div class="order-info">
            <h5>Detalhes do pedido #{{ str_pad($pedido->id, 4, '0', STR_PAD_LEFT) }}</h5>
            <p><strong>Farmácia:</strong> {{ $pedido->farmacia->name ?? '—' }}</p>
            <p><strong>Endereço de entrega:</strong> {{ $pedido->endereco }}</p>
            <p><strong>Método de pagamento:</strong> {{ $pedido->pagamento->metodo ?? '—' }}</p>
            <hr>
            <h6>Itens:</h6>
            <ul class="list-unstyled">
                @foreach($pedido->items as $item)
                    <li>
                        {{ $item->stockItem->medicamento->name }} × {{ $item->quantidade }}
                        – {{ number_format($item->preco_unitario * $item->quantidade, 0, ',', '.') }} Kz
                    </li>
                @endforeach
            </ul>
            <h5 class="mt-3">Total: {{ number_format($pedido->total, 0, ',', '.') }} Kz</h5>
        </div>

        <div class="mt-4">
            <a href="{{ route('index.clientes') }}" class="btn btn-primary">Voltar à página inicial</a>
            <a href="{{ route('pedidos.clientes') }}" class="btn btn-outline-secondary ms-2">Meus pedidos</a>
        </div>
    </div>
</div>

@include('clientes.dashboard.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>