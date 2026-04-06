<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FarmaConnect · Pedidos</title>

  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --accent:        #0899a6;
      --accent-2:      #05707a;
      --accent-light:  #e6f7f8;
      --accent-mid:    #b2e8ec;
      --danger:        #d94040;
      --danger-light:  #fdecea;
      --warning:       #d97706;
      --warning-light: #fef3c7;
      --success:       #16a34a;
      --success-light: #dcfce7;
      --purple:        #7c3aed;
      --purple-light:  #ede9fe;
      --bg:            #f1f5f9;
      --surface:       #ffffff;
      --surface-2:     #f8fafc;
      --border:        #e2e8f0;
      --border-strong: #cbd5e1;
      --text:          #0f172a;
      --text-2:        #334155;
      --text-3:        #64748b;
      --text-4:        #94a3b8;
      --shadow-md:     0 4px 16px rgba(0,0,0,.08);
      --topbar-h:      52px;
      --r-sm: 6px; --r-md: 10px; --r-lg: 14px; --r-xl: 18px;
    }

    html { font-size: 13px; }
    body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; -webkit-font-smoothing: antialiased; }
    .layout { display: flex; min-height: 100vh; }

    /* ─── SIDEBAR ─────────────────────────── */
    .sidebar { width: 220px; flex-shrink: 0; background: var(--surface); border-right: 1px solid var(--border); display: flex; flex-direction: column; position: fixed; top: 0; left: 0; height: 100vh; overflow-y: auto; overflow-x: hidden; z-index: 200; }
    .sidebar-header { height: var(--topbar-h); min-height: var(--topbar-h); flex-shrink: 0; display: flex; align-items: center; padding: 0 16px; border-bottom: 1px solid var(--border); }
    .logo { display: flex; align-items: center; gap: 9px; text-decoration: none; }
    .logo-mark { width: 28px; height: 28px; background: var(--accent); border-radius: var(--r-sm); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .logo-mark svg { width: 14px; height: 14px; fill: #fff; }
    .logo-text { font-family: 'Sora', sans-serif; font-size: 1.1rem; font-weight: 700; line-height: 1; }
    .logo-text .f { color: var(--accent); } .logo-text .c { color: var(--text); }
    
    .sidebar-body { flex: 1; overflow-y: auto; padding: 8px 0 12px; }
    .sidebar-body::-webkit-scrollbar { width: 0; }
    .nav-section { padding: 0 8px; }
    .nav-label { font-size: 0.67rem; font-weight: 600; color: var(--text-4); text-transform: uppercase; letter-spacing: .07em; padding: 10px 8px 4px; display: block; }
    .nav-item { display: flex; align-items: center; gap: 8px; padding: 6px 8px; border-radius: var(--r-md); font-size: 0.82rem; font-weight: 500; color: var(--text-3); cursor: pointer; transition: background .1s, color .1s; border: none; background: none; width: 100%; text-align: left; font-family: 'DM Sans', sans-serif; text-decoration: none; margin-bottom: 1px; }
    .nav-item i { font-size: 0.88rem; width: 15px; text-align: center; flex-shrink: 0; }
    .nav-item:hover { background: var(--surface-2); color: var(--text); }
    .nav-item.active { background: var(--accent-light); color: var(--accent); font-weight: 600; }
    .nav-item.active i { color: var(--accent); }
    .nav-badge { margin-left: auto; font-size: 0.62rem; font-weight: 700; padding: 1px 5px; border-radius: 20px; line-height: 1.5; }
    .nb-red { background: var(--danger-light); color: var(--danger); }
    .nb-amber { background: var(--warning-light); color: var(--warning); }
    .nb-teal { background: var(--accent-light); color: var(--accent-2); }
    .nb-slate { background: #f1f5f9; color: var(--text-3); }
    .has-sub .sub { display: none; padding-left: 20px; margin: 2px 0; }
    .has-sub.open .sub { display: block; }
    .sub-item { display: flex; align-items: center; gap: 7px; padding: 5px 8px; border-radius: var(--r-sm); font-size: 0.77rem; font-weight: 500; color: var(--text-3); cursor: pointer; transition: all .1s; text-decoration: none; }
    .sub-item i { font-size: 0.77rem; width: 13px; }
    .sub-item:hover { background: var(--surface-2); color: var(--accent); }
    .chevron { margin-left: auto; font-size: 0.68rem; transition: transform .2s; }
    .has-sub.open .chevron { transform: rotate(180deg); }
    .nav-divider { height: 1px; background: var(--border); margin: 6px 12px; }
    .sidebar-footer { flex-shrink: 0; padding: 8px; border-top: 1px solid var(--border); }
    .ph-card { padding: 10px 11px; background: var(--accent-light); border-radius: var(--r-lg); }
    .ph-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 5px; }
    .ph-name { font-size: 0.78rem; font-weight: 700; color: var(--accent-2); }
    .ph-pill { font-size: 0.62rem; font-weight: 700; padding: 2px 6px; border-radius: 20px; }
    .pill-open { background: #dcfce7; color: #15803d; }
    .ph-meta { font-size: 0.7rem; color: var(--accent-2); opacity: .8; display: flex; align-items: center; gap: 4px; margin-bottom: 2px; }

        /* Logout button */
    .logout-form {
        margin-top: 12px;
    }

    .logout-btn {
        color: var(--danger);
    }

    .logout-btn i {
        color: var(--danger);
    }

    .logout-btn:hover {
        background: var(--danger-light);
        color: var(--danger);
    }

    .logout-btn:hover i {
        color: var(--danger);
    }
    /* ─── MAIN ────────────────────────────── */
    .main { flex: 1; margin-left: 220px; display: flex; flex-direction: column; min-height: 100vh; }

    .topbar { background: var(--surface); border-bottom: 1px solid var(--border); padding: 0 22px; height: var(--topbar-h); display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; flex-shrink: 0; }
    .tb-left { display: flex; align-items: center; gap: 8px; }
    .tb-left h1 { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 600; }
    .tb-sep { color: var(--text-4); }
    .tb-sub { font-size: 0.78rem; color: var(--text-3); }
    .tb-right { display: flex; align-items: center; gap: 7px; }
    .ib { width: 30px; height: 30px; border-radius: var(--r-md); border: 1px solid var(--border); background: var(--surface); display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 0.85rem; color: var(--text-3); transition: all .1s; position: relative; }
    .ib:hover { background: var(--surface-2); color: var(--text); }
    .ib-dot { position: absolute; top: 5px; right: 5px; width: 5px; height: 5px; background: var(--danger); border-radius: 50%; border: 1.5px solid var(--surface); }
    .user-chip { display: flex; align-items: center; gap: 7px; padding: 3px 10px 3px 4px; border-radius: var(--r-md); border: 1px solid var(--border); background: var(--surface); cursor: pointer; font-size: 0.77rem; }
    .u-av { width: 22px; height: 22px; border-radius: 5px; background: var(--accent-light); color: var(--accent-2); font-size: 0.6rem; font-weight: 700; display: flex; align-items: center; justify-content: center; }
    .u-name { font-weight: 600; color: var(--text); line-height: 1.2; display: block; }
    .u-role { font-size: 0.67rem; color: var(--text-3); display: block; }

    /* ─── CONTENT ─────────────────────────── */
    .content { padding: 18px 22px; flex: 1; display: flex; flex-direction: column; }

    /* ─── KPI ROW ─────────────────────────── */
    .kpi-row { display: grid; grid-template-columns: repeat(5, minmax(0,1fr)); gap: 10px; margin-bottom: 16px; }
    .kpi { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-xl); padding: 12px 14px; cursor: pointer; position: relative; overflow: hidden; transition: border-color .15s, box-shadow .15s, transform .1s; }
    .kpi::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 3px; border-radius: var(--r-xl) 0 0 var(--r-xl); }
    .kpi:hover { border-color: var(--accent-mid); box-shadow: var(--shadow-md); transform: translateY(-2px); }
    .kpi.k-new::before      { background: var(--danger); }
    .kpi.k-prep::before     { background: var(--warning); }
    .kpi.k-route::before    { background: var(--accent); }
    .kpi.k-done::before     { background: var(--success); }
    .kpi.k-canceled::before { background: var(--text-4); }
    .kpi-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px; }
    .kpi-ico { width: 30px; height: 30px; border-radius: var(--r-md); display: flex; align-items: center; justify-content: center; font-size: 0.85rem; }
    .kpi-ico.red    { background: var(--danger-light); color: var(--danger); }
    .kpi-ico.amber  { background: var(--warning-light); color: var(--warning); }
    .kpi-ico.teal   { background: var(--accent-light); color: var(--accent); }
    .kpi-ico.green  { background: var(--success-light); color: var(--success); }
    .kpi-ico.slate  { background: #f1f5f9; color: var(--text-3); }
    .kpi-val { font-family: 'Sora', sans-serif; font-size: 1.5rem; font-weight: 700; line-height: 1; }
    .kpi-lbl { font-size: 0.7rem; font-weight: 500; color: var(--text-3); margin-top: 2px; }
    .kpi-chip { font-size: 0.62rem; font-weight: 700; padding: 1px 6px; border-radius: 20px; }
    .kc-red    { background: var(--danger-light); color: var(--danger); }
    .kc-amber  { background: var(--warning-light); color: var(--warning); }
    .kc-teal   { background: var(--accent-light); color: var(--accent-2); }
    .kc-green  { background: var(--success-light); color: var(--success); }
    .kc-slate  { background: #f1f5f9; color: var(--text-3); }

    /* ─── TOOLBAR ─────────────────────────── */
    .toolbar { display: flex; align-items: center; gap: 8px; margin-bottom: 12px; flex-wrap: wrap; }
    .toolbar-left { display: flex; align-items: center; gap: 7px; flex: 1; min-width: 0; flex-wrap: wrap; }
    .toolbar-right { display: flex; align-items: center; gap: 7px; flex-shrink: 0; }

    .search-wrap { position: relative; min-width: 200px; max-width: 300px; flex: 1; }
    .search-wrap i { position: absolute; left: 9px; top: 50%; transform: translateY(-50%); color: var(--text-4); font-size: 0.82rem; pointer-events: none; }
    .search-input { width: 100%; padding: 5px 10px 5px 30px; border: 1px solid var(--border); border-radius: var(--r-md); font-size: 0.78rem; font-family: 'DM Sans', sans-serif; background: var(--surface); color: var(--text); transition: border-color .1s; }
    .search-input:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 2px rgba(8,153,166,.12); }
    .search-input::placeholder { color: var(--text-4); }

    /* Status filter tabs */
    .status-tabs { display: flex; background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-md); overflow: hidden; }
    .st-tab { padding: 5px 12px; font-size: 0.75rem; font-weight: 600; color: var(--text-3); cursor: pointer; border: none; background: none; transition: all .1s; white-space: nowrap; font-family: 'DM Sans', sans-serif; display: flex; align-items: center; gap: 5px; border-right: 1px solid var(--border); }
    .st-tab:last-child { border-right: none; }
    .st-tab:hover { background: var(--surface-2); color: var(--text); }
    .st-tab.active { background: var(--accent-light); color: var(--accent); }
    .st-tab .tab-count { font-size: 0.62rem; font-weight: 700; padding: 1px 5px; border-radius: 20px; background: var(--border); color: var(--text-3); }
    .st-tab.active .tab-count { background: var(--accent); color: #fff; }

    .filter-select { padding: 5px 26px 5px 9px; border: 1px solid var(--border); border-radius: var(--r-md); font-size: 0.77rem; font-family: 'DM Sans', sans-serif; background: var(--surface) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%2394a3b8'/%3E%3C/svg%3E") no-repeat right 8px center; color: var(--text-2); cursor: pointer; appearance: none; }
    .filter-select:focus { outline: none; border-color: var(--accent); }

    .btn { display: inline-flex; align-items: center; gap: 5px; padding: 5px 12px; border-radius: var(--r-md); font-size: 0.78rem; font-weight: 600; cursor: pointer; transition: all .1s; border: 1px solid; font-family: 'DM Sans', sans-serif; white-space: nowrap; }
    .btn i { font-size: 0.8rem; }
    .btn-primary { background: var(--accent); color: #fff; border-color: var(--accent); }
    .btn-primary:hover { background: var(--accent-2); border-color: var(--accent-2); }
    .btn-outline { background: var(--surface); color: var(--text-2); border-color: var(--border); }
    .btn-outline:hover { background: var(--surface-2); border-color: var(--border-strong); }
    .btn-icon { padding: 5px 8px; }

    /* ─── BULK BAR ────────────────────────── */
    .bulk-bar { display: none; align-items: center; gap: 10px; padding: 9px 14px; margin-bottom: 10px; background: var(--accent); border-radius: var(--r-xl); color: #fff; font-size: 0.78rem; font-weight: 500; animation: sd .15s ease; }
    .bulk-bar.show { display: flex; }
    @keyframes sd { from { opacity:0; transform:translateY(-5px); } to { opacity:1; transform:translateY(0); } }
    .bulk-count { font-family: 'Sora', sans-serif; font-weight: 700; font-size: 0.92rem; }
    .bulk-sp { flex: 1; }
    .bulk-btn { display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: var(--r-sm); font-size: 0.73rem; font-weight: 600; cursor: pointer; border: 1px solid rgba(255,255,255,.3); background: rgba(255,255,255,.12); color: #fff; transition: all .1s; font-family: 'DM Sans', sans-serif; }
    .bulk-btn:hover { background: rgba(255,255,255,.22); }
    .bulk-btn.bd { border-color: rgba(255,100,100,.5); background: rgba(255,80,80,.18); }
    .bulk-btn.bd:hover { background: rgba(255,80,80,.3); }
    .bulk-close { background: none; border: none; color: rgba(255,255,255,.7); cursor: pointer; font-size: 0.95rem; margin-left: 4px; }

    /* ─── TABLE ───────────────────────────── */
    .table-wrap { flex: 1; background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-xl); overflow: hidden; display: flex; flex-direction: column; }
    .table-scroll { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; font-size: 0.78rem; min-width: 900px; }
    thead tr { background: var(--surface-2); }
    th { padding: 9px 12px; text-align: left; font-size: 0.66rem; font-weight: 600; color: var(--text-3); text-transform: uppercase; letter-spacing: .05em; border-bottom: 1px solid var(--border); white-space: nowrap; user-select: none; cursor: pointer; }
    th:hover { color: var(--text); }
    th.sorted { color: var(--accent); }
    th .si { font-size: 0.58rem; margin-left: 3px; opacity: .5; }
    th.sorted .si { opacity: 1; }
    th.ns { cursor: default; }
    th:first-child { padding-left: 16px; }
    th:last-child  { padding-right: 16px; }
    tbody tr { border-bottom: 1px solid var(--border); transition: background .07s; }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: var(--surface-2); }
    tbody tr.selected { background: var(--accent-light); }
    td { padding: 10px 12px; vertical-align: middle; color: var(--text-2); }
    td:first-child { padding-left: 16px; }
    td:last-child  { padding-right: 16px; }
    .col-chk { width: 36px; }
    .row-chk { width: 14px; height: 14px; accent-color: var(--accent); cursor: pointer; }

    /* Pedido ID */
    .order-id { font-family: 'Sora', sans-serif; font-size: 0.78rem; font-weight: 700; color: var(--accent-2); }
    .order-time { font-size: 0.67rem; color: var(--text-4); margin-top: 1px; }

    /* Cliente cell */
    .client-cell { display: flex; align-items: center; gap: 9px; }
    .c-av { width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.65rem; font-weight: 700; flex-shrink: 0; }
    .c-name { font-weight: 600; color: var(--text); margin-bottom: 1px; }
    .c-phone { font-size: 0.67rem; color: var(--text-4); }

    /* Medicamentos cell */
    .meds-cell { max-width: 220px; }
    .med-name { color: var(--text-2); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .med-more { font-size: 0.67rem; color: var(--text-4); margin-top: 1px; }

    /* Status tag */
    .tag { display: inline-flex; align-items: center; font-size: 0.65rem; font-weight: 600; padding: 2px 7px; border-radius: 20px; white-space: nowrap; gap: 4px; }
    .tag i { font-size: 0.62rem; }
    .t-new      { background: var(--danger-light); color: var(--danger); }
    .t-prep     { background: var(--warning-light); color: #854f0b; }
    .t-route    { background: var(--accent-light); color: var(--accent-2); }
    .t-done     { background: var(--success-light); color: var(--success); }
    .t-canceled { background: #f1f5f9; color: var(--text-3); }

    /* Entregador */
    .entregador-cell { display: flex; align-items: center; gap: 6px; }
    .del-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
    .dd-busy    { background: var(--warning); }
    .dd-online  { background: var(--success); }
    .dd-none    { background: var(--text-4); }

    /* Priority badge */
    .priority { font-size: 0.65rem; font-weight: 700; padding: 1px 6px; border-radius: 20px; }
    .p-urgent { background: var(--danger-light); color: var(--danger); }

    /* Total price */
    .price-val { font-family: 'Sora', sans-serif; font-weight: 600; font-size: 0.82rem; color: var(--text); }

    /* Actions */
    .row-actions { display: flex; align-items: center; gap: 3px; opacity: 0; transition: opacity .1s; }
    tbody tr:hover .row-actions { opacity: 1; }
    .act-btn { width: 25px; height: 25px; border-radius: var(--r-sm); border: 1px solid var(--border); background: var(--surface); display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 0.77rem; color: var(--text-3); transition: all .1s; }
    .act-btn:hover { border-color: var(--accent-mid); color: var(--accent); background: var(--accent-light); }
    .act-btn.d:hover { border-color: #fca5a5; color: var(--danger); background: var(--danger-light); }

    /* ─── TABLE FOOTER ────────────────────── */
    .table-footer { display: flex; align-items: center; justify-content: space-between; padding: 9px 16px; border-top: 1px solid var(--border); background: var(--surface-2); font-size: 0.75rem; color: var(--text-3); flex-shrink: 0; flex-wrap: wrap; gap: 7px; }
    .tf-info { display: flex; align-items: center; gap: 9px; }
    .rows-sel { padding: 2px 20px 2px 7px; border: 1px solid var(--border); border-radius: var(--r-sm); font-size: 0.73rem; font-family: 'DM Sans', sans-serif; background: var(--surface) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='5'%3E%3Cpath d='M0 0l4 5 4-5z' fill='%2394a3b8'/%3E%3C/svg%3E") no-repeat right 6px center; appearance: none; color: var(--text-2); cursor: pointer; }
    .pagination { display: flex; align-items: center; gap: 3px; }
    .pg-btn { min-width: 27px; height: 27px; padding: 0 5px; border-radius: var(--r-sm); border: 1px solid var(--border); background: var(--surface); font-size: 0.75rem; font-family: 'DM Sans', sans-serif; color: var(--text-3); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all .1s; }
    .pg-btn:hover:not(:disabled) { border-color: var(--accent-mid); color: var(--accent); background: var(--accent-light); }
    .pg-btn.active { background: var(--accent); border-color: var(--accent); color: #fff; font-weight: 600; }
    .pg-btn:disabled { opacity: .35; cursor: default; }
    .pg-ell { padding: 0 4px; color: var(--text-4); font-size: 0.75rem; }

    /* Workflow buttons - estilo moderno */
    .workflow-actions {
      display: flex;
      gap: 8px;
      margin-top: 8px;
      flex-wrap: wrap;
    }
    .workflow-btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 12px;
      border: none;
      border-radius: 30px;
      font-size: 0.75rem;
      font-weight: 600;
      font-family: 'DM Sans', sans-serif;
      cursor: pointer;
      transition: all 0.2s ease;
      background-color: var(--surface-2);
      color: var(--text-2);
      border: 1px solid var(--border);
    }
    .workflow-btn i {
      font-size: 0.8rem;
    }
    .workflow-btn.approve {
      background-color: #e6f7e6;
      color: #2b7a2b;
      border-color: #b3e6b3;
    }
    .workflow-btn.approve:hover {
      background-color: #c8e6c8;
      transform: translateY(-1px);
    }
    .workflow-btn.reject {
      background-color: #ffe6e6;
      color: #b33;
      border-color: #ffcccc;
    }
    .workflow-btn.reject:hover {
      background-color: #ffcccc;
      transform: translateY(-1px);
    }
    .workflow-btn.paid {
      background-color: #e6f2ff;
      color: #0066cc;
      border-color: #b3d1ff;
    }
    .workflow-btn.paid:hover {
      background-color: #cce0ff;
      transform: translateY(-1px);
    }

    /* ─── EMPTY STATE ─────────────────────── */
    .empty-state { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 48px 20px; color: var(--text-4); }
    .empty-ico { width: 50px; height: 50px; border-radius: var(--r-xl); background: var(--surface-2); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 10px; }
    .empty-state h3 { font-size: 0.88rem; font-weight: 600; color: var(--text-3); margin-bottom: 4px; }
    .empty-state p { font-size: 0.77rem; text-align: center; max-width: 240px; }

    /* ─── DRAWER ──────────────────────────── */
    .drawer-overlay { display: none; position: fixed; inset: 0; background: rgba(15,23,42,.35); z-index: 400; backdrop-filter: blur(1px); }
    .drawer-overlay.open { display: block; }
    .drawer { position: fixed; top: 0; right: -500px; width: 500px; max-width: 96vw; height: 100vh; background: var(--surface); border-left: 1px solid var(--border); display: flex; flex-direction: column; transition: right .25s cubic-bezier(.4,0,.2,1); z-index: 500; box-shadow: -8px 0 32px rgba(0,0,0,.1); }
    .drawer.open { right: 0; }
    .drawer-head { padding: 16px 20px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; flex-shrink: 0; }
    .drawer-head-left { display: flex; flex-direction: column; gap: 3px; }
    .drawer-head-left h2 { font-family: 'Sora', sans-serif; font-size: 0.92rem; font-weight: 600; }
    .drawer-close { background: none; border: none; cursor: pointer; color: var(--text-3); font-size: 1rem; width: 28px; height: 28px; border-radius: var(--r-sm); display: flex; align-items: center; justify-content: center; transition: all .1s; }
    .drawer-close:hover { background: var(--surface-2); color: var(--text); }
    .drawer-body { flex: 1; overflow-y: auto; padding: 18px 20px; }
    .drawer-footer { padding: 12px 20px; border-top: 1px solid var(--border); display: flex; gap: 7px; justify-content: space-between; flex-shrink: 0; align-items: center; }

    /* Drawer sections */
    .d-section { margin-bottom: 18px; }
    .d-section-title { font-size: 0.7rem; font-weight: 600; color: var(--text-3); text-transform: uppercase; letter-spacing: .06em; margin-bottom: 10px; padding-bottom: 6px; border-bottom: 1px solid var(--border); }
    .d-row { display: flex; align-items: flex-start; gap: 8px; padding: 7px 0; border-bottom: 1px solid var(--border); font-size: 0.8rem; }
    .d-row:last-child { border-bottom: none; }
    .d-lbl { font-size: 0.72rem; color: var(--text-3); width: 130px; flex-shrink: 0; padding-top: 1px; }
    .d-val { flex: 1; color: var(--text-2); font-weight: 500; }

    /* Itens do pedido no drawer */
    .order-item { display: flex; align-items: center; gap: 10px; padding: 8px 10px; background: var(--surface-2); border: 1px solid var(--border); border-radius: var(--r-md); margin-bottom: 6px; }
    .oi-ico { width: 30px; height: 30px; border-radius: var(--r-sm); background: var(--accent-light); color: var(--accent-2); display: flex; align-items: center; justify-content: center; font-size: 0.82rem; flex-shrink: 0; }
    .oi-name { font-weight: 600; font-size: 0.8rem; color: var(--text); }
    .oi-qty { font-size: 0.72rem; color: var(--text-3); margin-top: 1px; }
    .oi-price { margin-left: auto; font-family: 'Sora', sans-serif; font-weight: 600; font-size: 0.82rem; color: var(--text); flex-shrink: 0; }

    /* Timeline no drawer */
    .timeline { position: relative; padding-left: 20px; }
    .tl-item { position: relative; padding-bottom: 14px; }
    .tl-item:last-child { padding-bottom: 0; }
    .tl-item::before { content: ''; position: absolute; left: -15px; top: 7px; bottom: -7px; width: 1px; background: var(--border); }
    .tl-item:last-child::before { display: none; }
    .tl-dot { position: absolute; left: -19px; top: 5px; width: 9px; height: 9px; border-radius: 50%; border: 2px solid var(--surface); }
    .tl-item.done .tl-dot   { background: var(--success); }
    .tl-item.active .tl-dot { background: var(--accent); box-shadow: 0 0 0 2px var(--accent-light); }
    .tl-item.pending .tl-dot { background: var(--border); }
    .tl-label { font-size: 0.78rem; font-weight: 600; color: var(--text); }
    .tl-label.pending { color: var(--text-4); }
    .tl-time  { font-size: 0.68rem; color: var(--text-4); margin-top: 1px; }

    /* Status change buttons in drawer */
    .status-actions { display: flex; gap: 6px; flex-wrap: wrap; }
    .sa-btn { display: inline-flex; align-items: center; gap: 5px; padding: 5px 11px; border-radius: var(--r-md); font-size: 0.75rem; font-weight: 600; cursor: pointer; border: 1px solid; font-family: 'DM Sans', sans-serif; transition: all .1s; }
    .sa-prep    { background: var(--warning-light); color: #854f0b; border-color: #fde68a; }
    .sa-prep:hover { background: #fde68a; }
    .sa-route   { background: var(--accent-light); color: var(--accent-2); border-color: var(--accent-mid); }
    .sa-route:hover { background: var(--accent-mid); }
    .sa-done    { background: var(--success-light); color: var(--success); border-color: #bbf7d0; }
    .sa-done:hover { background: #bbf7d0; }
    .sa-cancel  { background: var(--surface); color: var(--text-3); border-color: var(--border); }
    .sa-cancel:hover { background: var(--danger-light); color: var(--danger); border-color: #fca5a5; }

    /* Nota interna */
    .form-textarea { width: 100%; padding: 7px 10px; border: 1px solid var(--border); border-radius: var(--r-md); font-size: 0.78rem; font-family: 'DM Sans', sans-serif; color: var(--text); background: var(--surface); resize: vertical; min-height: 60px; transition: border-color .1s; }
    .form-textarea:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 2px rgba(8,153,166,.12); }

    /* ─── MODAL ───────────────────────────── */
    .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(15,23,42,.48); z-index: 600; align-items: center; justify-content: center; backdrop-filter: blur(2px); }
    .modal-overlay.open { display: flex; }
    .modal-box { background: var(--surface); border-radius: var(--r-xl); padding: 22px; width: 380px; max-width: 94vw; box-shadow: 0 20px 50px rgba(0,0,0,.18); animation: mIn .18s ease; }
    @keyframes mIn { from { transform:scale(.96); opacity:0; } to { transform:scale(1); opacity:1; } }
    .modal-ico { width: 38px; height: 38px; border-radius: var(--r-lg); display: flex; align-items: center; justify-content: center; font-size: 1rem; margin-bottom: 11px; }
    .modal-ico.danger { background: var(--danger-light); color: var(--danger); }
    .modal-ico.warning { background: var(--warning-light); color: var(--warning); }
    .modal-box h3 { font-family: 'Sora', sans-serif; font-size: 0.93rem; font-weight: 600; margin-bottom: 5px; }
    .modal-box p { font-size: 0.78rem; color: var(--text-3); line-height: 1.5; margin-bottom: 16px; }
    .modal-foot { display: flex; gap: 7px; justify-content: flex-end; }
    .btn-danger-solid { background: var(--danger); color: #fff; border-color: var(--danger); }

    /* ─── SCROLL ──────────────────────────── */
    ::-webkit-scrollbar { width: 4px; height: 4px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--border-strong); }

    @media (max-width: 768px) {
      .sidebar { transform: translateX(-100%); }
      .main { margin-left: 0; }
      .kpi-row { grid-template-columns: repeat(2, 1fr); }
      .status-tabs { flex-wrap: wrap; }
    }
  </style>
</head>
<body>
<div class="layout">

  <!-- ══ SIDEBAR ══════════════════════════════════ -->
<aside class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="logo">
            <div class="logo-mark">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 13v-2H9v-2h2V9h2v2h2v2h-2v2h-2z"/></svg>
            </div>
            <span class="logo-text"><span class="f">Farma</span><span class="c">Connect</span></span>
        </a>
    </div>

    <div class="sidebar-body">
        <div class="nav-section">
            <span class="nav-label">Principal</span>
            
            <!-- Dashboard -->
            <a href="{{ route('index.farmacias') }}" class="nav-item {{ request()->routeIs('index.farmacias') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i>
                <span>Dashboard</span>
            </a>

            <!-- Stock com submenu -->
            <div class="has-sub {{ request()->routeIs('medicamentos.farmacias') ? 'open' : '' }}" id="sub-stock">
                <div class="nav-item" onclick="toggleSub('sub-stock')">
                    <i class="bi bi-archive"></i>
                    <span>Stock</span>
                    <i class="bi bi-chevron-down chevron"></i>
                </div>
                <div class="sub">
                    <a href="{{ route('medicamentos.farmacias') }}" class="sub-item {{ request()->routeIs('medicamentos.farmacias') ? 'active-sub' : '' }}">
                        <i class="bi bi-list-ul"></i>
                        <span>Lista de produtos</span>
                    </a>
                    <div class="sub-item">
                        <i class="bi bi-exclamation-triangle"></i>
                        <span>Stock baixo</span>
                    </div>
                </div>
            </div>

            <!-- Pedidos -->
            <a href="{{ route('pedidos.farmacias') }}" class="nav-item {{ request()->routeIs('pedidos.farmacias') ? 'active' : '' }}">
                <i class="bi bi-truck"></i>
                <span>Pedidos</span>

            </a>

            <!-- Entregadores -->
            <a href="{{ route('entregadores.farmacias') }}" class="nav-item {{ request()->routeIs('entregadores.farmacias') ? 'active' : '' }}">
                <i class="bi bi-person-badge"></i>
                <span>Entregadores</span>

            </a>

            <!-- Clientes -->
            <a href="{{ route('clientes.farmacias') }}" class="nav-item {{ request()->routeIs('clientes.farmacias') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                <span>Clientes</span>
            </a>

            <!-- Avaliações -->
            <a href="{{ route('avaliacoes.farmacias') }}" class="nav-item {{ request()->routeIs('avaliacoes.farmacias') ? 'active' : '' }}">
                <i class="bi bi-star"></i>
                <span>Avaliações</span>

            </a>

            <span class="nav-label">Gestão</span>

            <!-- Documentos -->
            <a href="{{ route('documentos.farmacias') }}" class="nav-item {{ request()->routeIs('documentos.farmacias') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i>
                <span>Documentos</span>
            </a>

            <!-- Configurações com submenu -->
            <div class="has-sub" id="sub-cfg">
                <div class="nav-item" onclick="toggleSub('sub-cfg')">
                    <i class="bi bi-gear"></i>
                    <span>Configurações</span>
                    <i class="bi bi-chevron-down chevron"></i>
                </div>
                <div class="sub">
                    <div class="sub-item">
                        <i class="bi bi-person"></i>
                        <span>Perfil</span>
                    </div>
                    <div class="sub-item">
                        <i class="bi bi-shop"></i>
                        <span>Farmácia</span>
                    </div>
                    <div class="sub-item">
                        <i class="bi bi-clock"></i>
                        <span>Horário</span>
                    </div>
                </div>
            </div>

            <!-- Sair -->
            <form action="{{ route('logout', ['id'=>Auth::user()->id]) }}" method="post" class="logout-form">
                @csrf
                <button type="submit" class="nav-item logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sair</span>
                </button>
            </form>
        </div>
    </div>

    <div class="sidebar-footer">
        @php
            $farmacia = Auth::user()->farmacia;
        @endphp
        <div class="ph-card">
            <div class="ph-row">
                <span class="ph-name">{{ $farmacia->name ?? 'Farmácia' }}</span>
                <span class="ph-pill pill-open">{{ $farmacia->status ?? 'Aberta' }}</span>
            </div>
            <p class="ph-meta"><i class="bi bi-geo-alt"></i> {{ $farmacia->endereco ?? '—' }}</p>
            <p class="ph-meta"><i class="bi bi-clock"></i> {{ $farmacia->horario_abertura ?? '08:00' }} - {{ $farmacia->horario_fechamento ?? '22:00' }}</p>
            <p class="ph-meta" style="opacity:.55;font-size:.65rem;margin-top:2px"><i class="bi bi-building"></i> {{ $farmacia->company ?? 'FarmaConnect' }}</p>
        </div>
    </div>
</aside>

  <!-- ══ MAIN ══════════════════════════════════════ -->
  <div class="main">
    <header class="topbar">
      <div class="tb-left">
        <h1>Pedidos</h1>
        <span class="tb-sep">/</span>
        <span class="tb-sub" id="topbar-date">—</span>
      </div>
      <div class="tb-right">
        <div class="ib"><i class="bi bi-search"></i></div>
        <div class="ib"><i class="bi bi-bell"></i><span class="ib-dot"></span></div>
        <div class="user-chip">
          <div class="u-av">FC</div>
            <div><span class="u-name">{{Auth::user()->farmacia->name ?? 'FC'}}</span><span class="u-role">{{Auth::user()->name ?? 'Farmacêutico'}}</span></div>
        </div>
      </div>
    </header>

    <div class="content">

      @php
        $pendentes = $pedidos->where('status', 'Pendente')->count();
        $aprovados = $pedidos->where('status', 'Aprovado')->count();
        $pagos = $pedidos->where('status', 'pago')->count();
        $emEntrega = $pedidos->where('status', 'Em Entrega')->count();
        $concluidos = $pedidos->where('status', 'Concluído')->count();
        $cancelados = $pedidos->where('status', 'Cancelado')->count();
        $rejeitados = $pedidos->where('status', 'Rejeitado')->count();
        $totalHoje = $pedidosHoje->count();
        $faturacaoHoje = $pedidosHoje->sum(function($pedido) {
            return $pedido->items->sum(function($item) {
                return $item->preco * $item->quantidade;
            });
        });
      @endphp

      <!-- ─── KPIs ──────────────────────────────── -->
      <div class="kpi-row">
        <div class="kpi k-new" onclick="filterStatus('new')">
          <div class="kpi-head"><div class="kpi-ico red"><i class="bi bi-bell"></i></div><span class="kpi-chip kc-red" id="kn-new">{{ $pendentes }}</span></div>
          <div class="kpi-val" id="kv-new">{{ $pendentes }}</div><div class="kpi-lbl">Pendentes</div>
        </div>
        <div class="kpi k-prep" onclick="filterStatus('prep')">
          <div class="kpi-head"><div class="kpi-ico amber"><i class="bi bi-box-seam"></i></div><span class="kpi-chip kc-amber" id="kn-prep">{{ $aprovados + $pagos }}</span></div>
          <div class="kpi-val" id="kv-prep">{{ $aprovados + $pagos }}</div><div class="kpi-lbl">Em preparação</div>
        </div>
        <div class="kpi k-route" onclick="filterStatus('route')">
          <div class="kpi-head"><div class="kpi-ico teal"><i class="bi bi-bicycle"></i></div><span class="kpi-chip kc-teal" id="kn-route">{{ $emEntrega }}</span></div>
          <div class="kpi-val" id="kv-route">{{ $emEntrega }}</div><div class="kpi-lbl">Em rota</div>
        </div>
        <div class="kpi k-done" onclick="filterStatus('done')">
          <div class="kpi-head"><div class="kpi-ico green"><i class="bi bi-check-circle"></i></div><span class="kpi-chip kc-green" id="kn-done">{{ $totalHoje }}</span></div>
          <div class="kpi-val" id="kv-done">{{ $totalHoje }}</div><div class="kpi-lbl">Entregues hoje</div>
        </div>
        <div class="kpi k-canceled" onclick="filterStatus('all')">
          <div class="kpi-head"><div class="kpi-ico slate"><i class="bi bi-currency-exchange"></i></div><span class="kpi-chip kc-slate">hoje</span></div>
          <div class="kpi-val" id="kv-fat">{{ number_format($faturacaoHoje, 0, ',', '.') }} Kz</div><div class="kpi-lbl">Faturação</div>
        </div>
      </div>

      <!-- ─── TOOLBAR ───────────────────────────── -->
      <div class="toolbar">
        <div class="toolbar-left">
          <div class="search-wrap">
            <i class="bi bi-search"></i>
            <input type="text" class="search-input" id="searchInput" placeholder="Pesquisar por ID, cliente, medicamento…" oninput="applyFilters()">
          </div>

          <!-- Status tabs -->
          <div class="status-tabs">
            <button class="st-tab active" data-status="all" onclick="setTab(this,'all')">Todos <span class="tab-count" id="tc-all">{{ $pedidos->total() }}</span></button>
            <button class="st-tab" data-status="new" onclick="setTab(this,'new')"><i class="bi bi-bell" style="font-size:.7rem"></i> Pendentes <span class="tab-count" id="tc-new">{{ $pendentes }}</span></button>
            <button class="st-tab" data-status="prep" onclick="setTab(this,'prep')"><i class="bi bi-box-seam" style="font-size:.7rem"></i> Em preparação <span class="tab-count" id="tc-prep">{{ $aprovados + $pagos }}</span></button>
            <button class="st-tab" data-status="route" onclick="setTab(this,'route')"><i class="bi bi-bicycle" style="font-size:.7rem"></i> Em rota <span class="tab-count" id="tc-route">{{ $emEntrega }}</span></button>
            <button class="st-tab" data-status="done" onclick="setTab(this,'done')"><i class="bi bi-check-circle" style="font-size:.7rem"></i> Concluídos <span class="tab-count" id="tc-done">{{ $concluidos }}</span></button>
            <button class="st-tab" data-status="canceled" onclick="setTab(this,'canceled')">Cancelados <span class="tab-count" id="tc-canceled">{{ $cancelados + $rejeitados }}</span></button>
          </div>
        </div>

          <div class="toolbar-right">
            <form action="{{ route('farmacias.report') }}" method="post">
              @csrf
              <!-- Adiciona estes campos (podes usar inputs de data se preferires) -->
              <input type="hidden" name="data_inicio" value="{{ request('data_inicio', now()->startOfMonth()->toDateString()) }}">
              <input type="hidden" name="data_fim" value="{{ request('data_fim', now()->toDateString()) }}">
              <input type="hidden" name="tipo_relatorio" value="pdf">

              <button class="btn btn-outline btn-icon" type="submit" style="background-color: #0899a6;color:white; " title="Exportar" ><i class="bi bi-download"></i>Imprimir Relatório</button>
            </form>
        </div>


      </div>

      <!-- ─── BULK BAR ──────────────────────────── -->
      <div class="bulk-bar" id="bulkBar">
        <i class="bi bi-check2-square"></i>
        <span class="bulk-count" id="bulkCount">0</span>
        <span>pedidos selecionados</span>
        <div class="bulk-sp"></div>
        <button class="bulk-btn" onclick="bulkChangeStatus('prep')"><i class="bi bi-box-seam"></i> Marcar como Em preparação</button>
        <button class="bulk-btn" onclick="bulkChangeStatus('route')"><i class="bi bi-bicycle"></i> Atribuir entrega</button>
        <button class="bulk-btn bd" onclick="bulkChangeStatus('canceled')"><i class="bi bi-x-circle"></i> Cancelar</button>
        <button class="bulk-close" onclick="clearSel()"><i class="bi bi-x-lg"></i></button>
      </div>

      <!-- ─── TABLE ─────────────────────────────── -->
      <div class="table-wrap" id="tableWrap">
        <div class="table-scroll">
          <table>
            <thead>
              <tr>
                <th class="col-chk ns"><input type="checkbox" class="row-chk" id="selAll" onchange="toggleAll(this)"></th>
                <th onclick="sortBy('id')" class="sorted">Pedido <i class="bi bi-arrow-down si"></i></th>
                <th onclick="sortBy('client')">Cliente <i class="bi bi-arrow-up-down si"></i></th>
                <th class="ns">Medicamentos</th>
                <th onclick="sortBy('status')" class="ns">Estado</th>
                <th class="ns">Entregador</th>
                <th onclick="sortBy('total')">Total <i class="bi bi-arrow-up-down si"></i></th>
                <th class="ns"></th>
              </tr>
            </thead>
            <tbody id="ordersBody">
              @forelse($pedidos as $pedido)
                @php
                  $cliente = $pedido->user ;
                  $items = $pedido->items;
                  $total = $items->sum(function($item) {
                      return $item->preco_unitario * $item->quantidade;
                  });
                  $primeiroItem = $items->first();
                  $restantes = $items->count() - 1;
                  
                  $statusMap = [
                      'Pendente' => ['tag' => 't-new', 'icon' => 'bi-bell', 'label' => 'Pendente'],
                      'Aprovado' => ['tag' => 't-prep', 'icon' => 'bi-box-seam', 'label' => 'Aprovado'],
                      'pago' => ['tag' => 't-prep', 'icon' => 'bi-credit-card', 'label' => 'Pago'],
                      'Em Entrega' => ['tag' => 't-route', 'icon' => 'bi-bicycle', 'label' => 'Em Entrega'],
                      'Concluído' => ['tag' => 't-done', 'icon' => 'bi-check-circle', 'label' => 'Concluído'],
                      'Cancelado' => ['tag' => 't-canceled', 'icon' => 'bi-x-circle', 'label' => 'Cancelado'],
                      'Rejeitado' => ['tag' => 't-canceled', 'icon' => 'bi-x-circle', 'label' => 'Rejeitado'],
                  ];
                  $status = $statusMap[$pedido->status] ?? $statusMap['Pendente'];
                  
                  $corCliente = $cliente ? '#' . substr(md5($cliente->name ?? $cliente->id), 0, 6) : '#888';
                  // $corCliente = '#' . substr(md5($cliente->name ?? $cliente->id ), 0, 6);
                  $iniciais = $cliente ? implode('', array_map(function($n) { return $n[0] ?? ''; }, explode(' ', $cliente->name))) : '--';
                @endphp
                <tr data-id="{{ $pedido->id }}">
                  <td class="col-chk"><input type="checkbox" class="row-chk" onchange="toggleRow({{ $pedido->id }}, this)"></td>
                  <td>
                    <div class="order-id">#{{ str_pad($pedido->id, 4, '0', STR_PAD_LEFT) }}</div>
                    <div class="order-time">{{ $pedido->data_pedido->format('H:i') }} · {{ $pedido->data_pedido->diffForHumans() }}</div>
                  </td>
                  <td>
                    <div class="client-cell">
                      <div class="c-av" style="background:{{ $corCliente }};color:white">{{ $iniciais }}</div>
                      <div>
                        <div class="c-name">{{ $cliente->name ?? 'Cliente' }}</div>
                        <div class="c-phone">{{ $cliente->phone ?? '—' }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="meds-cell">
                    <div class="med-name">{{ $items->count() ?? $primeiroItem->name ?? 'Medicamento' }}</div>
                    {{-- @if($restantes > 0)
                      <div class="med-more">+{{ $restantes }} mais</div>
                    @endif --}}
                  </td>

                  <td>
                    <span class="tag {{ $status['tag'] }}">
                      <i class="bi {{ $status['icon'] }}"></i>{{ $status['label'] }}
                    </span>
                  </td>
                  <td>
                    @if($pedido->entrega )
                      <div class="entregador-cell">
                        <span style="font-size:.78rem;color:var(--text-2)"><strong>{{ $pedido->entrega->entregador->name }}</strong></span>
                      </div>

                    @else
                      <span style="font-size:.75rem;color:var(--text-4)">UNKNOWN</span>
                    @endif
                  </td>
                  <td><span class="price-val">{{ number_format($total, 0, ',', '.') }} Kz</span></td>
                  <td>
                     
                         <!-- NOVOS BOTÕES DE APROVAÇÃO -->
                    <div class="workflow-actions">
                      @if($pedido->status == "Pendente")
                        <form action="{{ route('pedidos.status.update', $pedido->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="Aprovado">
                            <button type="submit" class="workflow-btn approve">
                                <i class="bi bi-check-circle"></i> Aprovar
                            </button>
                        </form>
                      @endif
                      @if($pedido->status != "Rejeitado")
                        <form action="{{ route('pedidos.status.update', $pedido->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="Rejeitado">
                            <button type="submit" class="workflow-btn reject">
                                <i class="bi bi-x-circle"></i> Rejeitar
                            </button>
                        </form>
                      @endif
                      @if($pedido->status =="Aprovado")
                        <form action="{{ route('pedidos.status.update', $pedido->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="pago">
                            <button type="submit" class="workflow-btn paid">
                                <i class="bi bi-credit-card"></i> Marcar pago
                            </button>
                        </form>
                      @endif
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="10" style="text-align:center;padding:32px;color:var(--text-4)">
                    Nenhum pedido encontrado
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="empty-state" id="emptyState" style="display:none">
          <div class="empty-ico"><i class="bi bi-inbox"></i></div>
          <h3>Nenhum pedido encontrado</h3>
          <p>Ajusta os filtros ou o termo de pesquisa.</p>
        </div>
        <div class="table-footer">
          <div class="tf-info">
            <span>Mostrar</span>
            <select class="rows-sel" id="rowsPerPage" onchange="changePage(1)">
              <option value="15">15</option>
              <option value="25" selected>25</option>
              <option value="50">50</option>
            </select>
            <span>por página &nbsp;·&nbsp; <span id="pageInfo">{{ $pedidos->firstItem() ?? 0 }}–{{ $pedidos->lastItem() ?? 0 }} de {{ $pedidos->total() }}</span></span>
          </div>
          <div class="pagination" id="pagination">
            {{ $pedidos->links() }}
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- ══ DRAWER — Detalhe do pedido ═══════════════ -->
<div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>
<div class="drawer" id="drawer">
  <div class="drawer-head">
    <div class="drawer-head-left">
      <h2 id="drawerTitle">Pedido #FC-0000</h2>
      <span id="drawerSubtitle" style="font-size:.72rem;color:var(--text-3)"></span>
    </div>
    <button class="drawer-close" onclick="closeDrawer()"><i class="bi bi-x-lg"></i></button>
  </div>
  <div class="drawer-body" id="drawerBody">
    <!-- Conteúdo dinâmico via JavaScript -->
  </div>
  <div class="drawer-footer">
    <div id="drawerStatusBtns" class="status-actions"></div>
    <button class="btn btn-outline" onclick="closeDrawer()">Fechar</button>
  </div>
</div>

<!-- ══ MODAL CANCELAR ════════════════════════════ -->
<div class="modal-overlay" id="cancelModal">
  <div class="modal-box">
    <div class="modal-ico warning"><i class="bi bi-exclamation-triangle"></i></div>
    <h3>Cancelar pedido?</h3>
    <p id="cancelText">O cliente será notificado. Esta acção não pode ser revertida.</p>
    <div class="modal-foot">
      <button class="btn btn-outline" onclick="document.getElementById('cancelModal').classList.remove('open')">Voltar</button>
      <button class="btn btn-danger-solid" onclick="confirmCancel()"><i class="bi bi-x-circle"></i> Cancelar pedido</button>
    </div>
  </div>
</div>

<script>
  function escapeHtml(str) {
    if (!str) return '';
    return str.replace(/[&<>]/g, function(m) {
        if (m === '&') return '&amp;';
        if (m === '<') return '&lt;';
        if (m === '>') return '&gt;';
        return m;
    });
}
/* ══ DADOS DO BACKEND ═══════════════════════════ */
const pedidosBackend = @json($pedidos->items());
const entregadoresBackend = @json($entregadores ?? []);

let allOrders = pedidosBackend.map(p => {
    const cliente = p.user || {};
    // Mapeamento completo dos itens
    const items = (p.items || []).map(item => ({
        id: item.id,
        name: item.stockItem?.medicamento?.name || 'Medicamento',
        quantidade: item.quantidade,
        preco_unitario: item.preco_unitario,
        subtotal: item.subtotal,
        prescricao_path: item.prescricao_path || null,
        requer_receita: item.stockItem?.medicamento?.requer_receita || false
    }));
    
    const total = items.reduce((sum, it) => sum + (it.subtotal || it.preco_unitario * it.quantidade), 0);
    
    return {
        id: p.id,
        ref: '#' + String(p.id).padStart(4, '0'),
        client: {
            id: cliente.id,
            name: cliente.name || 'Cliente',
            phone: cliente.phone || '—',
            email: cliente.email || '',
            initials: cliente.name ? cliente.name.split(' ').map(n => n[0] || '').join('').substring(0,2).toUpperCase() : '--',
        },
        items: items,        // lista completa de itens
        status: p.status,
        entregador: p.entrega?.entregador ? {
            id: p.entrega.entregador.id,
            name: p.entrega.entregador.name,
            status: p.entrega.entregador.status || 'online'
        } : null,
        total: total,
        morada: p.endereco || '—',
        data: p.data_pedido,
        minsAgo: Math.floor((new Date() - new Date(p.data_pedido)) / (1000 * 60)),
        pagamento: p.pagamento?.metodo_pagamento || '—',
        pagamento_id: p.pagamento?.id || null
    };
});

/* ══ STATE ══════════════════════════════════════════ */
let filtered    = [...allOrders];
let currentPage = 1;
let currentTab  = 'all';
let currentSort = { key: 'id', dir: 'desc' };
let selected    = new Set();
let cancelTargetId = null;

/* ══ DATE ════════════════════════════════════════════ */
const DIAS  = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];
const MESES = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
const now = new Date();
document.getElementById('topbar-date').textContent =
  `${DIAS[now.getDay()]}, ${now.getDate()} de ${MESES[now.getMonth()]} de ${now.getFullYear()}`;

/* ══ RENDER ═════════════════════════════════════════ */
function getRPP() { return parseInt(document.getElementById('rowsPerPage').value); }

const STATUS_MAP = {
  'Pendente':    { tag:'t-new',      label:'Pendente',     icon:'bi-bell' },
  'Aprovado':    { tag:'t-prep',     label:'Aprovado',     icon:'bi-box-seam' },
  'pago':        { tag:'t-prep',     label:'Pago',         icon:'bi-credit-card' },
  'Em Entrega':  { tag:'t-route',    label:'Em Entrega',   icon:'bi-bicycle' },
  'Concluído':   { tag:'t-done',     label:'Concluído',    icon:'bi-check-circle' },
  'Cancelado':   { tag:'t-canceled', label:'Cancelado',    icon:'bi-x-circle' },
  'Rejeitado':   { tag:'t-canceled', label:'Rejeitado',    icon:'bi-x-circle' },
};


function render() {
  const rpp   = getRPP();
  const total = filtered.length;
  const pages = Math.max(1, Math.ceil(total / rpp));
  if (currentPage > pages) currentPage = pages;
  const start = (currentPage - 1) * rpp;
  const slice = filtered.slice(start, start + rpp);

  const tbody = document.getElementById('ordersBody');
  tbody.innerHTML = '';
  
  if (slice.length === 0) {
    document.getElementById('emptyState').style.display = 'flex';
    document.querySelector('.table-scroll').style.display = 'none';
    return;
  }
  
  document.getElementById('emptyState').style.display = 'none';
  document.querySelector('.table-scroll').style.display = '';

  slice.forEach(o => {
    const sm  = STATUS_MAP[o.status] || STATUS_MAP['Pendente'];
    const sel = selected.has(o.id);
    const medStr = o.meds[0] || '—';
    const medExtra = o.meds.length > 1 ? `+${o.meds.length-1} mais` : '';
    const delHtml = o.entregador
      ? `<div class="entregador-cell"><div class="del-dot ${o.entregador.status==='online'?'dd-online':'dd-busy'}"></div><span style="font-size:.78rem;color:var(--text-2)">${o.entregador.name}</span></div>`
      : `<span style="font-size:.75rem;color:var(--text-4)">—</span>`;

    tbody.innerHTML += `
      <tr data-id="${o.id}" class="${sel?'selected':''}">
        <td class="col-chk"><input type="checkbox" class="row-chk" ${sel?'checked':''} onchange="toggleRow(${o.id},this)"></td>
        <td>
          <div class="order-id">${o.ref}</div>
          <div class="order-time">${o.minsAgo < 60 ? o.minsAgo+'min atrás' : Math.floor(o.minsAgo/60)+'h atrás'}</div>
        </td>
        <td>
          <div class="client-cell">
            <div class="c-av" style="background:#0899a6;color:white">${o.client.initials}</div>
            <div>
              <div class="c-name">${o.client.name}</div>
              <div class="c-phone">${o.client.phone}</div>
            </div>
          </div>
        </td>
        <td class="meds-cell">
          <div class="med-name">${medStr}</div>
          ${medExtra ? `<div class="med-more">${medExtra}</div>` : ''}
        </td>
        <td><span class="tag ${sm.tag}"><i class="bi ${sm.icon}"></i>${sm.label}</span></td>
        <td>${delHtml}</td>
        <td><span class="price-val">${o.total.toLocaleString('pt-AO')} Kz</span></td>
        <td>
          <div class="row-actions">
            <button class="act-btn" title="Ver detalhe" onclick="openDrawer(${o.id})"><i class="bi bi-eye"></i></button>
            ${['Pendente','Aprovado'].includes(o.status) ? `<button class="act-btn" title="Preparar" onclick="changeStatus(${o.id},'Aprovado')"><i class="bi bi-box-seam"></i></button>` : ''}
            ${o.status === 'pago' ? `<button class="act-btn" title="Enviar" onclick="changeStatus(${o.id},'Em Entrega')"><i class="bi bi-bicycle"></i></button>` : ''}
            ${o.status === 'Em Entrega' ? `<button class="act-btn" title="Concluir" onclick="changeStatus(${o.id},'Concluído')"><i class="bi bi-check-circle"></i></button>` : ''}
            ${!['Concluído','Cancelado','Rejeitado'].includes(o.status) ? `<button class="act-btn d" title="Cancelar" onclick="openCancelModal(${o.id})"><i class="bi bi-x-circle"></i></button>` : ''}
          </div>
        </td>
      </tr>`;
  });

  const end = Math.min(start + rpp, total);
  document.getElementById('pageInfo').textContent = total === 0 ? '0 resultados' : `${start+1}–${end} de ${total}`;
  updateSelectAll();
}

function updateSelectAll() {
  const rpp=getRPP(), start=(currentPage-1)*rpp, slice=filtered.slice(start,start+rpp);
  const allSel = slice.length>0 && slice.every(o=>selected.has(o.id));
  document.getElementById('selAll').checked = allSel;
  document.getElementById('selAll').indeterminate = !allSel && slice.some(o=>selected.has(o.id));
}

function updateBulkBar() {
  const bar = document.getElementById('bulkBar');
  bar.classList.toggle('show', selected.size>0);
  document.getElementById('bulkCount').textContent = selected.size;
}

function clearSel() { selected.clear(); render(); updateBulkBar(); }

function toggleRow(id, cb) {
  if(cb.checked) selected.add(id); else selected.delete(id);
  document.querySelector(`tr[data-id="${id}"]`).classList.toggle('selected', cb.checked);
  updateBulkBar(); updateSelectAll();
}

function toggleAll(cb) {
  const rpp=getRPP(), start=(currentPage-1)*rpp, slice=filtered.slice(start,start+rpp);
  slice.forEach(o=>{ if(cb.checked) selected.add(o.id); else selected.delete(o.id); });
  render(); updateBulkBar();
}

/* ══ FILTER & SORT ══════════════════════════════════ */
function applyFilters() {
  const q = document.getElementById('searchInput').value.trim().toLowerCase();
  
  filtered = allOrders.filter(o => {
    const mq = !q || 
      o.ref.toLowerCase().includes(q) || 
      o.client.name.toLowerCase().includes(q) || 
      o.meds.some(m => m.toLowerCase().includes(q));
      
    if (currentTab === 'all') return mq;
    if (currentTab === 'new') return mq && o.status === 'Pendente';
    if (currentTab === 'prep') return mq && (o.status === 'Aprovado' || o.status === 'pago');
    if (currentTab === 'route') return mq && o.status === 'Em Entrega';
    if (currentTab === 'done') return mq && o.status === 'Concluído';
    if (currentTab === 'canceled') return mq && (o.status === 'Cancelado' || o.status === 'Rejeitado');
    return mq;
  });
  
  applySort();
  currentPage = 1;
  render();
}

function applySort() {
  const sort = document.getElementById('sortSel').value;
  
  filtered.sort((a,b) => {
    if (sort === 'time-desc') return b.minsAgo - a.minsAgo;
    if (sort === 'time-asc') return a.minsAgo - b.minsAgo;
    if (sort === 'total-desc') return b.total - a.total;
    if (sort === 'total-asc') return a.total - b.total;
    return 0;
  });
}

function setTab(el, status) {
  document.querySelectorAll('.st-tab').forEach(t=>t.classList.remove('active'));
  el.classList.add('active');
  currentTab = status;
  applyFilters();
}

function filterStatus(status) {
  const tabMap = { 'new': 'new', 'prep': 'prep', 'route': 'route', 'done': 'done' };
  const tab = document.querySelector(`.st-tab[data-status="${tabMap[status] || 'all'}"]`);
  if(tab) setTab(tab, tabMap[status] || 'all');
}

function changePage(p) { currentPage = p; render(); }

/* ══ STATUS CHANGE ══════════════════════════════════ */
function changeStatus(id, newStatus) {
  const o = allOrders.find(x => x.id === id);
  if (o) {
    o.status = newStatus;
    
    // Aqui você chamaria a API para atualizar no backend
    fetch(`/farmacias/pedidos/${id}/status`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      body: JSON.stringify({ status: newStatus })
    }).then(() => {
      applyFilters();
      if (currentDrawerId === id) openDrawer(id);
    });
  }
}

function bulkChangeStatus(newStatus) {
  selected.forEach(id => {
    const o = allOrders.find(x => x.id === id);
    if (o) o.status = newStatus;
  });
  
  // Aqui você chamaria a API para atualizar em lote
  fetch(`/farmacias/pedidos/bulk-status`, {
    method: 'PUT',
    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
    body: JSON.stringify({ ids: Array.from(selected), status: newStatus })
  }).then(() => {
    clearSel();
    applyFilters();
  });
}

/* ══ CANCEL ═════════════════════════════════════════ */
function openCancelModal(id) {
  cancelTargetId = id;
  const o = allOrders.find(x=>x.id===id);
  document.getElementById('cancelText').textContent = `Vai cancelar o pedido ${o?.ref} de ${o?.client.name}. O cliente será notificado.`;
  document.getElementById('cancelModal').classList.add('open');
}

function confirmCancel() {
  if(cancelTargetId) changeStatus(cancelTargetId, 'Cancelado');
  document.getElementById('cancelModal').classList.remove('open');
  cancelTargetId = null;
  closeDrawer();
}

document.getElementById('cancelModal').addEventListener('click', function(e){ if(e.target===this) this.classList.remove('open'); });

/* ══ DRAWER ═════════════════════════════════════════ */
let currentDrawerId = null;

function openDrawer(id) {
  currentDrawerId = id;
  const o = allOrders.find(x => x.id === id);
  if (!o) return;
  
  const sm = STATUS_MAP[o.status] || STATUS_MAP['Pendente'];

  document.getElementById('drawerTitle').textContent = `Pedido ${o.ref}`;
  document.getElementById('drawerSubtitle').innerHTML = `
    <span class="tag ${sm.tag}" style="font-size:.68rem">
      <i class="bi ${sm.icon}"></i>${sm.label}
    </span> &nbsp;·&nbsp; 
    ${o.minsAgo < 60 ? o.minsAgo+'min atrás' : Math.floor(o.minsAgo/60)+'h atrás'}`;

  // Timeline
  const statusOrder = ['Pendente', 'Aprovado', 'pago', 'Em Entrega', 'Concluído'];
  const curOrd = statusOrder.indexOf(o.status);
  
  let tlHtml = '';
  statusOrder.forEach((st, i) => {
    if (st === 'pago' || st === 'Aprovado') return; // Pular estados intermediários
    const stepLabel = st === 'Pendente' ? 'Pedido recebido' :
                      st === 'Em Entrega' ? 'Em rota de entrega' :
                      st === 'Concluído' ? 'Entregue ao cliente' : st;
    const cls = o.status === 'Cancelado' || o.status === 'Rejeitado' ? 'pending' :
                i < curOrd ? 'done' : i === curOrd ? 'active' : 'pending';
    
    tlHtml += `
      <div class="tl-item ${cls}">
        <div class="tl-dot"></div>
        <div class="tl-label ${cls==='pending'?'pending':''}">${stepLabel}</div>
        ${cls !== 'pending' ? `<div class="tl-time">${o.data ? new Date(o.data).toLocaleTimeString() : ''}</div>` : ''}
      </div>`;
  });
  
  if (o.status === 'Cancelado' || o.status === 'Rejeitado') {
    tlHtml += `
      <div class="tl-item pending">
        <div class="tl-dot" style="background:var(--danger)"></div>
        <div class="tl-label" style="color:var(--danger)">Pedido cancelado</div>
      </div>`;
  }

// Itens do pedido (detalhados)
let itemsHtml = '';
if (o.items && o.items.length > 0) {
    itemsHtml = o.items.map(item => `
        <div class="order-item">
            <div class="oi-ico"><i class="bi bi-capsule"></i></div>
            <div>
                <div class="oi-name">${escapeHtml(item.name)}</div>
                <div class="oi-qty">${item.quantidade} un. × ${item.preco_unitario.toLocaleString('pt-AO')} Kz</div>
            </div>
            <div class="oi-price">${item.subtotal.toLocaleString('pt-AO')} Kz</div>
        </div>
    `).join('');
} else {
    itemsHtml = '<div class="text-center p-3 text-secondary">Nenhum item encontrado</div>';
}

// Secção de receitas médicas (apenas se existirem itens com prescrição)
let prescHtml = '';
const itensComReceita = o.items.filter(item => item.requer_receita && item.prescricao_path);
if (itensComReceita.length > 0) {
    prescHtml = `
        <div class="d-section">
            <div class="d-section-title"><i class="bi bi-file-earmark-medical"></i> Receitas médicas</div>
            ${itensComReceita.map(item => `
                <div class="d-row">
                    <span class="d-lbl">${escapeHtml(item.name)}</span>
                    <span class="d-val">
                        <a href="${item.prescricao_path}" target="_blank" class="presc-link">
                            <i class="bi bi-file-pdf"></i> Ver receita
                        </a>
                    </span>
                </div>
            `).join('')}
        </div>
    `;
}

  document.getElementById('drawerBody').innerHTML = `
    <div class="d-section">
      <div class="d-section-title">Progresso</div>
      <div class="timeline" style="margin-top:6px">${tlHtml}</div>
    </div>

    <div class="d-section">
      <div class="d-section-title">Itens do pedido</div>
      ${itemsHtml}
      <div style="display:flex;justify-content:space-between;padding:10px 10px 0;font-size:.8rem">
        <span style="color:var(--text-3)">Total</span>
        <span style="font-family:'Sora',sans-serif;font-weight:700;color:var(--text)">${o.total.toLocaleString('pt-AO')} Kz</span>
      </div>
    </div>

    <div class="d-section">
      <div class="d-section-title">Cliente & Entrega</div>
      <div class="d-row"><span class="d-lbl">Cliente</span><span class="d-val">${o.client.name}</span></div>
      <div class="d-row"><span class="d-lbl">Contacto</span><span class="d-val">${o.client.phone}</span></div>
      <div class="d-row"><span class="d-lbl">Morada</span><span class="d-val">${o.morada}</span></div>
      <div class="d-row"><span class="d-lbl">Entregador</span><span class="d-val">${o.entregador ? o.entregador.name : '—'}</span></div>
      <div class="d-row"><span class="d-lbl">Pagamento</span><span class="d-val">${o.pagamento}</span></div>
    </div>`;

  // Botões de ação
  let btns = '';
  if (o.status === 'Pendente') btns += `<button class="sa-btn sa-prep" onclick="changeStatus(${o.id},'Aprovado')"><i class="bi bi-box-seam"></i> Aprovar</button>`;
  if (o.status === 'Aprovado') btns += `<button class="sa-btn sa-route" onclick="changeStatus(${o.id},'pago')"><i class="bi bi-credit-card"></i> Confirmar pagamento</button>`;
  if (o.status === 'pago') btns += `<button class="sa-btn sa-route" onclick="changeStatus(${o.id},'Em Entrega')"><i class="bi bi-bicycle"></i> Iniciar entrega</button>`;
  if (o.status === 'Em Entrega') btns += `<button class="sa-btn sa-done" onclick="changeStatus(${o.id},'Concluído')"><i class="bi bi-check-circle"></i> Concluir</button>`;
  if (!['Concluído','Cancelado','Rejeitado'].includes(o.status)) {
    btns += `<button class="sa-btn sa-cancel" onclick="openCancelModal(${o.id})"><i class="bi bi-x-circle"></i> Cancelar</button>`;
  }
  document.getElementById('drawerStatusBtns').innerHTML = btns;

  document.getElementById('drawerOverlay').classList.add('open');
  document.getElementById('drawer').classList.add('open');
}

function closeDrawer() {
  document.getElementById('drawerOverlay').classList.remove('open');
  document.getElementById('drawer').classList.remove('open');
  currentDrawerId = null;
}

/* ══ SIDEBAR ═════════════════════════════════════════ */
function setActive(el) { 
  document.querySelectorAll('.nav-item.active').forEach(i => i.classList.remove('active')); 
  el.classList.add('active'); 
}

function toggleSub(id) { 
  document.getElementById(id).classList.toggle('open'); 
}

/* ══ INIT ════════════════════════════════════════════ */
applyFilters();
</script>

{{-- <script>
function escapeHtml(str) {
    if (!str) return '';
    return str.replace(/[&<>]/g, function(m) {
        if (m === '&') return '&amp;';
        if (m === '<') return '&lt;';
        if (m === '>') return '&gt;';
        return m;
    });
}

/* ══ DADOS DO BACKEND ═══════════════════════════ */
const pedidosBackend = @json($pedidos->items());
const entregadoresBackend = @json($entregadores ?? []);

let allOrders = pedidosBackend.map(p => {
    const cliente = p.user || {};
    // Mapeamento completo dos itens
    const items = (p.items || []).map(item => ({
        id: item.id,
        name: item.stockItem?.medicamento?.name || 'Medicamento',
        quantidade: item.quantidade,
        preco_unitario: item.preco_unitario,
        subtotal: item.subtotal,
        prescricao_path: item.prescricao_path || null,
        requer_receita: item.stockItem?.medicamento?.requer_receita || false
    }));
    
    const total = items.reduce((sum, it) => sum + (it.subtotal || it.preco_unitario * it.quantidade), 0);
    
    return {
        id: p.id,
        ref: '#' + String(p.id).padStart(4, '0'),
        client: {
            id: cliente.id,
            name: cliente.name || 'Cliente',
            phone: cliente.phone || '—',
            email: cliente.email || '',
            initials: cliente.name ? cliente.name.split(' ').map(n => n[0] || '').join('').substring(0,2).toUpperCase() : '--',
        },
        items: items,                              // lista completa de itens
        status: p.status,
        entregador: p.entrega?.entregador ? {
            id: p.entrega.entregador.id,
            name: p.entrega.entregador.name,
            status: p.entrega.entregador.status || 'online'
        } : null,
        total: total,
        morada: p.endereco || '—',
        data: p.data_pedido,
        minsAgo: Math.floor((new Date() - new Date(p.data_pedido)) / (1000 * 60)),
        metodo_pagamento: p.pagamento?.metodo_pagamento || '—',
        comprovativo_path: p.pagamento?.comprovativo?.arquivo_path || null
    };
});

/* ══ STATE ══════════════════════════════════════════ */
let filtered    = [...allOrders];
let currentPage = 1;
let currentTab  = 'all';
let currentSort = { key: 'id', dir: 'desc' };
let selected    = new Set();
let cancelTargetId = null;

/* ══ DATE ════════════════════════════════════════════ */
const DIAS  = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];
const MESES = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
const now = new Date();
document.getElementById('topbar-date').textContent =
  `${DIAS[now.getDay()]}, ${now.getDate()} de ${MESES[now.getMonth()]} de ${now.getFullYear()}`;

/* ══ RENDER ═════════════════════════════════════════ */
function getRPP() { return parseInt(document.getElementById('rowsPerPage').value); }

const STATUS_MAP = {
  'Pendente':    { tag:'t-new',      label:'Pendente',     icon:'bi-bell' },
  'Aprovado':    { tag:'t-prep',     label:'Aprovado',     icon:'bi-box-seam' },
  'pago':        { tag:'t-prep',     label:'Pago',         icon:'bi-credit-card' },
  'Em Entrega':  { tag:'t-route',    label:'Em Entrega',   icon:'bi-bicycle' },
  'Concluído':   { tag:'t-done',     label:'Concluído',    icon:'bi-check-circle' },
  'Cancelado':   { tag:'t-canceled', label:'Cancelado',    icon:'bi-x-circle' },
  'Rejeitado':   { tag:'t-canceled', label:'Rejeitado',    icon:'bi-x-circle' },
};

function render() {
  const rpp   = getRPP();
  const total = filtered.length;
  const pages = Math.max(1, Math.ceil(total / rpp));
  if (currentPage > pages) currentPage = pages;
  const start = (currentPage - 1) * rpp;
  const slice = filtered.slice(start, start + rpp);

  const tbody = document.getElementById('ordersBody');
  tbody.innerHTML = '';
  
  if (slice.length === 0) {
    document.getElementById('emptyState').style.display = 'flex';
    document.querySelector('.table-scroll').style.display = 'none';
    return;
  }
  
  document.getElementById('emptyState').style.display = 'none';
  document.querySelector('.table-scroll').style.display = '';

  slice.forEach(o => {
    const sm  = STATUS_MAP[o.status] || STATUS_MAP['Pendente'];
    const sel = selected.has(o.id);
    // Primeiro medicamento da lista (baseado em o.items)
    const firstMed = o.items[0]?.name || '—';
    const medExtra = o.items.length > 1 ? `+${o.items.length-1} mais` : '';
    const delHtml = o.entregador
      ? `<div class="entregador-cell"><div class="del-dot ${o.entregador.status==='online'?'dd-online':'dd-busy'}"></div><span style="font-size:.78rem;color:var(--text-2)">${escapeHtml(o.entregador.name)}</span></div>`
      : `<span style="font-size:.75rem;color:var(--text-4)">—</span>`;

    tbody.innerHTML += `
      <tr data-id="${o.id}" class="${sel?'selected':''}">
        <td class="col-chk"><input type="checkbox" class="row-chk" ${sel?'checked':''} onchange="toggleRow(${o.id},this)"></td>
        <td>
          <div class="order-id">${o.ref}</div>
          <div class="order-time">${o.minsAgo < 60 ? o.minsAgo+'min atrás' : Math.floor(o.minsAgo/60)+'h atrás'}</div>
        </td>
        <td>
          <div class="client-cell">
            <div class="c-av" style="background:#0899a6;color:white">${escapeHtml(o.client.initials)}</div>
            <div>
              <div class="c-name">${escapeHtml(o.client.name)}</div>
              <div class="c-phone">${escapeHtml(o.client.phone)}</div>
            </div>
          </div>
        </td>
        <td class="meds-cell">
          <div class="med-name">${escapeHtml(firstMed)}</div>
          ${medExtra ? `<div class="med-more">${medExtra}</div>` : ''}
        </td>
        <td><span class="tag ${sm.tag}"><i class="bi ${sm.icon}"></i>${sm.label}</span></td>
        <td>${delHtml}</td>
        <td><span class="price-val">${o.total.toLocaleString('pt-AO')} Kz</span></td>
        <td>
          <div class="row-actions">
            <button class="act-btn" title="Ver detalhe" onclick="openDrawer(${o.id})"><i class="bi bi-eye"></i></button>
            ${['Pendente','Aprovado'].includes(o.status) ? `<button class="act-btn" title="Preparar" onclick="changeStatus(${o.id},'Aprovado')"><i class="bi bi-box-seam"></i></button>` : ''}
            ${o.status === 'pago' ? `<button class="act-btn" title="Enviar" onclick="changeStatus(${o.id},'Em Entrega')"><i class="bi bi-bicycle"></i></button>` : ''}
            ${o.status === 'Em Entrega' ? `<button class="act-btn" title="Concluir" onclick="changeStatus(${o.id},'Concluído')"><i class="bi bi-check-circle"></i></button>` : ''}
            ${!['Concluído','Cancelado','Rejeitado'].includes(o.status) ? `<button class="act-btn d" title="Cancelar" onclick="openCancelModal(${o.id})"><i class="bi bi-x-circle"></i></button>` : ''}
          </div>
        </td>
      </tr>`;
  });

  const end = Math.min(start + rpp, total);
  document.getElementById('pageInfo').textContent = total === 0 ? '0 resultados' : `${start+1}–${end} de ${total}`;
  updateSelectAll();
}

function updateSelectAll() {
  const rpp=getRPP(), start=(currentPage-1)*rpp, slice=filtered.slice(start,start+rpp);
  const allSel = slice.length>0 && slice.every(o=>selected.has(o.id));
  document.getElementById('selAll').checked = allSel;
  document.getElementById('selAll').indeterminate = !allSel && slice.some(o=>selected.has(o.id));
}

function updateBulkBar() {
  const bar = document.getElementById('bulkBar');
  bar.classList.toggle('show', selected.size>0);
  document.getElementById('bulkCount').textContent = selected.size;
}

function clearSel() { selected.clear(); render(); updateBulkBar(); }

function toggleRow(id, cb) {
  if(cb.checked) selected.add(id); else selected.delete(id);
  document.querySelector(`tr[data-id="${id}"]`).classList.toggle('selected', cb.checked);
  updateBulkBar(); updateSelectAll();
}

function toggleAll(cb) {
  const rpp=getRPP(), start=(currentPage-1)*rpp, slice=filtered.slice(start,start+rpp);
  slice.forEach(o=>{ if(cb.checked) selected.add(o.id); else selected.delete(o.id); });
  render(); updateBulkBar();
}

/* ══ FILTER & SORT ══════════════════════════════════ */
function applyFilters() {
  const q = document.getElementById('searchInput').value.trim().toLowerCase();
  
  filtered = allOrders.filter(o => {
    // Criar lista de nomes de medicamentos para pesquisa
    const medNames = o.items.map(it => it.name.toLowerCase());
    const matchSearch = !q || 
      o.ref.toLowerCase().includes(q) || 
      o.client.name.toLowerCase().includes(q) || 
      medNames.some(m => m.includes(q));
      
    if (currentTab === 'all') return matchSearch;
    if (currentTab === 'new') return matchSearch && o.status === 'Pendente';
    if (currentTab === 'prep') return matchSearch && (o.status === 'Aprovado' || o.status === 'pago');
    if (currentTab === 'route') return matchSearch && o.status === 'Em Entrega';
    if (currentTab === 'done') return matchSearch && o.status === 'Concluído';
    if (currentTab === 'canceled') return matchSearch && (o.status === 'Cancelado' || o.status === 'Rejeitado');
    return matchSearch;
  });
  
  // Ordenação básica (por tempo e total)
  if (currentSort.key === 'id') {
    filtered.sort((a,b) => currentSort.dir === 'desc' ? b.id - a.id : a.id - b.id);
  } else if (currentSort.key === 'total') {
    filtered.sort((a,b) => currentSort.dir === 'desc' ? b.total - a.total : a.total - b.total);
  } else if (currentSort.key === 'client') {
    filtered.sort((a,b) => currentSort.dir === 'desc' ? b.client.name.localeCompare(a.client.name) : a.client.name.localeCompare(b.client.name));
  } else if (currentSort.key === 'status') {
    filtered.sort((a,b) => currentSort.dir === 'desc' ? b.status.localeCompare(a.status) : a.status.localeCompare(b.status));
  } else {
    filtered.sort((a,b) => b.id - a.id);
  }
  
  currentPage = 1;
  render();
}

function sortBy(key) {
  if (currentSort.key === key) {
    currentSort.dir = currentSort.dir === 'desc' ? 'asc' : 'desc';
  } else {
    currentSort.key = key;
    currentSort.dir = 'desc';
  }
  // Actualizar ícones das colunas (simples)
  document.querySelectorAll('th').forEach(th => th.classList.remove('sorted'));
  const th = document.querySelector(`th[onclick*="${key}"]`);
  if (th) th.classList.add('sorted');
  applyFilters();
}

function setTab(el, status) {
  document.querySelectorAll('.st-tab').forEach(t=>t.classList.remove('active'));
  el.classList.add('active');
  currentTab = status;
  applyFilters();
}

function filterStatus(status) {
  const tabMap = { 'new': 'new', 'prep': 'prep', 'route': 'route', 'done': 'done' };
  const tab = document.querySelector(`.st-tab[data-status="${tabMap[status] || 'all'}"]`);
  if(tab) setTab(tab, tabMap[status] || 'all');
}

function changePage(p) { currentPage = p; render(); }

/* ══ STATUS CHANGE ══════════════════════════════════ */
function changeStatus(id, newStatus) {
  const o = allOrders.find(x => x.id === id);
  if (o) {
    const oldStatus = o.status;
    o.status = newStatus;
    
    fetch(`/farmacias/pedidos/${id}/status`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      body: JSON.stringify({ status: newStatus })
    }).then(() => {
      applyFilters();
      if (currentDrawerId === id) openDrawer(id);
    }).catch(() => {
      o.status = oldStatus;
      applyFilters();
    });
  }
}

function bulkChangeStatus(newStatus) {
  const ids = Array.from(selected);
  ids.forEach(id => {
    const o = allOrders.find(x => x.id === id);
    if (o) o.status = newStatus;
  });
  
  fetch(`/farmacias/pedidos/bulk-status`, {
    method: 'PUT',
    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
    body: JSON.stringify({ ids: ids, status: newStatus })
  }).then(() => {
    clearSel();
    applyFilters();
  }).catch(() => {
    applyFilters();
  });
}

/* ══ CANCEL ═════════════════════════════════════════ */
function openCancelModal(id) {
  cancelTargetId = id;
  const o = allOrders.find(x=>x.id===id);
  document.getElementById('cancelText').textContent = `Vai cancelar o pedido ${o?.ref} de ${o?.client.name}. O cliente será notificado.`;
  document.getElementById('cancelModal').classList.add('open');
}

function confirmCancel() {
  if(cancelTargetId) changeStatus(cancelTargetId, 'Cancelado');
  document.getElementById('cancelModal').classList.remove('open');
  cancelTargetId = null;
  closeDrawer();
}

document.getElementById('cancelModal').addEventListener('click', function(e){ if(e.target===this) this.classList.remove('open'); });

/* ══ DRAWER ═════════════════════════════════════════ */
let currentDrawerId = null;

function openDrawer(id) {
  currentDrawerId = id;
  const o = allOrders.find(x => x.id === id);
  if (!o) return;
  
  const sm = STATUS_MAP[o.status] || STATUS_MAP['Pendente'];

  document.getElementById('drawerTitle').textContent = `Pedido ${o.ref}`;
  document.getElementById('drawerSubtitle').innerHTML = `
    <span class="tag ${sm.tag}" style="font-size:.68rem">
      <i class="bi ${sm.icon}"></i>${sm.label}
    </span> &nbsp;·&nbsp; 
    ${o.minsAgo < 60 ? o.minsAgo+'min atrás' : Math.floor(o.minsAgo/60)+'h atrás'}`;

  // Timeline
  const statusOrder = ['Pendente', 'Aprovado', 'pago', 'Em Entrega', 'Concluído'];
  const curOrd = statusOrder.indexOf(o.status);
  
  let tlHtml = '';
  statusOrder.forEach((st, i) => {
    if (st === 'pago' || st === 'Aprovado') return; // Pular estados intermédios
    const stepLabel = st === 'Pendente' ? 'Pedido recebido' :
                      st === 'Em Entrega' ? 'Em rota de entrega' :
                      st === 'Concluído' ? 'Entregue ao cliente' : st;
    const cls = (o.status === 'Cancelado' || o.status === 'Rejeitado') ? 'pending' :
                (i < curOrd) ? 'done' : (i === curOrd) ? 'active' : 'pending';
    
    tlHtml += `
      <div class="tl-item ${cls}">
        <div class="tl-dot"></div>
        <div class="tl-label ${cls==='pending'?'pending':''}">${stepLabel}</div>
        ${cls !== 'pending' ? `<div class="tl-time">${o.data ? new Date(o.data).toLocaleTimeString() : ''}</div>` : ''}
      </div>`;
  });
  
  if (o.status === 'Cancelado' || o.status === 'Rejeitado') {
    tlHtml += `
      <div class="tl-item pending">
        <div class="tl-dot" style="background:var(--danger)"></div>
        <div class="tl-label" style="color:var(--danger)">Pedido cancelado</div>
      </div>`;
  }

  // Itens do pedido (detalhados)
  let itemsHtml = '';
  if (o.items && o.items.length > 0) {
    itemsHtml = o.items.map(item => `
        <div class="order-item">
            <div class="oi-ico"><i class="bi bi-capsule"></i></div>
            <div>
                <div class="oi-name">${escapeHtml(item.name)}</div>
                <div class="oi-qty">${item.quantidade} un. × ${item.preco_unitario.toLocaleString('pt-AO')} Kz</div>
            </div>
            <div class="oi-price">${item.subtotal.toLocaleString('pt-AO')} Kz</div>
        </div>
    `).join('');
  } else {
    itemsHtml = '<div class="text-center p-3 text-secondary">Nenhum item encontrado</div>';
  }

  // Secção de receitas médicas
  let prescHtml = '';
  const itensComReceita = (o.items || []).filter(item => item.requer_receita && item.prescricao_path);
  if (itensComReceita.length > 0) {
    prescHtml = `
        <div class="d-section">
            <div class="d-section-title"><i class="bi bi-file-earmark-medical"></i> Receitas médicas</div>
            ${itensComReceita.map(item => `
                <div class="d-row">
                    <span class="d-lbl">${escapeHtml(item.name)}</span>
                    <span class="d-val">
                        <a href="${item.prescricao_path}" target="_blank" class="presc-link">
                            <i class="bi bi-file-pdf"></i> Ver receita
                        </a>
                    </span>
                </div>
            `).join('')}
        </div>
    `;
  }

  // Secção de comprovativo de pagamento (apenas para Multicaixa Express)
  let comprovativoHtml = '';
  if ((o.metodo_pagamento === 'Multicaixa Express' || o.metodo_pagamento === 'express') && o.comprovativo_path) {
    comprovativoHtml = `
        <div class="d-section">
            <div class="d-section-title"><i class="bi bi-receipt"></i> Comprovativo de pagamento</div>
            <div class="d-row">
                <span class="d-lbl">Método</span>
                <span class="d-val">${escapeHtml(o.metodo_pagamento)}</span>
            </div>
            <div class="d-row">
                <span class="d-lbl">Comprovativo</span>
                <span class="d-val">
                    <a href="${o.comprovativo_path}" target="_blank" class="presc-link">
                        <i class="bi bi-file-earmark-text"></i> Abrir comprovativo
                    </a>
                </span>
            </div>
        </div>
    `;
  }

  document.getElementById('drawerBody').innerHTML = `
    <div class="d-section">
      <div class="d-section-title">Progresso</div>
      <div class="timeline" style="margin-top:6px">${tlHtml}</div>
    </div>

    <div class="d-section">
      <div class="d-section-title">Itens do pedido</div>
      ${itemsHtml}
      <div style="display:flex;justify-content:space-between;padding:10px 10px 0;font-size:.8rem">
        <span style="color:var(--text-3)">Total</span>
        <span style="font-family:'Sora',sans-serif;font-weight:700;color:var(--text)">${o.total.toLocaleString('pt-AO')} Kz</span>
      </div>
    </div>

    ${prescHtml}
    ${comprovativoHtml}

    <div class="d-section">
      <div class="d-section-title">Cliente & Entrega</div>
      <div class="d-row"><span class="d-lbl">Cliente</span><span class="d-val">${escapeHtml(o.client.name)}</span></div>
      <div class="d-row"><span class="d-lbl">Contacto</span><span class="d-val">${escapeHtml(o.client.phone)}</span></div>
      <div class="d-row"><span class="d-lbl">Morada</span><span class="d-val">${escapeHtml(o.morada)}</span></div>
      <div class="d-row"><span class="d-lbl">Entregador</span><span class="d-val">${o.entregador ? escapeHtml(o.entregador.name) : '—'}</span></div>
      <div class="d-row"><span class="d-lbl">Pagamento</span><span class="d-val">${escapeHtml(o.metodo_pagamento)}</span></div>
    </div>`;

  // Botões de ação no drawer
  let btns = '';
  if (o.status === 'Pendente') btns += `<button class="sa-btn sa-prep" onclick="changeStatus(${o.id},'Aprovado')"><i class="bi bi-box-seam"></i> Aprovar</button>`;
  if (o.status === 'Aprovado') btns += `<button class="sa-btn sa-route" onclick="changeStatus(${o.id},'pago')"><i class="bi bi-credit-card"></i> Confirmar pagamento</button>`;
  if (o.status === 'pago') btns += `<button class="sa-btn sa-route" onclick="changeStatus(${o.id},'Em Entrega')"><i class="bi bi-bicycle"></i> Iniciar entrega</button>`;
  if (o.status === 'Em Entrega') btns += `<button class="sa-btn sa-done" onclick="changeStatus(${o.id},'Concluído')"><i class="bi bi-check-circle"></i> Concluir</button>`;
  if (!['Concluído','Cancelado','Rejeitado'].includes(o.status)) {
    btns += `<button class="sa-btn sa-cancel" onclick="openCancelModal(${o.id})"><i class="bi bi-x-circle"></i> Cancelar</button>`;
  }
  document.getElementById('drawerStatusBtns').innerHTML = btns;

  document.getElementById('drawerOverlay').classList.add('open');
  document.getElementById('drawer').classList.add('open');
}

function closeDrawer() {
  document.getElementById('drawerOverlay').classList.remove('open');
  document.getElementById('drawer').classList.remove('open');
  currentDrawerId = null;
}

/* ══ SIDEBAR ═════════════════════════════════════════ */
function setActive(el) { 
  document.querySelectorAll('.nav-item.active').forEach(i => i.classList.remove('active')); 
  el.classList.add('active'); 
}

function toggleSub(id) { 
  document.getElementById(id).classList.toggle('open'); 
}

/* ══ INIT ════════════════════════════════════════════ */
applyFilters();
</script> --}}
</body>
</html>