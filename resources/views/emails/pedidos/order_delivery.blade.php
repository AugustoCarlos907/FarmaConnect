<!DOCTYPE html>
<html>
<head>
    <title>Pedido em entrega</title>
</head>
<body>
    <h1>Olá, {{ $pedido->user->name }}!</h1>
    <p>O seu pedido <strong>#{{ str_pad($pedido->id, 4, '0', STR_PAD_LEFT) }}</strong> está a caminho!</p>

    <h2>Detalhes da entrega</h2>
    <ul>
        <li>Distância: {{ number_format($entrega->distancia_km, 2, ',', '.') }} km</li>
        <li>Taxa de entrega: {{ number_format($entrega->taxa_entrega, 2, ',', '.') }} Kz</li>
        <li>Endereço: {{ $pedido->endereco }}</li>
    </ul>

    <h2>Itens do pedido</h2>
    <ul>
        @foreach($pedido->items as $item)
            @php
        $medicamento = optional($item->stockItem->medicamento);
        @endphp
        <li>
            {{ $medicamento->name ?: 'Produto' }} × {{ $item->quantidade }}
            – {{ number_format($item->preco_unitario * $item->quantidade, 0, ',', '.') }} Kz
        </li>
        @endforeach
    </ul>

    <p><strong>Total: {{ number_format($pedido->total + $entrega->taxa_entrega, 0, ',', '.') }} Kz</strong></p>

    <p><a href="{{ route('pedidos.clientes') }}">Acompanhar pedido</a></p>
    <p>Obrigado por escolher a FarmaConnect!</p>
</body>
</html>