<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrinho — FarmaConnect</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* (todos os estilos mantidos, iguais aos seus) */ 
    :root{--accent:#099aa7;--accent-dark:#067e8a;--heading:#1f2f31;--text:#363f40;--soft:#dff3f0;--mint:#eaf6f5;--muted:#6c8285;--border:#e4f0f0;--shadow:0 8px 32px rgba(9,154,167,.08);}
    *,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
    html{scroll-behavior:smooth;}
    body{font-family:'Inter',-apple-system,BlinkMacSystemFont,sans-serif;background:#f4f8f8;color:var(--text);overflow-x:hidden;}
    .header{background:rgba(255,255,255,.97);backdrop-filter:blur(16px);box-shadow:0 1px 0 rgba(9,154,167,.08),0 4px 24px rgba(9,154,167,.06);padding:.75rem 0;position:sticky;top:0;z-index:1000;transition:box-shadow .3s;}
    .header.scrolled{box-shadow:0 2px 28px rgba(9,154,167,.14);}
    .sitename{font-size:1.75rem;font-weight:800;letter-spacing:-.03em;line-height:1;margin:0;}
    .sitename .s1{color:var(--accent);}.sitename .s2{color:var(--heading);}
    .header-search{flex:1;max-width:560px;}
    .header-search .ig{border:1.5px solid var(--border);border-radius:50px;background:#f6fbfb;overflow:hidden;display:flex;align-items:center;transition:border-color .2s,box-shadow .2s;}
    .header-search .ig:focus-within{border-color:var(--accent);box-shadow:0 0 0 3px rgba(9,154,167,.1);}
    .header-search .ig-icon{padding:.6rem 0 .6rem 1.1rem;color:#a0b9bc;}
    .header-search .ig input{flex:1;border:none;background:transparent;font-size:.9rem;color:var(--heading);padding:.6rem .5rem;outline:none;font-family:inherit;}
    .header-search .ig input::placeholder{color:#b0c4c6;}
    .navmenu ul{margin:0;padding:0;list-style:none;display:flex;align-items:center;}
    .navmenu a{color:var(--heading);font-weight:600;font-size:.88rem;padding:.42rem .85rem;border-radius:50px;text-decoration:none;transition:.2s;white-space:nowrap;}
    .navmenu a:hover{background:var(--soft);color:var(--accent);}
    .hdr-icon{position:relative;color:var(--heading);font-size:1.3rem;text-decoration:none;transition:color .2s;}
    .hdr-icon:hover{color:var(--accent);}
    .hdr-badge{position:absolute;top:-6px;right:-8px;background:var(--accent);color:#fff;font-size:.6rem;font-weight:700;width:17px;height:17px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:2px solid #fff;}
    .profile-toggle{display:flex;align-items:center;gap:.5rem;text-decoration:none;color:var(--heading);}
    .profile-toggle .pname{font-weight:600;font-size:.88rem;}
    .dropdown-menu{border:none;box-shadow:0 12px 40px rgba(9,154,167,.12);border-radius:18px;padding:.5rem;min-width:180px;}
    .dropdown-item{border-radius:10px;font-size:.9rem;font-weight:500;padding:.55rem .9rem;transition:background .15s;}
    .dropdown-item:hover{background:var(--soft);color:var(--accent);}
    .dropdown-item.text-danger:hover{background:#fdecea;color:#c0392b;}
    .page-topbar{background:linear-gradient(138deg,#046a76 0%,#099aa7 52%,#0ec4d4 100%);padding:2.2rem 0 4.5rem;position:relative;overflow:hidden;}
    .page-topbar::before{content:'';position:absolute;inset:0;background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");}
    .tb-blob{position:absolute;border-radius:50%;filter:blur(60px);pointer-events:none;}
    .tb1{width:320px;height:320px;background:#fff;opacity:.08;top:-120px;right:-60px;}
    .tb2{width:220px;height:220px;background:#a8ffd4;opacity:.06;bottom:-80px;left:8%;}
    .topbar-inner{position:relative;z-index:2;}
    .breadcrumb-fc{display:flex;align-items:center;gap:.5rem;margin-bottom:.8rem;}
    .breadcrumb-fc a{color:rgba(255,255,255,.65);font-size:.83rem;text-decoration:none;}
    .breadcrumb-fc a:hover{color:#fff;}
    .breadcrumb-fc .sep{color:rgba(255,255,255,.35);font-size:.7rem;}
    .breadcrumb-fc .cur{color:#fff;font-size:.83rem;font-weight:600;}
    .page-topbar h2{color:#fff;font-size:1.85rem;font-weight:800;letter-spacing:-.02em;margin:0;}
    .page-topbar p{color:rgba(255,255,255,.68);font-size:.92rem;margin-top:.3rem;}
    .checkout-steps{display:flex;align-items:center;gap:0;margin-top:1.8rem;position:relative;z-index:2;}
    .cs-step{display:flex;align-items:center;gap:.6rem;flex:1;}
    .cs-step:last-child{flex:none;}
    .cs-dot{width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.88rem;font-weight:800;flex-shrink:0;}
    .cs-dot.done{background:#22c55e;color:#fff;}
    .cs-dot.current{background:#fff;color:var(--accent);box-shadow:0 0 0 4px rgba(255,255,255,.3);}
    .cs-dot.pending{background:rgba(255,255,255,.18);color:rgba(255,255,255,.5);}
    .cs-label{font-size:.8rem;font-weight:700;}
    .cs-label.done{color:#a8ffd4;}.cs-label.current{color:#fff;}.cs-label.pending{color:rgba(255,255,255,.45);}
    .cs-line{flex:1;height:2px;background:rgba(255,255,255,.2);margin:0 .6rem;}
    .cs-line.done{background:#22c55e;}
    .cart-wrap{margin-top:-2.2rem;padding-bottom:5rem;}
    .cart-card,.address-card,.delivery-card,.payment-card{background:#fff;border-radius:22px;box-shadow:var(--shadow);margin-bottom:1.2rem;overflow:hidden;animation:fadeUp .45s ease forwards;}
    .address-card{animation-delay:.06s;opacity:0;}
    .delivery-card{animation-delay:.12s;opacity:0;}
    .payment-card{animation-delay:.18s;opacity:0;}
    .prescricao-section {
    margin-top: 0.75rem;
    padding-top: 0.75rem;
    border-top: 1px solid var(--border);
    background-color: var(--surface-2);
    border-radius: 12px;
    padding: 0.75rem;
    }

    .prescricao-alert {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.75rem;
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
    }

    .prescricao-success {
        background-color: var(--success-light);
        color: #15803d;
    }

    .prescricao-link {
        margin-left: 0.5rem;
        text-decoration: underline;
        color: var(--accent);
    }

    .prescricao-form {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        align-items: center;
    }

    .prescricao-input {
        flex: 1;
        padding: 0.375rem 0.75rem;
        font-size: 0.75rem;
        border: 1px solid var(--border);
        border-radius: 6px;
        background: var(--surface);
    }

    .prescricao-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.375rem 0.75rem;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 6px;
        border: 1px solid var(--accent);
        background: var(--surface);
        color: var(--accent);
        cursor: pointer;
        transition: all 0.2s;
    }

    .prescricao-btn:hover {
        background: var(--accent-light);
        transform: translateY(-1px);
    }

    .prescricao-help {
        font-size: 0.7rem;
        color: var(--text-3);
        margin-top: 0.5rem;
        margin-bottom: 0;
    }

    /* ─── MODAL BACKDROP MAIS INTENSO ────────────────── */
    .modal-backdrop {
      background-color: rgba(0, 0, 0, 0.7) !important;  /* escurece o fundo */
      backdrop-filter: blur(4px);                       /* desfoca ligeiramente o conteúdo atrás */
      transition: backdrop-filter 0.2s ease;
    }

    /* ─── MODAL EM SI (centralizado, sombra, borda suave) ─── */
    .modal-content {
      border: none;
      border-radius: 28px;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
      overflow: hidden;
    }

    .modal-header {
      border-bottom: 1px solid var(--border);
      background: #fff;
      padding: 1.2rem 1.5rem;
    }

    .modal-header .modal-title {
      font-size: 1.1rem;
      font-weight: 800;
      color: var(--heading);
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .modal-body {
      padding: 1.2rem 1.5rem;
      background: #fff;
    }

    .modal-footer {
      border-top: 1px solid var(--border);
      background: #fafefe;
      padding: 1rem 1.5rem;
    }

    /* ─── ESTILO PARA CADA OPÇÃO DE ENDEREÇO DENTRO DO MODAL ─── */
    .addr-option-modal {
      border: 1.5px solid var(--border);
      border-radius: 20px;
      padding: 1rem 1.2rem;
      margin-bottom: 0.8rem;
      cursor: pointer;
      transition: all 0.2s ease;
      background: #fff;
    }

    .addr-option-modal:hover {
      border-color: var(--accent);
      background: var(--soft);
      transform: translateX(4px);
    }

    .addr-option-modal .ao-label {
      font-size: 0.7rem;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: var(--accent);
      margin-bottom: 0.2rem;
    }

    .addr-option-modal .ao-addr {
      font-size: 0.88rem;
      font-weight: 600;
      color: var(--heading);
      word-break: break-word;
    }

      /* ─── EXPRESS INFO CARD ───────────────────────────── */
    .express-info-card {
      display: flex;
      align-items: center;
      gap: 1rem;
      background: linear-gradient(135deg, #f0f9ff 0%, #e6f7f8 100%);
      border-radius: 20px;
      padding: 1.1rem 1.2rem;
      margin-bottom: 1rem;
      border: 1px solid rgba(9,154,167,.2);
      box-shadow: 0 4px 12px rgba(9,154,167,.08);
    }

    .express-info-icon {
      width: 48px;
      height: 48px;
      background: var(--accent);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .express-info-icon i {
      font-size: 1.4rem;
      color: white;
    }

    .express-info-content {
      flex: 1;
    }

    .express-info-label {
      font-size: 0.7rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: var(--accent-dark);
      margin-bottom: 0.2rem;
    }

    .express-info-number {
      font-family: 'Inter', monospace;
      font-size: 1.15rem;
      font-weight: 800;
      color: var(--heading);
      letter-spacing: 0.5px;
      margin-bottom: 0.2rem;
    }

    .express-info-hint {
      font-size: 0.68rem;
      color: var(--muted);
    }

    /* ─── UPLOAD AREA (estilo melhorado) ───────────────── */
    .upload-comprovativo-area {
      display: flex;
      align-items: center;
      gap: 1rem;
      background: var(--surface);
      border: 2px dashed var(--border);
      border-radius: 18px;
      padding: 0.9rem 1rem;
      cursor: pointer;
      transition: all 0.2s ease;
      margin-top: 0.75rem;
    }

    .upload-comprovativo-area:hover {
      border-color: var(--accent);
      background: var(--soft);
      transform: translateY(-1px);
    }

    .upload-icon {
      width: 44px;
      height: 44px;
      background: var(--mint);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .upload-icon i {
      font-size: 1.3rem;
      color: var(--accent);
    }

    .upload-text {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .upload-text strong {
      font-size: 0.82rem;
      font-weight: 700;
      color: var(--text);
    }

    .upload-text span {
      font-size: 0.7rem;
      color: var(--muted);
    }

    /* ─── PREVIEW DO FICHEIRO ─────────────────────────── */
    .comprovativo-preview {
      margin-top: 0.6rem;
      font-size: 0.75rem;
      color: var(--accent);
      display: flex;
      align-items: center;
      gap: 0.4rem;
      padding: 0.3rem 0.5rem;
      background: var(--surface-2);
      border-radius: 12px;
      width: fit-content;
    }

    /* ─── QUANDO O MODAL ESTÁ ABERTO, EVITA ROLAGEM DO FUNDO (opcional) ─── */
    body.modal-open {
      overflow: hidden;
      padding-right: 0 !important; /* evita salto lateral */
    }
    @keyframes fadeUp{from{opacity:0;transform:translateY(14px);}to{opacity:1;transform:none;}}
    .cc-head,.ac-head{padding:1.1rem 1.4rem;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;}
    .cc-head h6,.ac-head h6{font-size:.9rem;font-weight:800;color:var(--heading);margin:0;display:flex;align-items:center;gap:.5rem;}
    .cc-head h6 i,.ac-head h6 i{color:var(--accent);}
    .cc-clear{font-size:.78rem;font-weight:700;color:#ef4444;background:none;border:none;cursor:pointer;font-family:inherit;display:flex;align-items:center;gap:.35rem;}
    .cc-clear:hover{text-decoration:underline;}
    .cart-item{display:flex;align-items:flex-start;gap:1rem;padding:1.1rem 1.4rem;border-bottom:1px solid #f4f8f8;transition:background .15s;}
    .cart-item:last-child{border-bottom:none;}
    .cart-item:hover{background:#fafefe;}
    .ci-img{width:72px;height:72px;border-radius:14px;object-fit:cover;background:var(--mint);flex-shrink:0;}
    .ci-info{flex:1;min-width:0;}
    .ci-cat{font-size:.68rem;font-weight:700;color:var(--accent);text-transform:uppercase;letter-spacing:.05em;}
    .ci-name{font-size:.95rem;font-weight:700;color:var(--heading);line-height:1.3;margin:.1rem 0;}
    .ci-meta{font-size:.76rem;color:var(--muted);display:flex;align-items:center;gap:.5rem;flex-wrap:wrap;}
    .qty-ctrl{display:flex;align-items:center;gap:.5rem;margin-top:.65rem;}
    .qty-btn{width:30px;height:30px;border-radius:50%;border:1.5px solid var(--border);background:#fff;color:var(--heading);cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:.9rem;font-weight:700;transition:all .2s;}
    .qty-btn:hover:not(:disabled){background:var(--accent);color:#fff;border-color:var(--accent);}
    .qty-btn.minus:hover:not(:disabled){background:#ef4444;border-color:#ef4444;}
    .qty-btn:disabled{opacity:.4;cursor:default;}
    .qty-num{font-size:.92rem;font-weight:800;color:var(--heading);min-width:26px;text-align:center;}
    .ci-right{display:flex;flex-direction:column;align-items:flex-end;gap:.5rem;flex-shrink:0;}
    .ci-price{font-size:1.05rem;font-weight:800;color:var(--heading);}
    .ci-old{font-size:.75rem;color:var(--muted);}
    .ci-remove{background:none;border:none;color:#b0c4c6;cursor:pointer;font-size:.95rem;padding:.2rem;transition:color .2s;}
    .ci-remove:hover{color:#ef4444;}
    .ac-body{padding:1.2rem 1.4rem;}
    .addr-option{border:1.5px solid var(--border);border-radius:16px;padding:1rem 1.1rem;cursor:pointer;transition:all .22s;margin-bottom:.7rem;position:relative;}
    .addr-option:last-child{margin-bottom:0;}
    .addr-option:hover{border-color:var(--accent);background:var(--mint);}
    .addr-option.selected{border-color:var(--accent);background:var(--soft);}
    .addr-option.selected::after{content:'\2713';position:absolute;top:.8rem;right:1rem;background:var(--accent);color:#fff;width:22px;height:22px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.8rem;font-weight:800;}
    .ao-label{font-size:.72rem;font-weight:700;color:var(--accent);text-transform:uppercase;letter-spacing:.05em;margin-bottom:.2rem;}
    .ao-addr{font-size:.88rem;font-weight:700;color:var(--heading);}
    .ao-sub{font-size:.76rem;color:var(--muted);}
    .dc-body{padding:1.1rem 1.4rem;}
    .deliv-option{border:1.5px solid var(--border);border-radius:16px;padding:.9rem 1.1rem;cursor:pointer;transition:all .22s;margin-bottom:.7rem;display:flex;align-items:center;gap:1rem;position:relative;}
    .deliv-option:last-child{margin-bottom:0;}
    .deliv-option:hover{border-color:var(--accent);}
    .deliv-option.selected{border-color:var(--accent);background:var(--soft);}
    .deliv-name{font-size:.9rem;font-weight:700;color:var(--heading);}
    .deliv-sub{font-size:.76rem;color:var(--muted);}
    .deliv-price{margin-left:auto;font-size:.95rem;font-weight:800;color:var(--heading);flex-shrink:0;}
    .deliv-price.free{color:#22c55e;}
    .deliv-badge{position:absolute;top:-1px;right:12px;background:var(--accent);color:#fff;font-size:.65rem;font-weight:700;padding:.15rem .55rem;border-radius:0 0 8px 8px;}
    .pay-body{padding:1.1rem 1.4rem;}
    .pay-option{border:1.5px solid var(--border);border-radius:16px;padding:.85rem 1.1rem;cursor:pointer;transition:all .22s;margin-bottom:.7rem;display:flex;align-items:center;gap:.9rem;}
    .pay-option:last-child{margin-bottom:0;}
    .pay-option:hover{border-color:var(--accent);}
    .pay-option.selected{border-color:var(--accent);background:var(--soft);}
    .pay-icon{width:42px;height:42px;border-radius:12px;background:var(--mint);display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0;}
    .pay-name{font-size:.88rem;font-weight:700;color:var(--heading);}
    .pay-sub{font-size:.75rem;color:var(--muted);}
    .pay-radio{margin-left:auto;width:18px;height:18px;accent-color:var(--accent);flex-shrink:0;pointer-events:none;}
    .summary-card{background:#fff;border-radius:22px;box-shadow:var(--shadow);overflow:hidden;position:sticky;top:88px;}
    .sc-head{padding:1.1rem 1.4rem;border-bottom:1px solid var(--border);}
    .sc-head h6{font-size:.9rem;font-weight:800;color:var(--heading);margin:0;display:flex;align-items:center;gap:.5rem;}
    .sc-head h6 i{color:var(--accent);}
    .sc-body{padding:1.2rem 1.4rem;}
    .sum-item{display:flex;align-items:center;gap:.75rem;padding:.6rem 0;border-bottom:1px solid #f4f8f8;}
    .sum-item:last-child{border-bottom:none;}
    .sum-item-img{width:40px;height:40px;border-radius:10px;object-fit:cover;background:var(--mint);flex-shrink:0;}
    .sum-item-name{flex:1;font-size:.82rem;font-weight:600;color:var(--heading);min-width:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
    .sum-item-qty{font-size:.75rem;color:var(--muted);white-space:nowrap;}
    .sum-item-price{font-size:.84rem;font-weight:800;color:var(--heading);white-space:nowrap;}
    .tot-divider{height:1px;background:var(--border);margin:1rem 0;}
    .tot-row{display:flex;justify-content:space-between;align-items:center;font-size:.86rem;color:var(--muted);margin-bottom:.45rem;}
    .tot-row.bold{font-size:1.05rem;font-weight:800;color:var(--heading);margin-top:.6rem;padding-top:.6rem;border-top:2px dashed var(--border);}
    .checkout-btn{width:100%;padding:.85rem;background:linear-gradient(135deg,var(--accent),var(--accent-dark));color:#fff;border:none;border-radius:16px;font-size:1rem;font-weight:800;font-family:inherit;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:.6rem;transition:all .28s;margin-top:1rem;}
    .checkout-btn:hover:not(:disabled){transform:translateY(-2px);box-shadow:0 12px 32px rgba(9,154,167,.35);}
    .checkout-btn:disabled{opacity:.55;cursor:not-allowed;}
    .security-row{display:flex;align-items:center;justify-content:center;gap:1rem;padding:1rem 1.4rem;border-top:1px solid var(--border);flex-wrap:wrap;}
    .sec-badge{display:flex;align-items:center;gap:.35rem;font-size:.72rem;color:var(--muted);font-weight:600;}
    .sec-badge i{color:var(--accent);font-size:.85rem;}
    .alert-fc{border-radius:14px;padding:.85rem 1.1rem;font-size:.83rem;display:flex;align-items:flex-start;gap:.6rem;margin-bottom:1rem;}
    .alert-err{background:#fef2f2;border:1px solid #fecaca;color:#b91c1c;}
    .empty-cart{padding:4rem 2rem;text-align:center;}
    .empty-cart .ec-icon{font-size:4.5rem;display:block;margin-bottom:1rem;}
    .empty-cart h4{font-size:1.2rem;font-weight:800;color:var(--heading);margin-bottom:.4rem;}
    .empty-cart p{color:var(--muted);font-size:.9rem;max-width:300px;margin:0 auto 1.4rem;}
    .btn-go-shop{display:inline-flex;align-items:center;gap:.5rem;background:var(--accent);color:#fff;border:none;border-radius:50px;padding:.7rem 1.7rem;font-size:.9rem;font-weight:700;font-family:inherit;cursor:pointer;text-decoration:none;transition:all .25s;}
    .btn-go-shop:hover{background:var(--accent-dark);color:#fff;}
    .toast-fc{position:fixed;bottom:28px;right:28px;background:var(--heading);color:#fff;border-radius:16px;padding:1rem 1.4rem;display:flex;align-items:center;gap:.8rem;box-shadow:0 16px 40px rgba(0,0,0,.18);z-index:9999;transform:translateY(80px);opacity:0;transition:all .35s cubic-bezier(.34,1.56,.64,1);max-width:360px;pointer-events:none;}
    .toast-fc.show{transform:translateY(0);opacity:1;}
    .toast-fc i{font-size:1.3rem;color:#a8ffd4;flex-shrink:0;}
    .toast-fc strong{font-size:.9rem;display:block;}
    .toast-fc span{font-size:.78rem;color:rgba(255,255,255,.65);}
    .success-icon i {
    animation: pulse 0.5s ease-in-out;
    }
    @keyframes pulse {
        0% { transform: scale(0.8); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }
    @media(max-width:991px){.summary-card{position:static;margin-top:1.2rem;}}
    @media(max-width:768px){.header-search{display:none;}.ci-img{width:56px;height:56px;}}
    @media(max-width:576px){.cs-label{display:none;}}
  </style>
</head>
<body>

<!-- ═══ HEADER ═══ -->
@include('clientes.dashboard.header')

<!-- ═══ TOPBAR ═══ -->
<div class="page-topbar">
  <div class="tb-blob tb1"></div>
  <div class="tb-blob tb2"></div>
  <div class="container-xl topbar-inner">
    <div class="breadcrumb-fc">
      <a href="{{ route('index.clientes') }}"><i class="bi bi-house-door"></i> Início</a>
      <span class="sep"><i class="bi bi-chevron-right" style="font-size:.7rem"></i></span>
      <a href="{{ route('produtos.clientes') }}">Produtos</a>
      <span class="sep"><i class="bi bi-chevron-right" style="font-size:.7rem"></i></span>
      <span class="cur">Carrinho</span>
    </div>
    <h2>O meu carrinho</h2>
    <p>
      {{ $itens->count() }} {{ $itens->count() === 1 ? 'item' : 'itens' }}
      @if($itens->isNotEmpty())
        · {{ $itens->first()->stockItem->farmacia->name ?? 'Farmácia' }}
      @endif
    </p>
    <div class="checkout-steps">
      <div class="cs-step"><div class="cs-dot current"><i class="bi bi-bag"></i></div><span class="cs-label current">Carrinho</span></div>
      <div class="cs-line"></div>
      <div class="cs-step"><div class="cs-dot pending">2</div><span class="cs-label pending">Entrega</span></div>
      <div class="cs-line"></div>
      <div class="cs-step"><div class="cs-dot pending">3</div><span class="cs-label pending">Pagamento</span></div>
      <div class="cs-line"></div>
      <div class="cs-step"><div class="cs-dot pending"><i class="bi bi-check2"></i></div><span class="cs-label pending">Confirmação</span></div>
    </div>
  </div>
</div>

<!-- ═══ CONTEÚDO ═══ -->
<div class="cart-wrap">
  <div class="container-xl">

    @if($errors->any())
      <div class="alert-fc alert-err mt-5">
        <i class="bi bi-exclamation-circle-fill flex-shrink-0"></i>
        <span>{{ $errors->first() }}</span>
      </div>
    @endif
    @if(session('error'))
      <div class="alert-fc alert-err mt-5">
        <i class="bi bi-exclamation-circle-fill flex-shrink-0"></i>
        <span>{{ session('error') }}</span>
      </div>
    @endif

    <div class="row g-4">

      <!-- ═ COLUNA ESQUERDA ═ -->
      <div class="col-lg-8">

        <!-- ITENS -->
        <div class="cart-card mt-5">
          <div class="cc-head">
            <h6>
              <i class="bi bi-bag-heart"></i> Itens no carrinho
              <span style="background:var(--soft);color:var(--accent);border-radius:50px;padding:.08rem .55rem;font-size:.75rem">{{ $itens->count() }}</span>
            </h6>
            <form action="{{ route('carrinho.limpar') }}" method="POST" style="display:inline">
              @csrf @method('DELETE')
              <button type="submit" class="cc-clear" onclick="return confirm('Remover todos os itens?')">
                <i class="bi bi-trash3"></i> Limpar tudo
              </button>
            </form>
          </div>

          @forelse($itens as $item)
              @php
                  $med   = $item->stockItem->medicamento;
                  $farm  = $item->stockItem->farmacia;
                  $preco = $item->stockItem->preco;
                  $linha = $preco * $item->quantidade;
              @endphp
              <div class="cart-item" id="ci-{{ $item->id }}">
                  {{-- Imagem --}}
                  @if($med->imagem ?? false)
                      <img class="ci-img" src="{{ asset('storage/'.$med->imagem) }}" alt="{{ $med->name }}">
                  @else
                      <div class="ci-img d-flex align-items-center justify-content-center" style="font-size:2rem">💊</div>
                  @endif

                  {{-- Informações --}}
                  <div class="ci-info">
                      <div class="ci-cat">{{ $med->categoria->name ?? '—' }}</div>
                      <div class="ci-name">{{ $med->name }}</div>
                      <div class="ci-meta">
                          @if($med->forma_farmaceutica ?? false)
                              <span><i class="bi bi-box"></i> {{ $med->forma_farmaceutica }}{{ $med->dosagem ? ' · '.$med->dosagem : '' }}</span>
                          @endif
                          @if($farm)
                              <span><i class="bi bi-hospital"></i> {{ $farm->name }}</span>
                          @endif
                      </div>
                      <div class="qty-ctrl">
                          <form action="{{ route('carrinho.actualizar', $item) }}" method="POST">
                              @csrf @method('PATCH')
                              <input type="hidden" name="quantidade" value="{{ max(1, $item->quantidade - 1) }}">
                              <button type="submit" class="qty-btn minus" {{ $item->quantidade <= 1 ? 'disabled' : '' }}><i class="bi bi-dash"></i></button>
                          </form>
                          <span class="qty-num">{{ $item->quantidade }}</span>
                          <form action="{{ route('carrinho.actualizar', $item) }}" method="POST">
                              @csrf @method('PATCH')
                              <input type="hidden" name="quantidade" value="{{ $item->quantidade + 1 }}">
                              <button type="submit" class="qty-btn" {{ $item->quantidade >= ($item->stockItem->quantidade ?? 999) ? 'disabled' : '' }}><i class="bi bi-plus"></i></button>
                          </form>
                          <span style="font-size:.75rem;color:var(--muted);margin-left:.3rem">un.</span>
                      </div>
                  </div>

                  {{-- Preço e remover --}}
                  <div class="ci-right">
                      <div>
                          <div class="ci-price">{{ number_format($linha, 0, ',', '.') }} Kz</div>
                          <div class="ci-old">{{ number_format($med->preco, 0, ',', '.') }} Kz / un.</div>
                      </div>
                      <form action="{{ route('carrinho.remover', $item) }}" method="POST">
                          @csrf @method('DELETE')
                          <button type="submit" class="ci-remove" title="Remover"><i class="bi bi-trash3"></i></button>
                      </form>
                  </div>

                  {{-- Receita médica (apenas se necessário) --}}
                  @if($med->requer_receita)
                      <div class="prescricao-section">
                          @if($item->prescricao_path)
                              <div class="prescricao-alert prescricao-success">
                                  <i class="bi bi-check-circle-fill"></i> Receita anexada.
                                  <a href="{{ asset('storage/'.$item->prescricao_path) }}" target="_blank" class="prescricao-link">Ver</a>
                              </div>
                          @else
                              <form action="" method="POST" enctype="multipart/form-data" class="prescricao-form">
                                  @csrf
                                  <input type="file" name="receita" accept="image/*,application/pdf" class="prescricao-input" required>
                                  <button type="submit" class="prescricao-btn">
                                      <i class="bi bi-upload"></i> Anexar receita
                                  </button>
                              </form>
                              <p class="prescricao-help text-danger">{{strtoupper(' Medicamento sujeito a receita mÉdica. Anexe a receita para finalizar o pedido.')}}</p>
                          @endif
                      </div>
                  @endif
                  
              </div>
          @empty
              <div class="empty-cart">
                  <span class="ec-icon">🛒</span>
                  <h4>O seu carrinho está vazio</h4>
                  <p>Adicione medicamentos para continuar o seu pedido.</p>
                  <a href="{{ route('produtos.clientes') }}" class="btn-go-shop"><i class="bi bi-box-seam"></i> Ver produtos</a>
              </div>
          @endforelse
        </div>

        <!-- MORADA (apenas para Entrega Expresso) -->
      <div class="address-card" id="addressCardWrapper" style="display: none;">
        <div class="ac-head">
          <h6><i class="bi bi-geo-alt-fill"></i> Endereço de entrega</h6>
          <button type="button" class="btn btn-sm btn-outline-accent" style="font-size:.78rem;font-weight:700;color:var(--accent);border:1px solid var(--accent);border-radius:50px;padding:.2rem .8rem" onclick="abrirModalEnderecos()">
            <i class="bi bi-pencil"></i> Alterar
          </button>
        </div>
        <div class="ac-body" id="enderecoSelecionadoDisplay">
          <p class="text-muted" style="margin:0"><i class="bi bi-info-circle"></i> Nenhum endereço seleccionado</p>
        </div>
      </div>

      <!-- Modal com a lista de endereços -->
      <div class="modal fade" id="modalEnderecos" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="bi bi-geo-alt"></i> Selecione o endereço de entrega</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
              @forelse($enderecos as $endereco)
                <div class="addr-option-modal" 
                    onclick="selecionarEndereco(this)"
                    data-endereco="{{ $endereco->endereco }}"
                    data-lat="{{ $endereco->latitude ?? '' }}"
                    data-lng="{{ $endereco->longitude ?? '' }}"
                    data-label="{{ $endereco->name }}">
                  <div class="ao-label">{{ $endereco->name }}</div>
                  <div class="ao-addr">{{ $endereco->endereco }}</div>
                </div>
              @empty
                <p class="text-muted">
                  <i class="bi bi-exclamation-circle"></i> Nenhuma morada guardada.
                  <a href="{{ route('perfil.clientes') }}" style="color:var(--accent)">Adicionar agora</a>
                </p>
              @endforelse
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
          </div>
        </div>
      </div>


        <!-- ENTREGA -->
        <div class="delivery-card">
          <div class="ac-head"><h6><i class="bi bi-truck"></i> Tipo de entrega</h6></div>
          <div class="dc-body">
            <div class="deliv-option" onclick="selectDeliv('express')">
              <div><div class="deliv-name">Entrega Expresso</div><div class="deliv-sub">Calculado em função da distância em Km</div></div>
            </div>
            <div class="deliv-option" onclick="selectDeliv('retirada')">
              <div><div class="deliv-name">Retirar na Farmácia</div><div class="deliv-sub">Sem custo adicional</div></div>
              <div class="deliv-price free">Grátis</div>
            </div>
          </div>
        </div>

        <!-- PAGAMENTO -->
        <div class="payment-card">
          <div class="ac-head"><h6><i class="bi bi-credit-card-2-front"></i> Método de pagamento</h6></div>
          <div class="pay-body">
            <div class="pay-option " onclick="selectPay(this,'express')">
              <div class="pay-icon">📱</div>
              <div><div class="pay-name">Multicaixa Express</div><div class="pay-sub">Pagamento rápido via app do banco</div></div>
              <input type="radio" class="pay-radio" name="pay_ui" >
            </div>
            
            <!-- Área para pagamento Express (número + comprovativo) -->
            <div id="comprovativoExpressArea" style="display: none; margin-top: 1.5rem;">
                @php
                    $farmacia = $itens->first()->stockItem->farmacia ?? null;
                    $numeroExpress = $farmacia->numero_express ?? null;
                @endphp

                @if(!$numeroExpress)
                    <div class="alert-fc alert-err" style="margin-top: 0.75rem;">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        Seleccione o produto  de uma fármacia para ter  accesso às coordenadas bancárias disponíveis .                    
                    </div>

                @else
                {{-- Card com o número Express --}}
                <div class="express-info-card">
                    <div class="express-info-icon">
                        <i class="bi bi-phone-fill"></i>
                    </div>
                    <div class="express-info-content">
                        <div class="express-info-label">Pagamento via Multicaixa Express</div>
                        <div class="express-info-number">{{ $numeroExpress ?? 'Numero não disponível'  }}</div>
                        <div class="express-info-hint">
                            Utilize este número na aplicação do seu banco para efectuar o pagamento.
                        </div>
                    </div>
                </div>

                 <!-- Área de upload (agora sem input, apenas visual) -->
                  <div class="upload-comprovativo-area" onclick="document.getElementById('comprovativoExpressInput').click()">
                      <div class="upload-icon"><i class="bi bi-cloud-upload-fill"></i></div>
                      <div class="upload-text">
                          <strong>Clique para anexar o comprovativo</strong>
                          <span>Formatos: JPG, PNG, PDF (máx. 2MB)</span>
                      </div>
                  </div>
                  <div id="comprovativoPreview" class="comprovativo-preview"></div>

                @endif

            </div>

            <div class="pay-option" onclick="selectPay(this,'dinheiro')">
              <div class="pay-icon">💵</div>
              <div><div class="pay-name">Pagamento em Numerário</div><div class="pay-sub">Pague ao entregador na entrega ou no levantamento na farmácia</div></div>
              <input type="radio" class="pay-radio" name="pay_ui" checked>
            </div>
          </div>
        </div>

      </div>
      {{-- /col-lg-8 --}}

      <!-- ═ COLUNA DIREITA — RESUMO ═ -->
      <div class="col-lg-4 mt-5">
        <div class="summary-card">
          <div class="sc-head"><h6><i class="bi bi-receipt"></i> Resumo do pedido</h6></div>
          <div class="sc-body">

            <form action="{{ route('pedidos.store') }}" method="POST" id="formPedido" novalidate  
              enctype="multipart/form-data">
              @csrf

            {{-- items[] — um par por cada item no carrinho --}}
            @foreach($itens as $i => $item)
              <input type="hidden" name="items[{{ $i }}][stockId]"    value="{{ $item->stock_item_id }}">
              <input type="hidden" name="items[{{ $i }}][quantidade]" value="{{ $item->quantidade }}">
              <input type="hidden" name="items[{{ $i }}][prescricao_path]" value="{{ $item->prescricao_path }}">
            @endforeach

            {{-- endereco / lat / lng — valor inicial = primeira morada guardada --}}
            <input type="hidden" name="endereco"  id="h-endereco" value="">
            <input type="hidden" name="latitude"  id="h-lat"      value="">
            <input type="hidden" name="longitude" id="h-lng"      value="">
            <input type="hidden" name="taxa_entrega" id="taxaEntregaHidden" value="0">

            {{-- metodo_pagamento — valor inicial = express; actualizado pelo JS selectPay() --}}
            <input type="hidden" name="metodo_pagamento" id="h-metodo" value="express">

            {{-- Comprovativo para Multicaixa Express (ficheiro) --}}
            <input type="file" name="comprovativo_express" id="comprovativoExpressInput" style="display: none;">

            @foreach($itens as $item)
              @php 
              $med=$item->stockItem->medicamento; 
              $preco=$item->stockItem->preco; 
              @endphp

              <div class="sum-item">
                @if($med->imagem ?? false)
                  <img class="sum-item-img" src="{{ asset('storage/'.$med->imagem) }}" alt="{{ $med->name }}">
                @else
                  <div class="sum-item-img d-flex align-items-center justify-content-center" style="font-size:1.3rem">💊</div>
                @endif
                <div class="sum-item-name">{{ $med->name }}</div>
                <div class="sum-item-qty">×{{ $item->quantidade }}</div>
                <div class="sum-item-price">{{ number_format($med->preco*$item->quantidade,0,',','.') }} Kz</div>
              </div>
            @endforeach

            <div class="tot-divider"></div>
            <div class="tot-row"><span>Subtotal</span><span>{{ number_format($total,0,',','.') }} Kz</span></div>
            <div class="tot-row"><span>Taxa de entrega</span><span id="sumDelivery">-- Kz</span></div>            
            <div class="tot-row"><span>Distância</span><span id="sumDistance">-- km</span></div>
            <div class="tot-row bold"><span>Total</span><span id="sumTotal">{{ number_format($total,0,',','.') }} Kz</span></div>
            <div style="background:var(--mint);border-radius:12px;padding:.75rem 1rem;margin:1rem 0;font-size:.78rem;color:var(--muted);display:flex;align-items:center;gap:.5rem">
              <i class="bi bi-info-circle-fill" style="color:var(--accent);flex-shrink:0"></i>
              {{-- O pagamento só é cobrado após a confirmação da farmácia. --}}
            <span>Poderá acompanhar o estado do seu pedido em tempo real após a confirmação.</span>
            </div>


            <button type="submit" id="btnConfirmar" class="checkout-btn"
                    {{ $itens->isEmpty() ? 'disabled' : '' }}>
              <i class="bi bi-bag-check"></i> Confirmar pedido
            </button>

            </form>{{-- /formPedido --}}

          </div>
          <div class="security-row">
            <span class="sec-badge"><i class="bi bi-shield-check"></i> Seguro</span>
            <span class="sec-badge"><i class="bi bi-lock-fill"></i> Encriptado</span>
            <span class="sec-badge"><i class="bi bi-award"></i> Garantido</span>
          </div>
        </div>
      </div>{{-- /col-lg-4 --}}

    </div>{{-- /row --}}
  </div>
</div>


<!-- Modal de confirmação -->
<div class="modal fade" id="confirmacaoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body text-center">
                <div class="success-icon mb-3" style="font-size: 3rem; color: var(--success);">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <h4 class="mb-2">Pedido confirmado!</h4>
                <p class="text-muted">Obrigado pela sua compra. Em breve será processado.</p>

                <div class="bg-light rounded-3 p-3 my-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-truck"></i> Taxa de entrega:</span>
                        <strong id="modalTaxa">0 Kz</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <span><i class="bi bi-geo-alt"></i> Distância:</span>
                        <strong id="modalDistancia">0 km</strong>
                    </div>
                </div>

                <div class="mt-3">
                    <a href="{{ route('pedidos.clientes') }}" class="btn btn-primary">Ver meus pedidos</a>
                    <a href="{{ route('index.clientes') }}" class="btn btn-outline-secondary ms-2">Página inicial</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ═══ FOOTER ═══ -->
  @include('clientes.dashboard.footer')


<!-- ═══ TOAST ═══ -->
<div class="toast-fc" id="toastFc">
  <i class="bi bi-exclamation-circle-fill"></i>
  <div><strong id="toastTitle">Aviso</strong><span id="toastMsg"></span></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>

// Coordenadas da farmácia (do backend)
const farmaciaLat = {{ $farmaciaLat ?? 'null' }};
const farmaciaLng = {{ $farmaciaLng ?? 'null' }};

function haversine(lat1, lng1, lat2, lng2) {
    const R = 6371; // km
    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLng = (lng2 - lng1) * Math.PI / 180;
    const a = Math.sin(dLat/2)**2 +
              Math.cos(lat1 * Math.PI/180) * Math.cos(lat2 * Math.PI/180) *
              Math.sin(dLng/2)**2;
    return R * 2 * Math.asin(Math.sqrt(a));
}

function calcularTaxaEntrega(distanciaKm) {
    const bloco = 16;      // km
    const taxaPorBloco = 300; // Kz
    const blocos = Math.max(1, Math.ceil(distanciaKm / bloco));
    return blocos * taxaPorBloco;
}

const subtotalBase = {{ (int) $total }};
let deliveryFee = 800;

/* ── MORADA ─────────────────────────────────────────
   Actualiza os 3 hidden inputs (endereco / lat / lng).
   Os valores vêm dos data-* dos .addr-option renderizados pelo Blade.
──────────────────────────────────────────────────── */
let enderecoAtual = null;   // guarda o objeto do endereço seleccionado

function selecionarEndereco(el) {
    const endereco = el.getAttribute('data-endereco') || '';
    const lat = parseFloat(el.getAttribute('data-lat'));
    const lng = parseFloat(el.getAttribute('data-lng'));
    const label = el.getAttribute('data-label') || 'Endereço';

    enderecoAtual = { endereco, lat, lng, label };

    // Preenche os hidden inputs
    document.getElementById('h-endereco').value = endereco;
    document.getElementById('h-lat').value = lat || '';
    document.getElementById('h-lng').value = lng || '';

    // Actualiza a exibição no card
    const displayDiv = document.getElementById('enderecoSelecionadoDisplay');
    displayDiv.innerHTML = `
        <div class="ao-label">${label}</div>
        <div class="ao-addr">${endereco}</div>
    `;

    // Fecha o modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('modalEnderecos'));
    if (modal) modal.hide();

    // Recalcula a taxa (se for entrega expresso)
    if (tipoEntrega === 'express') {
        recalcularTaxaPorEndereco();
    }
}

function recalcularTaxaPorEndereco() {
    if (!enderecoAtual || tipoEntrega !== 'express') return;

    const lat = enderecoAtual.lat;
    const lng = enderecoAtual.lng;

    let taxa = 0, distancia = 0;
    if (farmaciaLat && farmaciaLng && !isNaN(lat) && !isNaN(lng)) {
        distancia = haversine(farmaciaLat, farmaciaLng, lat, lng);
        taxa = calcularTaxaEntrega(distancia);
    } else {
        taxa = 0;
        distancia = 0;
    }

    actualizarResumo(distancia, taxa);
    document.getElementById('taxaEntregaHidden').value = taxa;
    window.taxaEntregaCalculada = taxa;
}

function actualizarResumo(distanciaKm, taxaKz) {
    const sumDistance = document.getElementById('sumDistance');
    const sumDelivery = document.getElementById('sumDelivery');
    const sumTotal = document.getElementById('sumTotal');

    if (sumDistance) sumDistance.textContent = distanciaKm.toFixed(2) + ' km';
    if (sumDelivery) sumDelivery.textContent = taxaKz === 0 ? 'Grátis' : taxaKz.toLocaleString('pt-AO') + ' Kz';
    const totalFinal = subtotalBase + taxaKz;
    if (sumTotal) sumTotal.textContent = totalFinal.toLocaleString('pt-AO') + ' Kz';
}

function abrirModalEnderecos() {
    const modal = new bootstrap.Modal(document.getElementById('modalEnderecos'));
    modal.show();
}

/* ── ENTREGA ──────────────────────────────────────── */
let tipoEntrega = 'express'; // 'express' ou 'retirada'

function selectDeliv(tipo) {
    tipoEntrega = tipo;
    // Actualiza o visual das opções
    document.querySelectorAll('.deliv-option').forEach(opt => opt.classList.remove('selected'));
    const selectedDiv = document.querySelector(`.deliv-option[onclick*="${tipo}"]`);
    if (selectedDiv) selectedDiv.classList.add('selected');

    const addressCard = document.getElementById('addressCardWrapper');
    if (tipo === 'express') {
        addressCard.style.display = 'block';
        // Se já houver endereço seleccionado, recalcula; senão, mostra aviso para escolher
        if (enderecoAtual) {
            recalcularTaxaPorEndereco();
        } else {
            // Nenhum endereço: abre o modal automaticamente
            abrirModalEnderecos();
            // Enquanto não seleccionar, deixa taxa 0 e mostra mensagem
            actualizarResumo(0, 0);
            document.getElementById('h-endereco').value = '';
        }
    } else {
        addressCard.style.display = 'none';
        // Retirada na farmácia: limpa endereço, taxa = 0, distância = 0
        enderecoAtual = null;
        document.getElementById('h-endereco').value = 'Retirar na Farmácia';
        document.getElementById('h-lat').value = 0.0;
        document.getElementById('h-lng').value = 0.0;
        document.getElementById('taxaEntregaHidden').value = 0;
        actualizarResumo(0, 0);
        // Actualiza o display do endereço (opcional)
        const displayDiv = document.getElementById('enderecoSelecionadoDisplay');
        displayDiv.innerHTML = `<p class="text-muted" style="margin:0"><i class="bi bi-building"></i> Retirar na Farmácia</p>`;
    }
}

// Listener para o input de ficheiro (dentro do formulário)
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('comprovativoExpressInput');
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const preview = document.getElementById('comprovativoPreview');
            if (preview) {
                if (this.files && this.files[0]) {
                    preview.innerHTML = `<i class="bi bi-check-circle-fill"></i> Ficheiro seleccionado: ${this.files[0].name}`;
                } else {
                    preview.innerHTML = '';
                }
            }
        });
    }
});

/* ── PAGAMENTO ────────────────────────────────────── */
function selectPay(el, metodo) {
    document.querySelectorAll('.pay-option').forEach(p => {
        p.classList.remove('selected');
        p.querySelector('.pay-radio').checked = false;
    });
    el.classList.add('selected');
    el.querySelector('.pay-radio').checked = true;
    document.getElementById('h-metodo').value = metodo;

    const comprovativoArea = document.getElementById('comprovativoExpressArea');
    if (metodo === 'express') {
        comprovativoArea.style.display = 'block';
    } else {
        comprovativoArea.style.display = 'none';
        // Limpa o ficheiro seleccionado
        const fileInput = document.getElementById('comprovativoExpressInput');
        if (fileInput) {
            fileInput.value = '';
            const preview = document.getElementById('comprovativoPreview');
            if (preview) preview.innerHTML = '';
        }
    }
}

/* ── TOTAIS VISUAIS (se necessário) ───────────────── */
function updateTotals() {
  const total = subtotalBase + deliveryFee;
  const sumDelivery = document.getElementById('sumDelivery');
  const sumTotal = document.getElementById('sumTotal');
  if (sumDelivery) sumDelivery.textContent = deliveryFee === 0 ? 'Grátis' : deliveryFee.toLocaleString('pt-AO') + ' Kz';
  if (sumTotal) sumTotal.textContent = total.toLocaleString('pt-AO') + ' Kz';
}

/* ── VALIDAÇÃO PRÉ-SUBMIT ─────────────────────────── */
document.getElementById('formPedido').addEventListener('submit', function (e) {
    if (tipoEntrega === 'express') {
        if (!enderecoAtual) {
            e.preventDefault();
            showToast('Endereço em falta', 'Seleccione um endereço de entrega para o serviço Expresso.');
            abrirModalEnderecos();
            return;
        }
    }

    const metodo = document.getElementById('h-metodo').value.trim();
    if (!metodo) {
        e.preventDefault();
        showToast('Pagamento em falta', 'Seleccione um método de pagamento.');
        return;
    }

    const btn = document.getElementById('btnConfirmar');
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span> A processar…';
});


/* ── TOAST ────────────────────────────────────────── */
function showToast(title, msg) {
  document.getElementById('toastTitle').textContent = title;
  document.getElementById('toastMsg').textContent   = ' ' + msg;
  const t = document.getElementById('toastFc');
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 3600);
}

/* ── SCROLL HEADER ────────────────────────────────── */
window.addEventListener('scroll', () => {
  document.getElementById('mainHeader')?.classList.toggle('scrolled', scrollY > 50);
});

/* ── FLASH ────────────────────────────────────────── */
@if(session('success'))
  showToast('Pedido criado!', '{{ session("success") }}');
@endif

// Verifica se há dados de entrega flash e abre o modal automaticamente
@if(session('entrega'))
    const entrega = @json(session('entrega'));
    document.getElementById('modalTaxa').innerText = 
        new Intl.NumberFormat('pt-AO', { style: 'currency', currency: 'AOA' })
            .format(entrega.taxa_entrega);
    document.getElementById('modalDistancia').innerText = 
        entrega.distancia_km.toFixed(2) + ' km';
    
    const modal = new bootstrap.Modal(document.getElementById('confirmacaoModal'));
    modal.show();
@endif
</script>

</body>
</html>