<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrinho — FarmaConnect</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90' fill='%23099aa7'>💊</text></svg>">
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root {
      --accent:      #099aa7;
      --accent-dark: #067e8a;
      --heading:     #1f2f31;
      --text:        #363f40;
      --soft:        #dff3f0;
      --mint:        #eaf6f5;
      --muted:       #6c8285;
      --border:      #e4f0f0;
      --shadow:      0 8px 32px rgba(9,154,167,.08);
      --shadow-md:   0 16px 48px rgba(9,154,167,.13);
    }
    *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
    html { scroll-behavior:smooth; }
    body { font-family:'Inter',-apple-system,BlinkMacSystemFont,sans-serif; background:#f4f8f8; color:var(--text); overflow-x:hidden; }

    /* ===== HEADER ===== */
    .header { background:rgba(255,255,255,.97); backdrop-filter:blur(16px); box-shadow:0 1px 0 rgba(9,154,167,.08),0 4px 24px rgba(9,154,167,.06); padding:.75rem 0; position:sticky; top:0; z-index:1000; transition:box-shadow .3s; }
    .header.scrolled { box-shadow:0 2px 28px rgba(9,154,167,.14); }
    .sitename { font-size:1.75rem; font-weight:800; letter-spacing:-.03em; line-height:1; margin:0; }
    .sitename .s1 { color:var(--accent); } .sitename .s2 { color:var(--heading); }
    .header-search { flex:1; max-width:560px; }
    .header-search .ig { border:1.5px solid var(--border); border-radius:50px; background:#f6fbfb; overflow:hidden; display:flex; align-items:center; transition:border-color .2s,box-shadow .2s; }
    .header-search .ig:focus-within { border-color:var(--accent); box-shadow:0 0 0 3px rgba(9,154,167,.1); }
    .header-search .ig-icon { padding:.6rem 0 .6rem 1.1rem; color:#a0b9bc; }
    .header-search .ig input { flex:1; border:none; background:transparent; font-size:.9rem; color:var(--heading); padding:.6rem .5rem; outline:none; font-family:inherit; }
    .header-search .ig input::placeholder { color:#b0c4c6; }
    .header-search .ig-btn { background:transparent; border:none; color:var(--accent); padding:.6rem 1rem; font-size:1.2rem; cursor:pointer; }
    .navmenu ul { margin:0; padding:0; list-style:none; display:flex; align-items:center; }
    .navmenu li { margin:0 .15rem; }
    .navmenu a { color:var(--heading); font-weight:600; font-size:.88rem; padding:.42rem .85rem; border-radius:50px; text-decoration:none; transition:.2s; white-space:nowrap; }
    .navmenu a:hover { background:var(--soft); color:var(--accent); }
    .hdr-icon { position:relative; color:var(--heading); font-size:1.3rem; text-decoration:none; transition:color .2s; }
    .hdr-icon:hover { color:var(--accent); }
    .hdr-badge { position:absolute; top:-6px; right:-8px; background:var(--accent); color:#fff; font-size:.6rem; font-weight:700; width:17px; height:17px; border-radius:50%; display:flex; align-items:center; justify-content:center; border:2px solid #fff; }
    .profile-toggle { display:flex; align-items:center; gap:.5rem; text-decoration:none; color:var(--heading); }
    .profile-toggle .pname { font-weight:600; font-size:.88rem; }
    .dropdown-menu { border:none; box-shadow:0 12px 40px rgba(9,154,167,.12); border-radius:18px; padding:.5rem; min-width:180px; }
    .dropdown-item { border-radius:10px; font-size:.9rem; font-weight:500; padding:.55rem .9rem; transition:background .15s; }
    .dropdown-item:hover { background:var(--soft); color:var(--accent); }
    .dropdown-item.text-danger:hover { background:#fdecea; color:#c0392b; }

    /* ===== TOPBAR ===== */
    .page-topbar { background:linear-gradient(138deg,#046a76 0%,#099aa7 52%,#0ec4d4 100%); padding:2.2rem 0 4.5rem; position:relative; overflow:hidden; }
    .page-topbar::before { content:''; position:absolute; inset:0; background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
    .tb-blob { position:absolute; border-radius:50%; filter:blur(60px); pointer-events:none; }
    .tb1 { width:320px;height:320px;background:#fff;opacity:.08;top:-120px;right:-60px; }
    .tb2 { width:220px;height:220px;background:#a8ffd4;opacity:.06;bottom:-80px;left:8%; }
    .topbar-inner { position:relative; z-index:2; }
    .breadcrumb-fc { display:flex; align-items:center; gap:.5rem; margin-bottom:.8rem; }
    .breadcrumb-fc a { color:rgba(255,255,255,.65); font-size:.83rem; text-decoration:none; }
    .breadcrumb-fc a:hover { color:#fff; }
    .breadcrumb-fc .sep { color:rgba(255,255,255,.35); font-size:.7rem; }
    .breadcrumb-fc .cur { color:#fff; font-size:.83rem; font-weight:600; }
    .page-topbar h2 { color:#fff; font-size:1.85rem; font-weight:800; letter-spacing:-.02em; margin:0; }
    .page-topbar p  { color:rgba(255,255,255,.68); font-size:.92rem; margin-top:.3rem; }

    /* ===== CHECKOUT STEPS ===== */
    .checkout-steps { display:flex; align-items:center; gap:0; margin-top:1.8rem; position:relative; z-index:2; }
    .cs-step { display:flex; align-items:center; gap:.6rem; flex:1; }
    .cs-step:last-child { flex:none; }
    .cs-dot { width:36px; height:36px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:.88rem; font-weight:800; flex-shrink:0; transition:all .3s; }
    .cs-dot.done    { background:#22c55e; color:#fff; }
    .cs-dot.current { background:#fff; color:var(--accent); box-shadow:0 0 0 4px rgba(255,255,255,.3); }
    .cs-dot.pending { background:rgba(255,255,255,.18); color:rgba(255,255,255,.5); }
    .cs-label { font-size:.8rem; font-weight:700; }
    .cs-label.done    { color:#a8ffd4; }
    .cs-label.current { color:#fff; }
    .cs-label.pending { color:rgba(255,255,255,.45); }
    .cs-line { flex:1; height:2px; background:rgba(255,255,255,.2); margin:0 .6rem; }
    .cs-line.done { background:#22c55e; }

    /* ===== MAIN LAYOUT ===== */
    .cart-wrap { margin-top:-2.2rem; padding-bottom:5rem; }

    /* ===== LEFT COLUMN ===== */

    /* Cart items card */
    .cart-card { background:#fff; border-radius:22px; box-shadow:var(--shadow); margin-bottom:1.2rem; overflow:hidden; }
    .cc-head { padding:1.1rem 1.4rem; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; }
    .cc-head h6 { font-size:.9rem; font-weight:800; color:var(--heading); margin:0; display:flex; align-items:center; gap:.5rem; }
    .cc-head h6 i { color:var(--accent); }
    .cc-clear { font-size:.78rem; font-weight:700; color:#ef4444; background:none; border:none; cursor:pointer; font-family:inherit; display:flex; align-items:center; gap:.35rem; }
    .cc-clear:hover { text-decoration:underline; }

    /* Cart item row */
    .cart-item { display:flex; align-items:flex-start; gap:1rem; padding:1.1rem 1.4rem; border-bottom:1px solid #f4f8f8; transition:background .15s; }
    .cart-item:last-child { border-bottom:none; }
    .cart-item:hover { background:#fafefe; }
    .ci-img { width:72px; height:72px; border-radius:14px; object-fit:cover; background:var(--mint); flex-shrink:0; }
    .ci-info { flex:1; min-width:0; }
    .ci-cat   { font-size:.68rem; font-weight:700; color:var(--accent); text-transform:uppercase; letter-spacing:.05em; }
    .ci-name  { font-size:.95rem; font-weight:700; color:var(--heading); line-height:1.3; margin:.1rem 0; }
    .ci-meta  { font-size:.76rem; color:var(--muted); display:flex; align-items:center; gap:.5rem; flex-wrap:wrap; }
    .ci-meta i { font-size:.72rem; }

    /* Qty control */
    .qty-ctrl { display:flex; align-items:center; gap:.5rem; margin-top:.65rem; }
    .qty-btn { width:30px; height:30px; border-radius:50%; border:1.5px solid var(--border); background:#fff; color:var(--heading); cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:.9rem; font-weight:700; transition:all .2s; }
    .qty-btn:hover { background:var(--accent); color:#fff; border-color:var(--accent); }
    .qty-btn.minus:hover { background:#ef4444; border-color:#ef4444; }
    .qty-num { font-size:.92rem; font-weight:800; color:var(--heading); min-width:26px; text-align:center; }

    /* Right side of item */
    .ci-right { display:flex; flex-direction:column; align-items:flex-end; gap:.5rem; flex-shrink:0; }
    .ci-price { font-size:1.05rem; font-weight:800; color:var(--heading); }
    .ci-old   { font-size:.75rem; color:var(--muted); text-decoration:line-through; }
    .ci-remove { background:none; border:none; color:#b0c4c6; cursor:pointer; font-size:.95rem; transition:color .2s; padding:.2rem; }
    .ci-remove:hover { color:#ef4444; }
    .ci-discount { font-size:.68rem; font-weight:700; background:#fef2f2; color:#ef4444; padding:.18rem .55rem; border-radius:50px; }

    /* ===== DELIVERY ADDRESS ===== */
    .address-card { background:#fff; border-radius:22px; box-shadow:var(--shadow); margin-bottom:1.2rem; overflow:hidden; }
    .ac-head { padding:1.1rem 1.4rem; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; }
    .ac-head h6 { font-size:.9rem; font-weight:800; color:var(--heading); margin:0; display:flex; align-items:center; gap:.5rem; }
    .ac-head h6 i { color:var(--accent); }
    .ac-edit { font-size:.78rem; font-weight:700; color:var(--accent); background:none; border:none; cursor:pointer; font-family:inherit; }
    .ac-body { padding:1.2rem 1.4rem; }
    .addr-option { border:1.5px solid var(--border); border-radius:16px; padding:1rem 1.1rem; cursor:pointer; transition:all .22s; margin-bottom:.7rem; position:relative; }
    .addr-option:hover { border-color:var(--accent); background:var(--mint); }
    .addr-option.selected { border-color:var(--accent); background:var(--soft); }
    .addr-option.selected::after { content:'\2713'; position:absolute; top:.8rem; right:1rem; background:var(--accent); color:#fff; width:22px; height:22px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:.8rem; font-weight:800; }
    .ao-label { font-size:.72rem; font-weight:700; color:var(--accent); text-transform:uppercase; letter-spacing:.05em; margin-bottom:.2rem; }
    .ao-addr  { font-size:.88rem; font-weight:700; color:var(--heading); }
    .ao-sub   { font-size:.76rem; color:var(--muted); }
    .add-addr-btn { display:flex; align-items:center; gap:.5rem; padding:.75rem 1rem; border:1.5px dashed var(--border); border-radius:16px; background:none; font-family:inherit; font-size:.86rem; font-weight:600; color:var(--muted); cursor:pointer; width:100%; transition:all .22s; }
    .add-addr-btn:hover { border-color:var(--accent); color:var(--accent); background:var(--mint); }

    /* ===== DELIVERY OPTIONS ===== */
    .delivery-card { background:#fff; border-radius:22px; box-shadow:var(--shadow); margin-bottom:1.2rem; overflow:hidden; }
    .dc-body { padding:1.1rem 1.4rem; }
    .deliv-option { border:1.5px solid var(--border); border-radius:16px; padding:.9rem 1.1rem; cursor:pointer; transition:all .22s; margin-bottom:.7rem; display:flex; align-items:center; gap:1rem; position:relative; }
    .deliv-option:last-child { margin-bottom:0; }
    .deliv-option:hover { border-color:var(--accent); }
    .deliv-option.selected { border-color:var(--accent); background:var(--soft); }
    .deliv-icon { width:42px; height:42px; border-radius:12px; background:var(--mint); display:flex; align-items:center; justify-content:center; font-size:1.2rem; flex-shrink:0; transition:background .2s; }
    .deliv-option.selected .deliv-icon { background:var(--accent); }
    .deliv-name  { font-size:.9rem; font-weight:700; color:var(--heading); }
    .deliv-sub   { font-size:.76rem; color:var(--muted); }
    .deliv-price { margin-left:auto; font-size:.95rem; font-weight:800; color:var(--heading); flex-shrink:0; }
    .deliv-price.free { color:#22c55e; }
    .deliv-badge { position:absolute; top:-1px; right:12px; background:var(--accent); color:#fff; font-size:.65rem; font-weight:700; padding:.15rem .55rem; border-radius:0 0 8px 8px; }

    /* ===== PAYMENT ===== */
    .payment-card { background:#fff; border-radius:22px; box-shadow:var(--shadow); margin-bottom:1.2rem; overflow:hidden; }
    .pay-body { padding:1.1rem 1.4rem; }
    .pay-option { border:1.5px solid var(--border); border-radius:16px; padding:.85rem 1.1rem; cursor:pointer; transition:all .22s; margin-bottom:.7rem; display:flex; align-items:center; gap:.9rem; position:relative; }
    .pay-option:last-child { margin-bottom:0; }
    .pay-option:hover { border-color:var(--accent); }
    .pay-option.selected { border-color:var(--accent); background:var(--soft); }
    .pay-icon { width:42px; height:42px; border-radius:12px; background:var(--mint); display:flex; align-items:center; justify-content:center; font-size:1.3rem; flex-shrink:0; }
    .pay-option.selected .pay-icon { background:var(--soft); }
    .pay-name { font-size:.88rem; font-weight:700; color:var(--heading); }
    .pay-sub  { font-size:.75rem; color:var(--muted); }
    .pay-radio { margin-left:auto; width:18px; height:18px; accent-color:var(--accent); flex-shrink:0; }

    /* Card form */
    .card-form { background:var(--mint); border-radius:14px; padding:1.1rem; margin-top:.6rem; display:none; }
    .card-form.open { display:block; }
    .form-row { display:flex; gap:.7rem; }
    .fc-field { flex:1; min-width:0; }
    .fc-field label { font-size:.75rem; font-weight:700; color:var(--heading); display:block; margin-bottom:.3rem; }
    .fc-input { width:100%; border:1.5px solid var(--border); border-radius:10px; padding:.55rem .85rem; font-size:.88rem; font-family:inherit; color:var(--heading); background:#fff; outline:none; transition:border-color .2s; }
    .fc-input:focus { border-color:var(--accent); }
    .fc-input::placeholder { color:#b0c4c6; }

    /* Voucher */
    .voucher-row { display:flex; gap:.6rem; margin-top:.8rem; }
    .voucher-input { flex:1; border:1.5px solid var(--border); border-radius:50px; padding:.58rem 1rem; font-size:.88rem; font-family:inherit; color:var(--heading); background:#fafefe; outline:none; transition:border-color .2s; }
    .voucher-input:focus { border-color:var(--accent); }
    .voucher-btn { background:var(--soft); color:var(--accent); border:none; border-radius:50px; padding:.58rem 1.3rem; font-size:.86rem; font-weight:700; font-family:inherit; cursor:pointer; transition:all .22s; white-space:nowrap; }
    .voucher-btn:hover { background:var(--accent); color:#fff; }

    /* ===== ORDER SUMMARY (right col) ===== */
    .summary-card { background:#fff; border-radius:22px; box-shadow:var(--shadow); overflow:hidden; position:sticky; top:88px; }
    .sc-head { padding:1.1rem 1.4rem; border-bottom:1px solid var(--border); }
    .sc-head h6 { font-size:.9rem; font-weight:800; color:var(--heading); margin:0; display:flex; align-items:center; gap:.5rem; }
    .sc-head h6 i { color:var(--accent); }
    .sc-body { padding:1.2rem 1.4rem; }

    /* Mini item in summary */
    .sum-item { display:flex; align-items:center; gap:.75rem; padding:.6rem 0; border-bottom:1px solid #f4f8f8; }
    .sum-item:last-child { border-bottom:none; }
    .sum-item-img { width:40px; height:40px; border-radius:10px; object-fit:cover; background:var(--mint); flex-shrink:0; }
    .sum-item-name { flex:1; font-size:.82rem; font-weight:600; color:var(--heading); min-width:0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .sum-item-qty  { font-size:.75rem; color:var(--muted); white-space:nowrap; }
    .sum-item-price{ font-size:.84rem; font-weight:800; color:var(--heading); white-space:nowrap; }

    /* Totals */
    .tot-divider { height:1px; background:var(--border); margin:1rem 0; }
    .tot-row { display:flex; justify-content:space-between; align-items:center; font-size:.86rem; color:var(--muted); margin-bottom:.45rem; }
    .tot-row.bold { font-size:1.05rem; font-weight:800; color:var(--heading); margin-top:.6rem; padding-top:.6rem; border-top:2px dashed var(--border); }
    .tot-row .green { color:#22c55e; font-weight:700; }
    .tot-row .accent { color:var(--accent); font-weight:700; }

    /* Checkout button */
    .checkout-btn { width:100%; padding:.85rem; background:linear-gradient(135deg,var(--accent),var(--accent-dark)); color:#fff; border:none; border-radius:16px; font-size:1rem; font-weight:800; font-family:inherit; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:.6rem; transition:all .28s; margin-top:1rem; letter-spacing:-.01em; }
    .checkout-btn:hover { transform:translateY(-2px); box-shadow:0 12px 32px rgba(9,154,167,.35); }
    .checkout-btn:active { transform:translateY(0); }

    /* Security badges */
    .security-row { display:flex; align-items:center; justify-content:center; gap:1rem; padding:1rem 1.4rem; border-top:1px solid var(--border); flex-wrap:wrap; }
    .sec-badge { display:flex; align-items:center; gap:.35rem; font-size:.72rem; color:var(--muted); font-weight:600; }
    .sec-badge i { color:var(--accent); font-size:.85rem; }

    /* ===== RELATED / SUGGESTED ===== */
    .suggested-section { margin-top:1.5rem; }
    .suggested-section h6 { font-size:.88rem; font-weight:800; color:var(--heading); margin-bottom:1rem; display:flex; align-items:center; gap:.5rem; }
    .suggested-section h6 i { color:var(--accent); }
    .sug-scroll { display:flex; gap:.85rem; overflow-x:auto; padding-bottom:.4rem; scrollbar-width:none; }
    .sug-scroll::-webkit-scrollbar { display:none; }
    .sug-card { background:#fff; border-radius:16px; box-shadow:var(--shadow); min-width:160px; flex-shrink:0; overflow:hidden; border:1.5px solid transparent; transition:all .25s; cursor:pointer; }
    .sug-card:hover { border-color:var(--accent); transform:translateY(-3px); }
    .sug-img { height:90px; overflow:hidden; }
    .sug-img img { width:100%; height:100%; object-fit:cover; }
    .sug-body { padding:.75rem; }
    .sug-name { font-size:.8rem; font-weight:700; color:var(--heading); line-height:1.3; margin-bottom:.2rem; }
    .sug-price { font-size:.85rem; font-weight:800; color:var(--accent); }
    .sug-add { width:100%; padding:.4rem; background:var(--soft); color:var(--accent); border:none; border-radius:8px; font-size:.76rem; font-weight:700; font-family:inherit; cursor:pointer; transition:all .2s; margin-top:.4rem; }
    .sug-add:hover { background:var(--accent); color:#fff; }

    /* ===== EMPTY CART ===== */
    .empty-cart { background:#fff; border-radius:22px; box-shadow:var(--shadow); padding:4rem 2rem; text-align:center; }
    .empty-cart .ec-icon { font-size:5rem; display:block; margin-bottom:1.2rem; }
    .empty-cart h4 { font-size:1.3rem; font-weight:800; color:var(--heading); margin-bottom:.5rem; }
    .empty-cart p  { color:var(--muted); font-size:.92rem; max-width:320px; margin:0 auto 1.5rem; }
    .btn-go-shop { display:inline-flex; align-items:center; gap:.5rem; background:var(--accent); color:#fff; border:none; border-radius:50px; padding:.72rem 1.8rem; font-size:.92rem; font-weight:700; font-family:inherit; cursor:pointer; text-decoration:none; transition:all .25s; }
    .btn-go-shop:hover { background:var(--accent-dark); color:#fff; transform:scale(1.03); }

    /* ===== SUCCESS MODAL ===== */
    .modal-content { border:none; border-radius:24px; box-shadow:0 20px 60px rgba(0,0,0,.14); overflow:hidden; }
    .modal-body { padding:2.5rem 2rem; text-align:center; }
    .success-anim { width:80px; height:80px; background:linear-gradient(135deg,var(--accent),var(--accent-dark)); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:2rem; margin:0 auto 1.2rem; animation:popIn .5s cubic-bezier(.34,1.56,.64,1) forwards; }
    @keyframes popIn { from{transform:scale(0);opacity:0;} to{transform:scale(1);opacity:1;} }
    .modal-order-num { background:var(--soft); border-radius:12px; padding:.65rem 1.2rem; display:inline-flex; align-items:center; gap:.5rem; font-size:.88rem; font-weight:700; color:var(--accent); margin:1rem 0; }
    .modal-footer { border-top:1px solid var(--border); padding:1rem 1.4rem; gap:.6rem; }

    /* ===== TOAST ===== */
    .toast-fc { position:fixed; bottom:28px; right:28px; background:var(--heading); color:#fff; border-radius:16px; padding:1rem 1.4rem; display:flex; align-items:center; gap:.8rem; box-shadow:0 16px 40px rgba(0,0,0,.18); z-index:9999; transform:translateY(80px); opacity:0; transition:all .35s cubic-bezier(.34,1.56,.64,1); max-width:360px; }
    .toast-fc.show { transform:translateY(0); opacity:1; }
    .toast-fc i { font-size:1.3rem; color:#a8ffd4; flex-shrink:0; }
    .toast-fc strong { font-size:.9rem; display:block; }
    .toast-fc span   { font-size:.78rem; color:rgba(255,255,255,.65); }

    #scroll-top { position:fixed; bottom:28px; right:28px; width:48px; height:48px; background:var(--accent); color:#fff; border-radius:50%; font-size:1.4rem; display:none; align-items:center; justify-content:center; z-index:999; box-shadow:0 6px 20px rgba(9,154,167,.35); transition:all .3s; border:none; cursor:pointer; }
    #scroll-top:hover { background:var(--accent-dark); transform:translateY(-4px); }

    @keyframes fadeUp { from{opacity:0;transform:translateY(14px);}to{opacity:1;transform:none;} }
    .cart-card,.address-card,.delivery-card,.payment-card { animation:fadeUp .45s ease forwards; }
    .address-card { animation-delay:.06s; }
    .delivery-card { animation-delay:.12s; }
    .payment-card  { animation-delay:.18s; }

    @media(max-width:991px) { .summary-card { position:static; margin-top:1.2rem; } }
    @media(max-width:768px) { .header-search{display:none;} .ci-img{width:56px;height:56px;} }
    @media(max-width:576px) { .checkout-steps{gap:.2rem;} .cs-label{display:none;} }
  </style>
</head>
<body>

<!-- ===== HEADER ===== -->
<header class="header" id="mainHeader">
  <div class="container-xl">
    <div class="d-flex align-items-center gap-3">
      <a href="#" class="text-decoration-none me-2 flex-shrink-0">
        <h1 class="sitename"><span class="s1">Farma</span><span class="s2">Connect</span></h1>
      </a>
      <div class="header-search d-none d-md-block mx-auto">
        <div class="ig">
          <span class="ig-icon"><i class="bi bi-search"></i></span>
          <input type="text" placeholder="Pesquise medicamentos, farmácias...">
          <button class="ig-btn"><i class="bi bi-arrow-right-circle-fill"></i></button>
        </div>
      </div>
      <nav class="navmenu d-none d-lg-block flex-shrink-0">
        <ul>
          <li><a href="{{ route('index.clientes') }}"><i class="bi bi-house-door"></i> Início</a></li>
          <li><a href="{{ route('farmacias.list') }}"><i class="bi bi-hospital"></i> Farmácias</a></li>
          <li><a href="{{ route('produtos.clientes') }}"><i class="bi bi-box-seam"></i> Produtos</a></li>
          <li><a href="{{ route('pedidos.clientes') }}"><i class="bi bi-clock-history"></i> Histórico</a></li>
        </ul>
      </nav>
      <div class="d-flex align-items-center gap-3 flex-shrink-0 ms-auto ms-lg-0">
        <a href="{{ route('carrinho.clientes') }}" class="hdr-icon d-none d-sm-inline-flex">
          <i class="bi bi-bag"></i>
          <span class="hdr-badge" id="cartBadge">3</span>
        </a>
        <div class="dropdown">
          <a href="#" class="profile-toggle dropdown-toggle" id="pdrop" data-bs-toggle="dropdown">
            <img src="https://ui-avatars.com/api/?name=Ana+Costa&background=099aa7&color=fff&rounded=true&size=34" width="34" height="34" class="rounded-circle" alt="">
            <span class="pname d-none d-md-inline">{{ auth()->user()->name }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{ route('perfil.clientes') }}"><i class="bi bi-person me-2"></i>Minha Conta</a></li>
            <li><a class="dropdown-item" href="{{ route('pedidos.clientes') }}"><i class="bi bi-bag me-2"></i>Pedidos</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-heart me-2"></i>Favoritos</a></li>
            <li><hr class="dropdown-divider mx-2 my-1"></li>
            <li><a class="dropdown-item text-danger" href="{{ route('logout' , ['id'=>auth()->id()]) }}"><i class="bi bi-box-arrow-right me-2"></i>Terminar Sessão</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- ===== TOPBAR ===== -->
<div class="page-topbar">
  <div class="tb-blob tb1"></div>
  <div class="tb-blob tb2"></div>
  <div class="container-xl topbar-inner">
    <div class="breadcrumb-fc">
      <a href="{{ route('index.clientes') }}"><i class="bi bi-house-door"></i> Início</a>
      <span class="sep"><i class="bi bi-chevron-right" style="font-size:.7rem;"></i></span>
      <a href="{{ route('produtos.clientes') }}">Produtos</a>
      <span class="sep"><i class="bi bi-chevron-right" style="font-size:.7rem;"></i></span>
      <span class="cur">Carrinho</span>
    </div>
    <h2>O meu carrinho</h2>
    <p id="topbarSub">4 itens · Farmácia Central</p>

    <!-- Steps -->
    <div class="checkout-steps">
      <div class="cs-step">
        <div class="cs-dot current"><i class="bi bi-bag"></i></div>
        <span class="cs-label current">Carrinho</span>
      </div>
      <div class="cs-line"></div>
      <div class="cs-step">
        <div class="cs-dot pending">2</div>
        <span class="cs-label pending">Entrega</span>
      </div>
      <div class="cs-line"></div>
      <div class="cs-step">
        <div class="cs-dot pending">3</div>
        <span class="cs-label pending">Pagamento</span>
      </div>
      <div class="cs-line"></div>
      <div class="cs-step">
        <div class="cs-dot pending"><i class="bi bi-check2"></i></div>
        <span class="cs-label pending">Confirmação</span>
      </div>
    </div>
  </div>
</div>

<!-- ===== MAIN ===== -->
<div class="cart-wrap">
  <div class="container-xl">
    <div class="row g-4">

      <!-- LEFT COL -->
      <div class="col-lg-8">

        <!-- ── CART ITEMS ── -->
        <div class="cart-card mt-5" id="cartCard">
          <div class="cc-head">
           <h6><i class="bi bi-bag-heart"></i> Itens no carrinho
            <span style="background:var(--soft);color:var(--accent);border-radius:50px;padding:.08rem .55rem;font-size:.75rem;">
              {{ $itens->count() }}
            </span>
          </h6>

          {{-- Limpar tudo --}}
          <form action="{{ route('carrinho.limpar') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="cc-clear"
                    onclick="return confirm('Deseja remover todos os itens?')">
              <i class="bi bi-trash3"></i> Limpar tudo
            </button>
          </form>          </div>
          <div id="cartItemsContainer" >

              @forelse($itens as $item)
                @php
                  $med   = $item->stockItem->medicamento;
                  $farm  = $item->stockItem->farmacia;
                  $linha = $med->preco * $item->quantidade;
                @endphp

                <div class="cart-item" id="ci-{{ $item->id }}">

                  {{-- Imagem --}}
                  @if($med->imagem ?? false)
                    <img class="ci-img"
                        src="{{ asset('storage/'.$med->imagem) }}"
                        alt="{{ $med->name }}">
                  @else
                    <div class="ci-img d-flex align-items-center justify-content-center"
                        style="font-size:2rem;">💊</div>
                  @endif

                  {{-- Info --}}
                  <div class="ci-info">
                    <div class="ci-cat">{{ $med->categoria->nome ?? '—' }}</div>
                    <div class="ci-name">{{ $med->name }}</div>
                    <div class="ci-meta">
                      @if($med->forma_farmaceutica)
                        <span><i class="bi bi-box"></i> {{ $med->forma_farmaceutica }}
                          {{ $med->dosagem ? '· '.$med->dosagem : '' }}
                        </span>
                      @endif
                      @if($farm)
                        <span><i class="bi bi-hospital"></i> {{ $farm->name }}</span>
                      @endif
                    </div>

                    {{-- Controlo de quantidade --}}
                    <div class="qty-ctrl">

                      {{-- Diminuir --}}
                      <form action="{{ route('carrinho.actualizar', $item) }}" method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="quantidade" value="{{ $item->quantidade - 1 }}">
                        <button type="submit"
                                class="qty-btn minus"
                                {{ $item->quantidade <= 1 ? 'disabled' : '' }}>
                          <i class="bi bi-dash"></i>
                        </button>
                      </form>

                      <span class="qty-num">{{ $item->quantidade }}</span>

                      {{-- Aumentar --}}
                      <form action="{{ route('carrinho.actualizar', $item) }}" method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="quantidade" value="{{ $item->quantidade + 1 }}">
                        <button type="submit"
                                class="qty-btn"
                                {{-- desabilita se não houver stock suficiente --}}
                                {{ $item->quantidade >= $item->stockItem->quantidade ? 'disabled' : '' }}>
                          <i class="bi bi-plus"></i>
                        </button>
                      </form>

                      <span style="font-size:.75rem;color:var(--muted);margin-left:.3rem;">un.</span>
                    </div>
                  </div>

                  {{-- Preço + remover --}}
                  <div class="ci-right">
                    <div>
                      <div class="ci-price">{{ number_format($linha, 0, ',', ' ') }} Kz</div>
                      <div class="ci-old" style="font-size:.75rem;color:var(--muted);">
                        {{ number_format($med->preco, 0, ',', ' ') }} Kz / un.
                      </div>
                    </div>

                    {{-- Remover --}}
                    <form action="{{ route('carrinho.remover', $item) }}" method="POST">
                      @csrf @method('DELETE')
                      <button type="submit" class="ci-remove" title="Remover">
                        <i class="bi bi-trash3"></i>
                      </button>
                    </form>
                  </div>
                
                </div>{{-- /cart-item --}}


              @empty
                <div class="empty-cart" style="border-radius:0;box-shadow:none;">
                  <span class="ec-icon">🛒</span>
                  <h4>O seu carrinho está vazio</h4>
                  <p>Adicione medicamentos para continuar o seu pedido.</p>
                  <a href="{{ route('produtos.clientes') }}" class="btn-go-shop">
                    <i class="bi bi-box-seam"></i> Ver produtos
                  </a>
                </div>
              @endforelse

            </div>
        </div>

                  <!-- ── ADDRESS ── -->
                  <div class="address-card">
                    <div class="ac-head">
                      <h6><i class="bi bi-geo-alt-fill"></i> Endereço de entrega</h6>
                      <button class="ac-edit">Gerir endereços</button>
                    </div>
                    <div class="ac-body">
                      @foreach ($enderecos as $endereco)
                    
                      <div class="addr-option " onclick="selectAddr(this)">
                        <div class="ao-label">{{ $endereco->name }}</div>
                        <div class="ao-addr">{{ $endereco->endereco }}</div>
                        {{-- <div class="ao-sub"><i class="bi bi-geo-alt" style="font-size:.72rem;"></i> Ingombotas, Luanda · 1.2 km da farmácia</div> --}}
                      </div>
                   
                      <button class="add-addr-btn" onclick="showToast('Em breve','Funcionalidade de novo endereço disponível em breve.')">
                        <i class="bi bi-plus-circle" style="color:var(--accent);"></i> Adicionar novo endereço
                      </button>
                      @endforeach
                    </div>
                  </div>

                  <!-- ── DELIVERY OPTIONS ── -->
                  <div class="delivery-card">
                    <div class="ac-head">
                      <h6><i class="bi bi-truck"></i> Tipo de entrega</h6>
                    </div>
                    <div class="dc-body">
                      <div class="deliv-option selected" onclick="selectDeliv(this, 800)">
                        <div class="deliv-badge">Recomendado</div>
                        {{-- <div class="deliv-icon">🚴</div> --}}
                        <div>
                          <div class="deliv-name">Entrega Expresso</div>
                          <div class="deliv-sub">Entrega em ~25 min · Seg-Dom 08h–22h</div>
                        </div>
                        <div class="deliv-price">800 Kz</div>
                      </div>
                      <div class="deliv-option" onclick="selectDeliv(this, 1500)">
                        {{-- <div class="deliv-icon">🚗</div> --}}
                        <div>
                          <div class="deliv-name">Entrega Agendada</div>
                          <div class="deliv-sub">Escolha o horário que preferir</div>
                        </div>
                        <div class="deliv-price">1 500 Kz</div>
                      </div>
                      <div class="deliv-option" onclick="selectDeliv(this, 0)">
                        {{-- <div class="deliv-icon">🏪</div> --}}
                        <div>
                          <div class="deliv-name">Retirar na Farmácia</div>
                          <div class="deliv-sub">Pronto em ~15 min · Sem custo adicional</div>
                        </div>
                        <div class="deliv-price free">Grátis</div>
                      </div>
                    </div>
                  </div>

                  <!-- ── PAYMENT ── -->
                  <div class="payment-card">
                    <div class="ac-head">
                      <h6><i class="bi bi-credit-card-2-front"></i> Método de pagamento</h6>
                    </div>
                    <div class="pay-body">

                      <div class="pay-option selected" onclick="selectPay(this, 'multicaixa')">
                        <div class="pay-icon">📱</div>
                        <div>
                          <div class="pay-name">Multicaixa Express</div>
                          <div class="pay-sub">Pagamento rápido via app do banco</div>
                        </div>
                        <input type="radio" class="pay-radio" name="pay" checked>
                      </div>

                    
                      <div class="pay-option" onclick="selectPay(this, 'cash')">
                        <div class="pay-icon">💵</div>
                        <div>
                          <div class="pay-name">Pagamento em Numerário</div>
                          <div class="pay-sub">Pague ao entregador na entrega</div>
                        </div>
                        <input type="radio" class="pay-radio" name="pay">
                      </div>

                      <!-- Voucher -->
                      <div style="margin-top:1rem; border-top:1px solid var(--border); padding-top:1rem;">
                        <div style="font-size:.8rem; font-weight:700; color:var(--heading); margin-bottom:.4rem; display:flex; align-items:center; gap:.4rem;"><i class="bi bi-ticket-perforated" style="color:var(--accent);"></i> Voucher / Código Promocional</div>
                        <div class="voucher-row">
                          <input type="text" class="voucher-input" id="voucherInput" placeholder="Insira o código aqui..." oninput="this.value=this.value.toUpperCase()">
                          <button class="voucher-btn" onclick="applyVoucher()">Aplicar</button>
                        </div>
                        <div id="voucherMsg" style="font-size:.76rem; margin-top:.4rem; display:none;"></div>
                      </div>
                    </div>
                  </div>

                  <!-- ── NOTES ── -->
                  {{-- <div class="cart-card">
                    <div class="cc-head"><h6><i class="bi bi-chat-text"></i> Observações para a farmácia</h6></div>
                    <div style="padding:1rem 1.4rem;">
                      <textarea class="fc-input" rows="3" style="resize:none;border-radius:14px;" placeholder="Ex: Toque suave no intercomunicador, 3º andar direito..."></textarea>
                      <div style="font-size:.73rem;color:var(--muted);margin-top:.4rem;">Opcional · Max. 200 caracteres</div>
                    </div>
                  </div> --}}


      </div><!-- /left col -->

      <!-- RIGHT COL – SUMMARY -->
      <div class="col-lg-4 mt-5">
        <div class="summary-card">
          <div class="sc-head">
            <h6><i class="bi bi-receipt"></i> Resumo do pedido</h6>
          </div>
          <div class="sc-body">

            {{-- Mini lista de itens no resumo --}}
            <div id="summaryItems">
              @foreach($itens as $item)
                @php $med = $item->stockItem->medicamento; @endphp
                <div class="sum-item">

                  @if($med->imagem ?? false)
                    <img class="sum-item-img"
                        src="{{ asset('storage/'.$med->imagem) }}"
                        alt="{{ $med->name }}">
                  @else
                    <div class="sum-item-img d-flex align-items-center justify-content-center"
                        style="font-size:1.3rem;">💊</div>
                  @endif

                  <div class="sum-item-name">{{ $med->name }}</div>
                  <div class="sum-item-qty">×{{ $item->quantidade }}</div>
                  <div class="sum-item-price">
                    {{ number_format($med->preco * $item->quantidade, 0, ',', ' ') }} Kz
                  </div>
                </div>
              @endforeach
            </div>

            <div class="tot-divider"></div>

            <div class="tot-row">
              <span>Subtotal</span>
              <span>{{ number_format($total, 0, ',', ' ') }} Kz</span>
            </div>
            <div class="tot-row">
              <span>Taxa de entrega</span>
              <span id="sumDelivery">800 Kz</span>  {{-- actualizada pelo JS ao escolher entrega --}}
            </div>
            <div class="tot-row bold">
              <span>Total</span>
              <span id="sumTotal">{{ number_format($total + 800, 0, ',', ' ') }} Kz</span>
            </div>

            <div style="background:var(--mint);border-radius:12px;padding:.75rem 1rem;margin:1rem 0;font-size:.78rem;color:var(--muted);display:flex;align-items:center;gap:.5rem;">
              <i class="bi bi-info-circle-fill" style="color:var(--accent);flex-shrink:0;"></i>
              O pagamento só é cobrado após a confirmação da farmácia.
            </div>

            <button class="checkout-btn" onclick="openConfirmModal()">
              <i class="bi bi-bag-check"></i> Confirmar pedido
            </button>
          </div>

          <div class="security-row">
            <span class="sec-badge"><i class="bi bi-shield-check"></i> Seguro</span>
            <span class="sec-badge"><i class="bi bi-lock-fill"></i> Encriptado</span>
            <span class="sec-badge"><i class="bi bi-award"></i> Garantido</span>
          </div>
        </div>

        <!-- Suggested -->

      </div><!-- /right col -->

    </div><!-- /row -->
  </div>
</div>

<!-- ===== FOOTER ===== -->
<footer style="background:#1f2f31;color:#fff;padding:2rem 0;margin-top:1rem;">
  <div class="container-xl">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
      <span style="font-size:1.3rem;font-weight:800;"><span style="color:#099aa7;">Farma</span>Connect</span>
      <span style="color:#6a8a8d;font-size:.85rem;">&copy; 2026 FarmaConnect · Todos os direitos reservados.</span>
      <div>
        <a href="#" style="color:#a0b9bc;font-size:.82rem;text-decoration:none;margin-left:1rem;">Privacidade</a>
        <a href="#" style="color:#a0b9bc;font-size:.82rem;text-decoration:none;margin-left:1rem;">Termos</a>
        <a href="#" style="color:#a0b9bc;font-size:.82rem;text-decoration:none;margin-left:1rem;">Suporte</a>
      </div>
    </div>
  </div>
</footer>

<!-- ===== CONFIRM MODAL ===== -->
<div class="modal fade" id="confirmModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="success-anim">✅</div>
        <h4 style="font-size:1.35rem;font-weight:800;color:var(--heading);margin-bottom:.5rem;">Pedido confirmado!</h4>
        <p style="color:var(--muted);font-size:.9rem;max-width:300px;margin:0 auto;">O seu pedido foi enviado para a <strong style="color:var(--heading);">Farmácia Central</strong> e será entregue em breve.</p>
        <div class="modal-order-num">
          <i class="bi bi-hash"></i> FC-2026-<strong id="orderNum">0014</strong>
        </div>
        <div style="background:var(--mint);border-radius:16px;padding:1rem 1.3rem;text-align:left;margin-top:.5rem;">
          <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:.6rem;">
            <span style="font-size:1.3rem;">🚴</span>
            <div>
              <div style="font-size:.82rem;font-weight:700;color:var(--heading);">Entrega Expresso em ~25 min</div>
              <div style="font-size:.75rem;color:var(--muted);">Rua da Missão, Nº 47, Ingombotas</div>
            </div>
          </div>
          <div style="display:flex;align-items:center;gap:.75rem;">
            <span style="font-size:1.3rem;">📱</span>
            <div>
              <div style="font-size:.82rem;font-weight:700;color:var(--heading);">Pagamento via Multicaixa Express</div>
              <div style="font-size:.75rem;color:var(--muted);" id="modalTotal">Total: — Kz</div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer" style="border-top:1px solid var(--border);padding:1rem 1.4rem;gap:.6rem;">
        <button style="flex:1;padding:.65rem;background:var(--soft);color:var(--accent);border:none;border-radius:12px;font-size:.88rem;font-weight:700;font-family:inherit;cursor:pointer;" data-bs-dismiss="modal">Ver pedidos</button>
        <button style="flex:1;padding:.65rem;background:var(--accent);color:#fff;border:none;border-radius:12px;font-size:.88rem;font-weight:700;font-family:inherit;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:.4rem;" data-bs-dismiss="modal" onclick="trackOrder()"><i class="bi bi-map"></i> Rastrear entrega</button>
      </div>
    </div>
  </div>
</div>

<!-- Toast -->
<div class="toast-fc" id="toastFc">
  <i class="bi bi-check-circle-fill"></i>
  <div><strong id="toastTitle">Sucesso!</strong><span id="toastMsg"></span></div>
</div>

<button id="scroll-top" onclick="window.scrollTo({top:0,behavior:'smooth'})"><i class="bi bi-arrow-up-short"></i></button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
/* ══════════════════════
   STATE
══════════════════════ */
let cart = [
  { id:1, name:'Paracetamol 500mg', cat:'Analgésico', form:'Embalagem c/ 20 comp.', pharm:'Farmácia Central', price:850,  oldPrice:null, qty:2, img:'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=200&auto=format&fit=crop' },
  { id:2, name:'Vitamina C 1000mg', cat:'Vitaminas',  form:'Frasco c/ 30 comp.',    pharm:'Farmácia Central', price:3200, oldPrice:4500, qty:1, img:'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=200&auto=format&fit=crop' },
  { id:3, name:'Ibuprofeno 400mg',  cat:'Analgésico', form:'Embalagem c/ 20 comp.', pharm:'Farmácia Central', price:1200, oldPrice:1500, qty:1, img:'https://images.unsplash.com/photo-1576671081837-49000212a370?w=200&auto=format&fit=crop' },
];

let deliveryFee   = 800;
let voucherDiscount = 0;
let nextId = 100;

/* ══════════════════════
   RENDER CART
══════════════════════ */
function renderCart() {
  const container = document.getElementById('cartItemsContainer');
  const countEl   = document.getElementById('itemCount');
  const topSub    = document.getElementById('topbarSub');
  const badge     = document.getElementById('cartBadge');

  if (cart.length === 0) {
    container.innerHTML = `
      <div class="empty-cart" style="border-radius:0;box-shadow:none;">
        <span class="ec-icon">🛒</span>
        <h4>O seu carrinho está vazio</h4>
        <p>Adicione medicamentos para continuar o seu pedido.</p>
        <a href="#" class="btn-go-shop"><i class="bi bi-box-seam"></i> Ver produtos</a>
      </div>`;
    document.getElementById('cartCard').querySelector('.cc-clear').style.display = 'none';
    return;
  }

  const totalQty = cart.reduce((s,x)=>s+x.qty,0);
  countEl.textContent = totalQty;
  badge.textContent   = totalQty;
  topSub.textContent  = `${totalQty} ${totalQty===1?'item':'itens'} · Farmácia Central`;

  container.innerHTML = cart.map(item => {
    const linePrice = item.price * item.qty;
    const oldLine   = item.oldPrice ? `<span class="ci-old">${(item.oldPrice*item.qty).toLocaleString('pt-PT')} Kz</span>` : '';
    const disc      = item.oldPrice ? `<span class="ci-discount">-${Math.round((1-item.price/item.oldPrice)*100)}%</span>` : '';
    return `
    <div class="cart-item" id="ci-${item.id}">
      <img class="ci-img" src="${item.img}" alt="${item.name}">
      <div class="ci-info">
        <div class="ci-cat">${item.cat}</div>
        <div class="ci-name">${item.name}</div>
        <div class="ci-meta">
          <span><i class="bi bi-box"></i> ${item.form}</span>
          <span><i class="bi bi-hospital"></i> ${item.pharm}</span>
        </div>
        <div class="qty-ctrl">
          <button class="qty-btn minus" onclick="changeQty(${item.id},-1)"><i class="bi bi-dash"></i></button>
          <span class="qty-num" id="qty-${item.id}">${item.qty}</span>
          <button class="qty-btn" onclick="changeQty(${item.id},1)"><i class="bi bi-plus"></i></button>
          <span style="font-size:.75rem;color:var(--muted);margin-left:.3rem;">un.</span>
        </div>
      </div>
      <div class="ci-right">
        <div>
          <div class="ci-price">${linePrice.toLocaleString('pt-PT')} Kz</div>
          ${oldLine}
        </div>
        ${disc}
        <button class="ci-remove" onclick="removeItem(${item.id})" title="Remover"><i class="bi bi-trash3"></i></button>
      </div>
    </div>`;
  }).join('');

  renderSummary();
}

/* ══════════════════════
   RENDER SUMMARY
══════════════════════ */
function renderSummary() {
  const subtotal = cart.reduce((s,x)=>s+x.price*x.qty, 0);
  const total    = subtotal + deliveryFee - voucherDiscount;

  // Mini items
  document.getElementById('summaryItems').innerHTML = cart.map(item => `
    <div class="sum-item">
      <img class="sum-item-img" src="${item.img}" alt="${item.name}">
      <div class="sum-item-name">${item.name}</div>
      <div class="sum-item-qty">×${item.qty}</div>
      <div class="sum-item-price">${(item.price*item.qty).toLocaleString('pt-PT')} Kz</div>
    </div>`).join('');

  document.getElementById('sumSubtotal').textContent = subtotal.toLocaleString('pt-PT') + ' Kz';
  document.getElementById('sumDelivery').textContent = deliveryFee === 0 ? 'Grátis' : deliveryFee.toLocaleString('pt-PT') + ' Kz';
  document.getElementById('sumTotal').textContent    = total.toLocaleString('pt-PT') + ' Kz';
  document.getElementById('modalTotal').textContent  = 'Total: ' + total.toLocaleString('pt-PT') + ' Kz';

  if (voucherDiscount > 0) {
    document.getElementById('discountRow').style.display = '';
    document.getElementById('sumDiscount').textContent = '— ' + voucherDiscount.toLocaleString('pt-PT') + ' Kz';
  }
}

/* ══════════════════════
   CART ACTIONS
══════════════════════ */
function changeQty(id, delta) {
  const item = cart.find(x=>x.id===id);
  if (!item) return;
  item.qty = Math.max(1, item.qty + delta);
  document.getElementById('qty-'+id).textContent = item.qty;
  const lineEl = document.querySelector(`#ci-${id} .ci-price`);
  if (lineEl) lineEl.textContent = (item.price * item.qty).toLocaleString('pt-PT') + ' Kz';
  renderSummary();
}

function removeItem(id) {
  const el = document.getElementById('ci-'+id);
  if (el) { el.style.opacity='0'; el.style.transform='translateX(30px)'; el.style.transition='all .3s'; }
  setTimeout(() => {
    cart = cart.filter(x=>x.id!==id);
    renderCart();
  }, 280);
}

function clearCart() {
  if (!confirm('Deseja remover todos os itens do carrinho?')) return;
  cart = [];
  renderCart();
  showToast('Carrinho limpo', 'Todos os itens foram removidos.');
}

function addSuggested(name, price, img) {
  const existing = cart.find(x=>x.name===name);
  if (existing) { existing.qty++; }
  else cart.push({ id:++nextId, name, cat:'Sugestão', form:'', pharm:'Farmácia Central', price, oldPrice:null, qty:1, img });
  renderCart();
  showToast('🛒 ' + name, 'adicionado ao carrinho!');
}

/* ══════════════════════
   DELIVERY / PAYMENT
══════════════════════ */
function selectAddr(el) {
  document.querySelectorAll('.addr-option').forEach(a=>a.classList.remove('selected'));
  el.classList.add('selected');
}

function selectDeliv(el, fee) {
  document.querySelectorAll('.deliv-option').forEach(d=>d.classList.remove('selected'));
  el.classList.add('selected');
  deliveryFee = fee;
  renderSummary();
}

function selectPay(el, type) {
  document.querySelectorAll('.pay-option').forEach(p=>{ p.classList.remove('selected'); p.querySelector('.pay-radio').checked=false; });
  el.classList.add('selected');
  el.querySelector('.pay-radio').checked = true;
  document.getElementById('cardForm').classList.toggle('open', type==='card');
}

/* ══════════════════════
   VOUCHER
══════════════════════ */
const VOUCHERS = { 'FARMA10': .10, 'SAUDE20': .20, 'ANGOLA15': .15 };
function applyVoucher() {
  const code = document.getElementById('voucherInput').value.trim().toUpperCase();
  const msgEl = document.getElementById('voucherMsg');
  msgEl.style.display = 'block';
  if (VOUCHERS[code]) {
    const subtotal = cart.reduce((s,x)=>s+x.price*x.qty,0);
    voucherDiscount = Math.round(subtotal * VOUCHERS[code]);
    msgEl.style.color = '#22c55e';
    msgEl.innerHTML = `<i class="bi bi-check-circle-fill"></i> Voucher aplicado! Desconto de ${(VOUCHERS[code]*100).toFixed(0)}% (−${voucherDiscount.toLocaleString('pt-PT')} Kz)`;
    renderSummary();
    showToast('Voucher aplicado! 🎉', `Desconto de ${(VOUCHERS[code]*100).toFixed(0)}% aplicado ao pedido.`);
  } else {
    msgEl.style.color = '#ef4444';
    msgEl.innerHTML = '<i class="bi bi-x-circle-fill"></i> Código inválido ou expirado.';
  }
}

/* ══════════════════════
   CARD FORMATTERS
══════════════════════ */
function formatCard(input) {
  let v = input.value.replace(/\D/g,'').substring(0,16);
  input.value = v.replace(/(.{4})/g,'$1 ').trim();
}
function formatExpiry(input) {
  let v = input.value.replace(/\D/g,'').substring(0,4);
  if (v.length >= 3) v = v.substring(0,2)+'/'+v.substring(2);
  input.value = v;
}

/* ══════════════════════
   CONFIRM MODAL
══════════════════════ */
function openConfirmModal() {
  if (cart.length === 0) { showToast('Carrinho vazio', 'Adicione itens antes de confirmar.'); return; }
  document.getElementById('orderNum').textContent = String(14 + Math.floor(Math.random()*90)).padStart(4,'0');
  // Advance steps UI
  document.querySelectorAll('.cs-dot').forEach((d,i) => {
    d.classList.remove('current','pending','done');
    d.classList.add(i < 3 ? 'done' : 'current');
  });
  document.querySelectorAll('.cs-label').forEach((l,i) => {
    l.classList.remove('current','pending','done');
    l.classList.add(i < 3 ? 'done' : 'current');
  });
  document.querySelectorAll('.cs-line').forEach(l => l.classList.add('done'));
  new bootstrap.Modal(document.getElementById('confirmModal')).show();
}

function trackOrder() {
  showToast('Rastreio activo 🚴', 'Entregador a caminho! ~25 min.');
}

/* ══════════════════════
   TOAST / SCROLL
══════════════════════ */
function showToast(title, msg) {
  document.getElementById('toastTitle').textContent = title;
  document.getElementById('toastMsg').textContent   = msg;
  const t = document.getElementById('toastFc');
  t.classList.add('show');
  setTimeout(()=>t.classList.remove('show'), 3400);
}

const hdr = document.getElementById('mainHeader');
window.addEventListener('scroll', () => {
  hdr.classList.toggle('scrolled', scrollY > 50);
  document.getElementById('scroll-top').style.display = scrollY > 320 ? 'flex' : 'none';
});

/* ══════════════════════
   INIT
══════════════════════ */
renderCart();
</script>
</body>
</html>