<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fatura #{{ $factura->numero_factura }}</title>
  <style>
    @page {
      margin: 0;
      size: A4;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'DejaVu Sans', Arial, sans-serif;
      font-size: 12px;
      color: #1a2e35;
      background: #ffffff;
      line-height: 1.5;
    }

    /* ===== ACCENT BAR TOP ===== */
    .accent-bar {
      height: 6px;
      background: linear-gradient(90deg, #099aa7 0%, #0ec4d4 100%);
    }

    /* ===== WRAPPER ===== */
    .wrapper {
      padding: 36px 48px 48px;
    }

    /* ===== HEADER ===== */
    .header {
      display: table;
      width: 100%;
      margin-bottom: 36px;
    }

    .header-left {
      display: table-cell;
      vertical-align: middle;
      width: 60%;
    }

    .header-right {
      display: table-cell;
      vertical-align: middle;
      text-align: right;
      width: 40%;
    }

    .brand-name {
      font-size: 32px;
      font-weight: 900;
      letter-spacing: -1px;
      color: #099aa7;
      line-height: 1;
    }

    .brand-name span {
      color: #1a2e35;
    }

    .brand-tagline {
      font-size: 10px;
      color: #6c8285;
      margin-top: 3px;
      letter-spacing: 1px;
      text-transform: uppercase;
    }

    .doc-type {
      font-size: 11px;
      font-weight: 700;
      color: #099aa7;
      letter-spacing: 2px;
      text-transform: uppercase;
      background: #eaf6f5;
      padding: 6px 16px;
      border-radius: 20px;
      display: inline-block;
      margin-bottom: 6px;
    }

    .doc-number {
      font-size: 22px;
      font-weight: 800;
      color: #1a2e35;
    }

    /* ===== DIVIDER ===== */
    .divider {
      height: 1px;
      background: #e4f0f0;
      margin-bottom: 28px;
    }

    /* ===== META TABLE ===== */
    .meta-section {
      display: table;
      width: 100%;
      margin-bottom: 28px;
    }

    .meta-left {
      display: table-cell;
      width: 50%;
      vertical-align: top;
    }

    .meta-right {
      display: table-cell;
      width: 50%;
      vertical-align: top;
    }

    .meta-block {
      margin-bottom: 20px;
    }

    .meta-label {
      font-size: 9px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1.2px;
      color: #099aa7;
      margin-bottom: 6px;
      border-bottom: 1.5px solid #eaf6f5;
      padding-bottom: 4px;
    }

    .meta-value {
      font-size: 12px;
      color: #1a2e35;
      font-weight: 500;
      line-height: 1.6;
    }

    .meta-value strong {
      font-weight: 700;
    }

    /* Info rows lado direito */
    .info-grid {
      width: 100%;
    }

    .info-row {
      display: table;
      width: 100%;
      margin-bottom: 5px;
    }

    .info-key {
      display: table-cell;
      font-size: 9.5px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .8px;
      color: #6c8285;
      width: 50%;
      padding: 3px 0;
    }

    .info-val {
      display: table-cell;
      font-size: 11px;
      font-weight: 700;
      color: #1a2e35;
      text-align: right;
      padding: 3px 0;
    }

    .badge-status {
      display: inline-block;
      padding: 3px 10px;
      border-radius: 20px;
      font-size: 9.5px;
      font-weight: 800;
      letter-spacing: .5px;
      text-transform: uppercase;
    }

    .badge-pago     { background: #d4edda; color: #155724; }
    .badge-pendente { background: #fff3cd; color: #856404; }
    .badge-cancelado{ background: #f8d7da; color: #721c24; }

    /* ===== ADDRESSES ===== */
    .addr-section {
      display: table;
      width: 100%;
      margin-bottom: 28px;
    }

    .addr-col {
      display: table-cell;
      width: 50%;
      vertical-align: top;
    }

    /* ===== ITEMS TABLE ===== */
    .items-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 24px;
    }

    .items-table thead tr {
      background: #099aa7;
      color: #ffffff;
    }

    .items-table thead th {
      padding: 10px 14px;
      font-size: 9.5px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .8px;
    }

    .items-table thead th:first-child { border-radius: 8px 0 0 0; }
    .items-table thead th:last-child  { border-radius: 0 8px 0 0; }

    .items-table tbody tr {
      border-bottom: 1px solid #eaf6f5;
    }

    .items-table tbody tr:nth-child(even) {
      background: #f7fbfb;
    }

    .items-table tbody td {
      padding: 11px 14px;
      font-size: 11.5px;
      color: #1a2e35;
      vertical-align: middle;
    }

    .item-name {
      font-weight: 600;
    }

    .item-qty {
      text-align: center;
      color: #6c8285;
      font-weight: 600;
    }

    .item-price {
      text-align: right;
      color: #6c8285;
    }

    .item-total {
      text-align: right;
      font-weight: 700;
      color: #1a2e35;
    }

    /* ===== TOTALS ===== */
    .totals-section {
      display: table;
      width: 100%;
      margin-bottom: 28px;
    }

    .totals-left {
      display: table-cell;
      width: 55%;
      vertical-align: bottom;
    }

    .totals-right {
      display: table-cell;
      width: 45%;
      vertical-align: top;
    }

    .totals-box {
      border: 1.5px solid #e4f0f0;
      border-radius: 12px;
      overflow: hidden;
    }

    .total-row {
      display: table;
      width: 100%;
      padding: 9px 16px;
      border-bottom: 1px solid #eaf6f5;
    }

    .total-row:last-child { border-bottom: none; }

    .total-key {
      display: table-cell;
      font-size: 10.5px;
      color: #6c8285;
      font-weight: 500;
    }

    .total-val {
      display: table-cell;
      font-size: 11px;
      color: #1a2e35;
      font-weight: 600;
      text-align: right;
    }

    .total-row.grand {
      background: #099aa7;
      padding: 12px 16px;
    }

    .total-row.grand .total-key {
      color: rgba(255,255,255,.85);
      font-size: 11px;
      font-weight: 700;
    }

    .total-row.grand .total-val {
      color: #ffffff;
      font-size: 15px;
      font-weight: 800;
    }

    /* ===== PAYMENT INFO ===== */
    .payment-note {
      font-size: 10.5px;
      color: #6c8285;
      line-height: 1.6;
    }

    .payment-note strong {
      color: #1a2e35;
      font-weight: 700;
    }

    /* ===== FOOTER ===== */
    .footer-divider {
      height: 2px;
      background: #eaf6f5;
      margin: 28px 0 20px;
    }

    .footer-section {
      display: table;
      width: 100%;
    }

    .footer-left {
      display: table-cell;
      width: 65%;
      vertical-align: top;
    }

    .footer-right {
      display: table-cell;
      width: 35%;
      vertical-align: top;
      text-align: right;
    }

    .footer-title {
      font-size: 9px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: #099aa7;
      margin-bottom: 6px;
    }

    .footer-text {
      font-size: 9.5px;
      color: #6c8285;
      line-height: 1.7;
    }

    .footer-brand {
      font-size: 14px;
      font-weight: 900;
      color: #099aa7;
    }

    .footer-brand span { color: #1a2e35; }

    .footer-sub {
      font-size: 8.5px;
      color: #a0b9bc;
      margin-top: 2px;
    }

    /* ===== ACCENT BAR BOTTOM ===== */
    .accent-bar-bottom {
      height: 4px;
      background: linear-gradient(90deg, #0ec4d4 0%, #099aa7 100%);
      margin-top: 32px;
    }

    /* Utility */
    .text-right { text-align: right; }
    .text-center { text-align: center; }
    .fw-700 { font-weight: 700; }
    .color-accent { color: #099aa7; }
  </style>
</head>
<body>

  <div class="accent-bar"></div>

  <div class="wrapper">

    <!-- ===== HEADER ===== -->
    <div class="header">
      <div class="header-left">
        <div class="brand-name">Farma<span>Connect</span></div>
        <div class="brand-tagline">Plataforma de Saúde Digital · Angola</div>
      </div>
      <div class="header-right">
        <div class="doc-type">Fatura</div>
        <div class="doc-number"># {{ $factura->numero_factura }}</div>
      </div>
    </div>

    <div class="divider"></div>

    <!-- ===== META INFO ===== -->
    <div class="meta-section">
      <div class="meta-left">

        <!-- DE (Emitida por) -->
        <div class="meta-block">
          <div class="meta-label">Emitida por</div>
          <div class="meta-value">
            <strong>{{ $factura->pedido->farmacia->name }}</strong><br>
            {{$factura->pedido->farmacia->bairro}}<br>
           {{ $factura->pedido->farmacia->municipio }}<br>
           {{ $factura->pedido->farmacia->nif }}
          </div>
        </div>

        <!-- COBRAR A -->
        <div class="meta-block">
          <div class="meta-label">Cobrar a</div>
          <div class="meta-value">
            <strong>{{ $factura->user->name }}</strong><br>
            {{ $factura->user->email }}<br>
            @if($factura->user->telefone)
              {{ $factura->user->telefone }}<br>
            @endif
            @if($factura->user->endereco)
              {{ $factura->user->endereco }}
            @endif
          </div>
        </div>

      </div>

      <div class="meta-right">
        <div class="meta-block">
          <div class="meta-label">Detalhes da fatura</div>
          <div class="info-grid">

            <div class="info-row">
              <div class="info-key">Fatura Nº</div>
              <div class="info-val">{{ $factura->numero_factura }}</div>
            </div>

            <div class="info-row">
              <div class="info-key">Pedido Nº</div>
              <div class="info-val">#{{ $factura->pedido_id }}</div>
            </div>

            <div class="info-row">
              <div class="info-key">Data de emissão</div>
              <div class="info-val">
                {{ \Carbon\Carbon::parse($factura->emitida_em)->format('d/m/Y') }}
              </div>
            </div>

            <div class="info-row">
              <div class="info-key">Data de vencimento</div>
              <div class="info-val">
                {{ \Carbon\Carbon::parse($factura->emitida_em)->addDays(15)->format('d/m/Y') }}
              </div>
            </div>

            <div class="info-row">
              <div class="info-key">Estado</div>
              <div class="info-val">
                @php
                  $statusMap = [
                    'pago'      => 'badge-pago',
                    'pendente'  => 'badge-pendente',
                    'cancelado' => 'badge-cancelado',
                  ];
                  $badgeClass = $statusMap[$factura->status] ?? 'badge-pendente';
                  $statusLabel = [
                    'pago'      => 'Pago',
                    'pendente'  => 'Pendente',
                    'cancelado' => 'Cancelado',
                  ][$factura->status] ?? ucfirst($factura->status);
                @endphp
                <span class="badge-status {{ $badgeClass }}">{{ $statusLabel }}</span>
              </div>
            </div>

            @if($factura->pagamento)
            <div class="info-row">
              <div class="info-key">Método de pagamento</div>
              <div class="info-val">{{ $factura->pedido->metodo_pagamento ?? '—' }}</div>
            </div>
            @endif

          </div>
        </div>
      </div>
    </div>

    <!-- ===== ITENS DO PEDIDO ===== -->
    @if($factura->pedido && $factura->pedido->items && $factura->pedido->items->count() > 0)
    <table class="items-table">
      <thead>
        <tr>
          <th style="width:50%; text-align:left;">Descrição</th>
          <th style="width:12%; text-align:center;">Qtd.</th>
          <th style="width:19%; text-align:right;">Preço unit.</th>
          <th style="width:19%; text-align:right;">Total</th>
        </tr>
      </thead>
      <tbody>
        @foreach($factura->pedido->items as $item)
        <tr>
          <td class="item-name">
            {{ $item->stockItem->medicamento->name ?? $item->descricao ?? 'Produto' }}
            @if(isset($item->stockItem->medicamento->dosagem))
              <br><span style="font-size:9.5px;color:#6c8285;font-weight:400;">{{ $item->stockItem->medicamento->dosagem }}</span>
            @endif
          </td>
          <td class="item-qty">{{ $item->quantidade }}</td>
          <td class="item-price">{{ number_format($item->preco_unitario, 2, ',', '.') }} Kz</td>
          <td class="item-total">{{ number_format($item->quantidade * $item->preco_unitario, 2, ',', '.') }} Kz</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @else
    {{-- Fallback: sem itens detalhados, mostra apenas o total --}}
    <table class="items-table">
      <thead>
        <tr>
          <th style="width:50%; text-align:left;">Descrição</th>
          <th style="width:12%; text-align:center;">Qtd.</th>
          <th style="width:19%; text-align:right;">Preço unit.</th>
          <th style="width:19%; text-align:right;">Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="item-name">Pedido #{{ $factura->pedido_id }} — Medicamentos</td>
          <td class="item-qty">{{ $factura->pedido->items->sum('quantidade') }}</td>
          @php
            $baseValue = $factura->valor_total / (1 + ($factura->iva / 100));
          @endphp
          <td class="item-price">{{ number_format($baseValue, 2, ',', '.') }} Kz</td>
          <td class="item-total">{{ number_format($baseValue, 2, ',', '.') }} Kz</td>
        </tr>
      </tbody>
    </table>
    @endif

    <!-- ===== TOTAIS ===== -->
    <div class="totals-section">

      <div class="totals-left">
        @if($factura->pagamento)
        <div class="payment-note">
          <div class="footer-title" style="margin-bottom:8px;">Informações de pagamento</div>
          @if($factura->pagamento->referencia)
            <strong>Referência:</strong> {{ $factura->pagamento->referencia }}<br>
          @endif
          @if($factura->pagamento->metodo)
            <strong>Via:</strong> {{ $factura->pagamento->metodo }}<br>
          @endif
          @if($factura->pagamento->pago_em)
            <strong>Pago em:</strong> {{ \Carbon\Carbon::parse($factura->pagamento->pago_em)->format('d/m/Y H:i') }}
          @endif
        </div>
        @endif
      </div>

      <div class="totals-right">
        <div class="totals-box">

          @php
            $iva = $factura->iva ?? 14;
            $totalComIva = $factura->valor_total;
            $subtotal = $totalComIva / (1 + ($iva / 100));
            $valorIva  = $totalComIva - $subtotal;
          @endphp

          <div class="total-row">
            <div class="total-key">Subtotal</div>
            <div class="total-val">{{ number_format($subtotal, 2, ',', '.') }} Kz</div>
          </div>

          <div class="total-row">
            <div class="total-key">IVA ({{ $iva }}%)</div>
            <div class="total-val">{{ number_format($valorIva, 2, ',', '.') }} Kz</div>
          </div>

          <div class="total-row grand">
            <div class="total-key">TOTAL</div>
            <div class="total-val">{{ number_format($totalComIva, 2, ',', '.') }} Kz</div>
          </div>

        </div>
      </div>
    </div>

    <!-- ===== FOOTER ===== -->
    <div class="footer-divider"></div>


  </div>

  <div class="accent-bar-bottom"></div>

</body>
</html>