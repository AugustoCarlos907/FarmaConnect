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
    .has-sub .sub { display: none; padding-left: 20px; margin: 2px 0; }
    .has-sub.open .sub { display: block; }
    .sub-item { display: flex; align-items: center; gap: 7px; padding: 5px 8px; border-radius: var(--r-sm); font-size: 0.77rem; font-weight: 500; color: var(--text-3); cursor: pointer; transition: all .1s; text-decoration: none; }
    .sub-item i { font-size: 0.77rem; width: 13px; }
    .sub-item:hover { background: var(--surface-2); color: var(--accent); }
    .chevron { margin-left: auto; font-size: 0.68rem; transition: transform .2s; }
    .has-sub.open .chevron { transform: rotate(180deg); }
    .sidebar-footer { flex-shrink: 0; padding: 8px; border-top: 1px solid var(--border); }
    .ph-card { padding: 10px 11px; background: var(--accent-light); border-radius: var(--r-lg); }
    .ph-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 5px; }
    .ph-name { font-size: 0.78rem; font-weight: 700; color: var(--accent-2); }
    .ph-pill { font-size: 0.62rem; font-weight: 700; padding: 2px 6px; border-radius: 20px; }
    .pill-open { background: #dcfce7; color: #15803d; }
    .ph-meta { font-size: 0.7rem; color: var(--accent-2); opacity: .8; display: flex; align-items: center; gap: 4px; margin-bottom: 2px; }
    .logout-form { margin-top: 12px; }
    .logout-btn { color: var(--danger); }
    .logout-btn i { color: var(--danger); }
    .logout-btn:hover { background: var(--danger-light); color: var(--danger); }
    .logout-btn:hover i { color: var(--danger); }

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
    .kpi-ico.red   { background: var(--danger-light);  color: var(--danger); }
    .kpi-ico.amber { background: var(--warning-light); color: var(--warning); }
    .kpi-ico.teal  { background: var(--accent-light);  color: var(--accent); }
    .kpi-ico.green { background: var(--success-light); color: var(--success); }
    .kpi-ico.slate { background: #f1f5f9; color: var(--text-3); }
    .kpi-val  { font-family: 'Sora', sans-serif; font-size: 1.5rem; font-weight: 700; line-height: 1; }
    .kpi-lbl  { font-size: 0.7rem; font-weight: 500; color: var(--text-3); margin-top: 2px; }
    .kpi-chip { font-size: 0.62rem; font-weight: 700; padding: 1px 6px; border-radius: 20px; }
    .kc-red   { background: var(--danger-light);  color: var(--danger); }
    .kc-amber { background: var(--warning-light); color: var(--warning); }
    .kc-teal  { background: var(--accent-light);  color: var(--accent-2); }
    .kc-green { background: var(--success-light); color: var(--success); }
    .kc-slate { background: #f1f5f9; color: var(--text-3); }

    /* ─── TOOLBAR ─────────────────────────── */
    .toolbar { display: flex; align-items: center; gap: 8px; margin-bottom: 12px; flex-wrap: wrap; }
    .toolbar-left  { display: flex; align-items: center; gap: 7px; flex: 1; min-width: 0; flex-wrap: wrap; }
    .toolbar-right { display: flex; align-items: center; gap: 7px; flex-shrink: 0; }
    .search-wrap { position: relative; min-width: 200px; max-width: 300px; flex: 1; }
    .search-wrap i { position: absolute; left: 9px; top: 50%; transform: translateY(-50%); color: var(--text-4); font-size: 0.82rem; pointer-events: none; }
    .search-input { width: 100%; padding: 5px 10px 5px 30px; border: 1px solid var(--border); border-radius: var(--r-md); font-size: 0.78rem; font-family: 'DM Sans', sans-serif; background: var(--surface); color: var(--text); transition: border-color .1s; }
    .search-input:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 2px rgba(8,153,166,.12); }
    .search-input::placeholder { color: var(--text-4); }
    .status-tabs { display: flex; background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-md); overflow: hidden; }
    .st-tab { padding: 5px 12px; font-size: 0.75rem; font-weight: 600; color: var(--text-3); cursor: pointer; border: none; background: none; transition: all .1s; white-space: nowrap; font-family: 'DM Sans', sans-serif; display: flex; align-items: center; gap: 5px; border-right: 1px solid var(--border); }
    .st-tab:last-child { border-right: none; }
    .st-tab:hover { background: var(--surface-2); color: var(--text); }
    .st-tab.active { background: var(--accent-light); color: var(--accent); }
    .st-tab .tab-count { font-size: 0.62rem; font-weight: 700; padding: 1px 5px; border-radius: 20px; background: var(--border); color: var(--text-3); }
    .st-tab.active .tab-count { background: var(--accent); color: #fff; }
    .btn { display: inline-flex; align-items: center; gap: 5px; padding: 5px 12px; border-radius: var(--r-md); font-size: 0.78rem; font-weight: 600; cursor: pointer; transition: all .1s; border: 1px solid; font-family: 'DM Sans', sans-serif; white-space: nowrap; }
    .btn-outline { background: var(--surface); color: var(--text-2); border-color: var(--border); }
    .btn-outline:hover { background: var(--surface-2); border-color: var(--border-strong); }
    .btn-icon { padding: 5px 8px; }

    /* ─── BULK BAR ────────────────────────── */
    .bulk-bar { display: none; align-items: center; gap: 10px; padding: 9px 14px; margin-bottom: 10px; background: var(--accent); border-radius: var(--r-xl); color: #fff; font-size: 0.78rem; font-weight: 500; }
    .bulk-bar.show { display: flex; }
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
    th { padding: 9px 12px; text-align: left; font-size: 0.66rem; font-weight: 600; color: var(--text-3); text-transform: uppercase; letter-spacing: .05em; border-bottom: 1px solid var(--border); white-space: nowrap; }
    th:first-child { padding-left: 16px; } th:last-child { padding-right: 16px; }
    th.ns { cursor: default; }
    tbody tr { border-bottom: 1px solid var(--border); transition: background .07s; cursor: pointer; }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: var(--surface-2); }
    tbody tr.selected { background: var(--accent-light); }
    td { padding: 10px 12px; vertical-align: middle; color: var(--text-2); }
    td:first-child { padding-left: 16px; } td:last-child { padding-right: 16px; }
    .col-chk { width: 36px; }
    .row-chk { width: 14px; height: 14px; accent-color: var(--accent); cursor: pointer; }
    .order-id   { font-family: 'Sora', sans-serif; font-size: 0.78rem; font-weight: 700; color: var(--accent-2); }
    .order-time { font-size: 0.67rem; color: var(--text-4); margin-top: 1px; }
    .client-cell { display: flex; align-items: center; gap: 9px; }
    .c-av   { width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.65rem; font-weight: 700; flex-shrink: 0; }
    .c-name { font-weight: 600; color: var(--text); margin-bottom: 1px; }
    .c-phone { font-size: 0.67rem; color: var(--text-4); }
    .meds-cell { max-width: 220px; }
    .med-name { color: var(--text-2); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .med-more { font-size: 0.67rem; color: var(--text-4); margin-top: 1px; }
    .tag { display: inline-flex; align-items: center; font-size: 0.65rem; font-weight: 600; padding: 2px 7px; border-radius: 20px; white-space: nowrap; gap: 4px; }
    .tag i { font-size: 0.62rem; }
    .t-new      { background: var(--danger-light);  color: var(--danger); }
    .t-prep     { background: var(--warning-light); color: #854f0b; }
    .t-route    { background: var(--accent-light);  color: var(--accent-2); }
    .t-done     { background: var(--success-light); color: var(--success); }
    .t-canceled { background: #f1f5f9; color: var(--text-3); }
    .entregador-cell { display: flex; align-items: center; gap: 6px; }
    .price-val { font-family: 'Sora', sans-serif; font-weight: 600; font-size: 0.82rem; color: var(--text); }

    /* Workflow buttons */
    .workflow-actions { display: flex; gap: 8px; flex-wrap: wrap; }
    .workflow-btn { display: inline-flex; align-items: center; gap: 6px; padding: 5px 10px; border: 1px solid var(--border); border-radius: 30px; font-size: 0.73rem; font-weight: 600; font-family: 'DM Sans', sans-serif; cursor: pointer; transition: all 0.15s; background: var(--surface-2); color: var(--text-2); }
    .workflow-btn.approve { background: #e6f7e6; color: #2b7a2b; border-color: #b3e6b3; }
    .workflow-btn.approve:hover { background: #c8e6c8; }
    .workflow-btn.reject  { background: #ffe6e6; color: #b33; border-color: #ffcccc; }
    .workflow-btn.reject:hover  { background: #ffcccc; }
    .workflow-btn.paid    { background: #e6f2ff; color: #0066cc; border-color: #b3d1ff; }
    .workflow-btn.paid:hover    { background: #cce0ff; }

    /* ─── TABLE FOOTER ────────────────────── */
    .table-footer { display: flex; align-items: center; justify-content: space-between; padding: 9px 16px; border-top: 1px solid var(--border); background: var(--surface-2); font-size: 0.75rem; color: var(--text-3); flex-shrink: 0; flex-wrap: wrap; gap: 7px; }
    .tf-info { display: flex; align-items: center; gap: 9px; }
    .pagination { display: flex; align-items: center; gap: 3px; }
    .pg-btn { min-width: 27px; height: 27px; padding: 0 5px; border-radius: var(--r-sm); border: 1px solid var(--border); background: var(--surface); font-size: 0.75rem; color: var(--text-3); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all .1s; font-family: 'DM Sans', sans-serif; }
    .pg-btn:hover:not(:disabled) { border-color: var(--accent-mid); color: var(--accent); background: var(--accent-light); }
    .pg-btn.active { background: var(--accent); border-color: var(--accent); color: #fff; font-weight: 600; }
    .pg-btn:disabled { opacity: .35; cursor: default; }

    /* ─── EMPTY STATE ─────────────────────── */
    .empty-state { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 48px 20px; color: var(--text-4); }
    .empty-ico  { width: 50px; height: 50px; border-radius: var(--r-xl); background: var(--surface-2); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 10px; }
    .empty-state h3 { font-size: 0.88rem; font-weight: 600; color: var(--text-3); margin-bottom: 4px; }
    .empty-state p  { font-size: 0.77rem; text-align: center; max-width: 240px; }

    /* ─── DRAWER ──────────────────────────── */
    .drawer-overlay { display: none; position: fixed; inset: 0; background: rgba(15,23,42,.35); z-index: 400; backdrop-filter: blur(1px); }
    .drawer-overlay.open { display: block; }
    .drawer { position: fixed; top: 0; right: -500px; width: 500px; max-width: 96vw; height: 100vh; background: var(--surface); border-left: 1px solid var(--border); display: flex; flex-direction: column; transition: right .25s cubic-bezier(.4,0,.2,1); z-index: 500; box-shadow: -8px 0 32px rgba(0,0,0,.1); }
    .drawer.open { right: 0; }
    .drawer-head { padding: 16px 20px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; flex-shrink: 0; }
    .drawer-head-left { display: flex; flex-direction: column; gap: 4px; }
    .drawer-head-left h2 { font-family: 'Sora', sans-serif; font-size: 0.92rem; font-weight: 600; }
    .drawer-close { background: none; border: none; cursor: pointer; color: var(--text-3); font-size: 1rem; width: 28px; height: 28px; border-radius: var(--r-sm); display: flex; align-items: center; justify-content: center; transition: all .1s; }
    .drawer-close:hover { background: var(--surface-2); color: var(--text); }
    .drawer-body { flex: 1; overflow-y: auto; padding: 18px 20px; }

    /* Sections */
    .d-section { margin-bottom: 18px; }
    .d-section-title { font-size: 0.7rem; font-weight: 600; color: var(--text-3); text-transform: uppercase; letter-spacing: .06em; margin-bottom: 10px; padding-bottom: 6px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 5px; }
    .d-section-title i { color: var(--accent); }
    .d-row { display: flex; align-items: flex-start; gap: 8px; padding: 7px 0; border-bottom: 1px solid var(--border); font-size: 0.8rem; }
    .d-row:last-child { border-bottom: none; }
    .d-lbl { font-size: 0.72rem; color: var(--text-3); width: 130px; flex-shrink: 0; padding-top: 1px; }
    .d-val { flex: 1; color: var(--text-2); font-weight: 500; word-break: break-word; }

    /* Item rows */
    .di-row { display: flex; align-items: flex-start; gap: 10px; padding: 9px 10px; background: var(--surface-2); border: 1px solid var(--border); border-radius: var(--r-md); margin-bottom: 6px; }
    .di-ico  { width: 32px; height: 32px; border-radius: var(--r-sm); background: var(--accent-light); color: var(--accent-2); display: flex; align-items: center; justify-content: center; font-size: 0.85rem; flex-shrink: 0; margin-top: 1px; }
    .di-name { font-weight: 600; font-size: 0.8rem; color: var(--text); line-height: 1.3; }
    .di-meta { font-size: 0.7rem; color: var(--text-3); margin-top: 3px; }
    .di-price { margin-left: auto; font-family: 'Sora', sans-serif; font-weight: 700; font-size: 0.82rem; color: var(--text); flex-shrink: 0; padding-left: 8px; }

    /* Doc link */
    .doc-link { display: inline-flex; align-items: center; gap: 4px; font-size: 0.73rem; font-weight: 600; color: var(--accent-2); text-decoration: none; padding: 2px 8px; background: var(--accent-light); border-radius: var(--r-sm); margin-top: 4px; }
    .doc-link:hover { background: var(--accent-mid); }

    /* ─── MODAL ───────────────────────────── */
    .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(15,23,42,.48); z-index: 600; align-items: center; justify-content: center; backdrop-filter: blur(2px); }
    .modal-overlay.open { display: flex; }
    .modal-box { background: var(--surface); border-radius: var(--r-xl); padding: 22px; width: 380px; max-width: 94vw; box-shadow: 0 20px 50px rgba(0,0,0,.18); animation: mIn .18s ease; }
    @keyframes mIn { from { transform:scale(.96); opacity:0; } to { transform:scale(1); opacity:1; } }
    .modal-ico { width: 38px; height: 38px; border-radius: var(--r-lg); display: flex; align-items: center; justify-content: center; font-size: 1rem; margin-bottom: 11px; }
    .modal-ico.warning { background: var(--warning-light); color: var(--warning); }
    .modal-box h3 { font-family: 'Sora', sans-serif; font-size: 0.93rem; font-weight: 600; margin-bottom: 5px; }
    .modal-box p  { font-size: 0.78rem; color: var(--text-3); line-height: 1.5; margin-bottom: 16px; }
    .modal-foot { display: flex; gap: 7px; justify-content: flex-end; }
    .btn-danger-solid { background: var(--danger); color: #fff; border-color: var(--danger); }

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
        <a href="{{ route('index.farmacias') }}" class="nav-item {{ request()->routeIs('index.farmacias') ? 'active' : '' }}">
          <i class="bi bi-grid-1x2"></i><span>Dashboard</span>
        </a>
        <div class="has-sub {{ request()->routeIs('medicamentos.farmacias') ? 'open' : '' }}" id="sub-stock">
          <div class="nav-item" onclick="toggleSub('sub-stock')">
            <i class="bi bi-archive"></i><span>Stock</span><i class="bi bi-chevron-down chevron"></i>
          </div>
          <div class="sub">
            <a href="{{ route('medicamentos.farmacias') }}" class="sub-item"><i class="bi bi-list-ul"></i><span>Lista de produtos</span></a>
            {{-- <div class="sub-item"><i class="bi bi-exclamation-triangle"></i><span>Stock baixo</span></div> --}}
          </div>
        </div>
        <a href="{{ route('pedidos.farmacias') }}" class="nav-item {{ request()->routeIs('pedidos.farmacias') ? 'active' : '' }}">
          <i class="bi bi-truck"></i><span>Pedidos</span>
        </a>
        <a href="{{ route('entregadores.farmacias') }}" class="nav-item {{ request()->routeIs('entregadores.farmacias') ? 'active' : '' }}">
          <i class="bi bi-person-badge"></i><span>Entregadores</span>
        </a>
        <a href="{{ route('clientes.farmacias') }}" class="nav-item {{ request()->routeIs('clientes.farmacias') ? 'active' : '' }}">
          <i class="bi bi-people"></i><span>Clientes</span>
        </a>
        <a href="{{ route('avaliacoes.farmacias') }}" class="nav-item {{ request()->routeIs('avaliacoes.farmacias') ? 'active' : '' }}">
          <i class="bi bi-star"></i><span>Avaliações</span>
        </a>
        <span class="nav-label">Gestão</span>
        <a href="{{ route('documentos.farmacias') }}" class="nav-item {{ request()->routeIs('documentos.farmacias') ? 'active' : '' }}">
          <i class="bi bi-file-earmark-text"></i><span>Documentos</span>
        </a>
        <div class="has-sub" id="sub-cfg">
          <div class="nav-item" onclick="toggleSub('sub-cfg')">
            <i class="bi bi-gear"></i><span>Configurações</span><i class="bi bi-chevron-down chevron"></i>
          </div>
          <div class="sub">
            <div class="sub-item"><i class="bi bi-person"></i><span>Perfil</span></div>
            <div class="sub-item"><i class="bi bi-shop"></i><span>Farmácia</span></div>
            <div class="sub-item"><i class="bi bi-clock"></i><span>Horário</span></div>
          </div>
        </div>
        <form action="{{ route('logout', ['id'=>Auth::user()->id]) }}" method="post" class="logout-form">
          @csrf
          <button type="submit" class="nav-item logout-btn">
            <i class="bi bi-box-arrow-right"></i><span>Sair</span>
          </button>
        </form>
      </div>
    </div>
    <div class="sidebar-footer">
      @php $farmacia = Auth::user()->farmacia; @endphp
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
          <div>
            <span class="u-name">{{ Auth::user()->farmacia->name ?? 'FC' }}</span>
            <span class="u-role">{{ Auth::user()->name ?? 'Farmacêutico' }}</span>
          </div>
        </div>
      </div>
    </header>

    <div class="content">

      @php
        $col        = $pedidos->getCollection();
        $pendentes  = $col->where('status','Pendente')->count();
        $aprovados  = $col->where('status','Aprovado')->count();
        $pagos      = $col->where('status','pago')->count();
        $emEntrega  = $col->where('status','Em Entrega')->count();
        $concluidos = $col->where('status','Concluído')->count();
        $cancelados = $col->where('status','Cancelado')->count();
        $rejeitados = $col->where('status','Rejeitado')->count();
        $totalHoje  = $pedidosHoje->count();
        $faturacaoHoje = $col->where('status','Concluído')->sum('total');
      @endphp

      <!-- KPIs -->
      <div class="kpi-row">
        <div class="kpi k-new">
          <div class="kpi-head"><div class="kpi-ico red"><i class="bi bi-bell"></i></div><span class="kpi-chip kc-red">{{ $pendentes }}</span></div>
          <div class="kpi-val">{{ $pendentes }}</div><div class="kpi-lbl">Pendentes</div>
        </div>
        <div class="kpi k-prep">
          <div class="kpi-head"><div class="kpi-ico amber"><i class="bi bi-box-seam"></i></div><span class="kpi-chip kc-amber">{{ $aprovados + $pagos }}</span></div>
          <div class="kpi-val">{{ $aprovados + $pagos }}</div><div class="kpi-lbl">Em preparação</div>
        </div>
        <div class="kpi k-route">
          <div class="kpi-head"><div class="kpi-ico teal"><i class="bi bi-bicycle"></i></div><span class="kpi-chip kc-teal">{{ $emEntrega }}</span></div>
          <div class="kpi-val">{{ $emEntrega }}</div><div class="kpi-lbl">Em rota</div>
        </div>
        <div class="kpi k-done">
          <div class="kpi-head"><div class="kpi-ico green"><i class="bi bi-check-circle"></i></div><span class="kpi-chip kc-green">{{ $totalHoje }}</span></div>
          <div class="kpi-val">{{ $totalHoje }}</div><div class="kpi-lbl">Entregues hoje</div>
        </div>
        <div class="kpi k-canceled">
          <div class="kpi-head"><div class="kpi-ico slate"><i class="bi bi-currency-exchange"></i></div><span class="kpi-chip kc-slate"></span></div>
          <div class="kpi-val">{{ number_format($faturacaoHoje, 0, ',', '.') }} Kz</div><div class="kpi-lbl">Faturação</div>
        </div>
      </div>

      <!-- Toolbar -->
      <div class="toolbar">
        <div class="toolbar-left">
          <div class="search-wrap">
            <i class="bi bi-search"></i>
            <input type="text" class="search-input" id="searchInput"
                   placeholder="Pesquisar por ID, cliente, medicamento…"
                   oninput="applyFilters()">
          </div>
          <div class="status-tabs">
            <button class="st-tab active" data-status="all"      onclick="setTab(this,'all')">
              Todos <span class="tab-count">{{ $pedidos->total() }}</span>
            </button>
            <button class="st-tab" data-status="new"      onclick="setTab(this,'new')">
              <i class="bi bi-bell" style="font-size:.7rem"></i> Pendentes
              <span class="tab-count">{{ $pendentes }}</span>
            </button>
            <button class="st-tab" data-status="prep"     onclick="setTab(this,'prep')">
              <i class="bi bi-box-seam" style="font-size:.7rem"></i> Em preparação
              <span class="tab-count">{{ $aprovados + $pagos }}</span>
            </button>
            <button class="st-tab" data-status="route"    onclick="setTab(this,'route')">
              <i class="bi bi-bicycle" style="font-size:.7rem"></i> Em rota
              <span class="tab-count">{{ $emEntrega }}</span>
            </button>
            <button class="st-tab" data-status="done"     onclick="setTab(this,'done')">
              <i class="bi bi-check-circle" style="font-size:.7rem"></i> Concluídos
              <span class="tab-count">{{ $concluidos }}</span>
            </button>
            <button class="st-tab" data-status="canceled" onclick="setTab(this,'canceled')">
              Cancelados <span class="tab-count">{{ $cancelados + $rejeitados }}</span>
            </button>
          </div>
        </div>
        <div class="toolbar-right">
          <form action="{{ route('farmacias.report') }}" method="post">
            @csrf
            <input type="hidden" name="data_inicio" value="{{ now()->startOfMonth()->toDateString() }}">
            <input type="hidden" name="data_fim"    value="{{ now()->toDateString() }}">
            <input type="hidden" name="tipo_relatorio" value="pdf">
            <button class="btn btn-outline btn-icon" type="submit"
                    style="background:#0899a6;color:#fff">
              <i class="bi bi-download"></i> Imprimir Relatório
            </button>
          </form>
        </div>
      </div>

      <!-- Bulk bar -->
      <div class="bulk-bar" id="bulkBar">
        <i class="bi bi-check2-square"></i>
        <span class="bulk-count" id="bulkCount">0</span>
        <span>pedidos selecionados</span>
        <div class="bulk-sp"></div>
        <button class="bulk-btn bd" onclick="bulkCancelOpen()"><i class="bi bi-x-circle"></i> Cancelar</button>
        <button class="bulk-close" onclick="clearSel()"><i class="bi bi-x-lg"></i></button>
      </div>

      <!-- Table -->
      <div class="table-wrap">
        <div class="table-scroll">
          <table>
            <thead>
              <tr>
                <th class="col-chk ns"><input type="checkbox" class="row-chk" id="selAll" onchange="toggleAll(this)"></th>
                <th class="ns">Pedido</th>
                <th class="ns">Cliente</th>
                <th class="ns">Medicamentos</th>
                <th class="ns">Estado</th>
                <th class="ns">Entregador</th>
                <th class="ns">Total</th>
                <th class="ns">Acções</th>
              </tr>
            </thead>
            <tbody>
              @forelse($pedidos as $pedido)
                @php
                  $cliente      = $pedido->user;
                  $items        = $pedido->items;
                  $total        = $pedido->total ?? $items->sum(fn($i) => $i->preco_unitario * $i->quantidade);
                  $primeiroItem = $items->first();
                  $restantes    = $items->count() - 1;
                  $medNome      = $primeiroItem?->stockItem?->medicamento?->name ?? '—';
                  $statusMap = [
                    'Pendente'   => ['tag'=>'t-new',      'icon'=>'bi-bell',         'label'=>'Pendente'],
                    'Aprovado'   => ['tag'=>'t-prep',     'icon'=>'bi-box-seam',     'label'=>'Aprovado'],
                    'pago'       => ['tag'=>'t-prep',     'icon'=>'bi-credit-card',  'label'=>'Pago'],
                    'Em Entrega' => ['tag'=>'t-route',    'icon'=>'bi-bicycle',      'label'=>'Em Entrega'],
                    'Concluído'  => ['tag'=>'t-done',     'icon'=>'bi-check-circle', 'label'=>'Concluído'],
                    'Cancelado'  => ['tag'=>'t-canceled', 'icon'=>'bi-x-circle',     'label'=>'Cancelado'],
                    'Rejeitado'  => ['tag'=>'t-canceled', 'icon'=>'bi-x-circle',     'label'=>'Rejeitado'],
                  ];
                  $st      = $statusMap[$pedido->status] ?? $statusMap['Pendente'];
                  $corCli  = $cliente ? '#'.substr(md5($cliente->name ?? $cliente->id), 0, 6) : '#888';
                  $iniciais = $cliente
                    ? strtoupper(implode('', array_map(fn($n) => $n[0] ?? '', explode(' ', $cliente->name))))
                    : '--';
                @endphp

                {{-- Clique na linha abre o drawer; botões e forms têm stopPropagation --}}
                <tr data-id="{{ $pedido->id }}"
                    data-status="{{ $pedido->status }}"
                    onclick="openDrawer({{ $pedido->id }}, event)">

                  <td class="col-chk">
                    <input type="checkbox" class="row-chk"
                           onclick="event.stopPropagation()"
                           onchange="toggleRow({{ $pedido->id }}, this)">
                  </td>
                  <td>
                    <div class="order-id">#{{ str_pad($pedido->id,4,'0',STR_PAD_LEFT) }}</div>
                    <div class="order-time">
                      {{ $pedido->data_pedido->format('d-m-y · H:i') }} · {{ $pedido->data_pedido->diffForHumans() }}
                    </div>
                  </td>
                  <td>
                    <div class="client-cell">
                      <div class="c-av" style="background:{{ $corCli }};color:#fff">{{ $iniciais }}</div>
                      <div>
                        <div class="c-name">{{ $cliente->name ?? 'Cliente' }}</div>
                        <div class="c-phone">{{ $cliente->phone ?? '—' }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="meds-cell">
                    <div class="med-name">{{ $medNome }}</div>
                    @if($restantes > 0)
                      <div class="med-more">+{{ $restantes }} mais</div>
                    @endif
                  </td>
                  <td>
                    <span class="tag {{ $st['tag'] }}">
                      <i class="bi {{ $st['icon'] }}"></i>{{ $st['label'] }}
                    </span>
                  </td>
                  <td>
                    @if($pedido->entrega?->entregador)
                      <div class="entregador-cell">
                        <strong style="font-size:.78rem;color:var(--text-2)">
                          {{ $pedido->entrega->entregador->name }}
                        </strong>
                      </div>
                    @else
                      <span style="font-size:.75rem;color:var(--text-4)">—</span>
                    @endif
                  </td>
                  <td>
                    <span class="price-val">{{ number_format($total,0,',','.') }} Kz</span>
                  </td>
                  <td onclick="event.stopPropagation()">
                    <div class="workflow-actions">
                      @if($pedido->status === 'Pendente')
                        <form action="{{ route('pedidos.status.update', $pedido->id) }}" method="POST" style="display:inline">
                          @csrf @method('PUT')
                          <input type="hidden" name="status" value="Aprovado">
                          <button type="submit" class="workflow-btn approve">
                            <i class="bi bi-check-circle"></i> Aprovar
                          </button>
                        </form>
                      @endif
                      @if($pedido->status !== 'Rejeitado' && $pedido->status !== 'Concluído' && $pedido->status !== 'Cancelado')
                        <form action="{{ route('pedidos.status.update', $pedido->id) }}" method="POST" style="display:inline">
                          @csrf @method('PUT')
                          <input type="hidden" name="status" value="Rejeitado">
                          <button type="submit" class="workflow-btn reject">
                            <i class="bi bi-x-circle"></i> Rejeitar
                          </button>
                        </form>
                      @endif
                      @if($pedido->status === 'Aprovado')
                        <form action="{{ route('pedidos.status.update', $pedido->id) }}" method="POST" style="display:inline">
                          @csrf @method('PUT')
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
                  <td colspan="8" style="text-align:center;padding:32px;color:var(--text-4)">
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
            <span>
              {{ $pedidos->firstItem() ?? 0 }}–{{ $pedidos->lastItem() ?? 0 }}
              de {{ $pedidos->total() }} pedidos
            </span>
          </div>
          <div class="pagination">
            {{ $pedidos->links() }}
          </div>
        </div>
      </div>

    </div>{{-- /content --}}
  </div>{{-- /main --}}

</div>{{-- /layout --}}

{{-- ═══════════════════════════════════════════════════════
     OVERLAY + DRAWERS — um por pedido, 100% Blade.
     JS só faz classList.add/remove('open').
═══════════════════════════════════════════════════════ --}}
<div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>

@foreach($pedidos as $pedido)
  @php
    $dCliente    = $pedido->user;
    $dItems      = $pedido->items;
    $dTotal      = $pedido->total ?? $dItems->sum(fn($i) => $i->preco_unitario * $i->quantidade);
    $dEntrega    = $pedido->entrega;
    $dEntregador = $dEntrega?->entregador;
    $statusMap   = [
      'Pendente'   => ['tag'=>'t-new',      'icon'=>'bi-bell',         'label'=>'Pendente'],
      'Aprovado'   => ['tag'=>'t-prep',     'icon'=>'bi-box-seam',     'label'=>'Aprovado'],
      'pago'       => ['tag'=>'t-prep',     'icon'=>'bi-credit-card',  'label'=>'Pago'],
      'Em Entrega' => ['tag'=>'t-route',    'icon'=>'bi-bicycle',      'label'=>'Em Entrega'],
      'Concluído'  => ['tag'=>'t-done',     'icon'=>'bi-check-circle', 'label'=>'Concluído'],
      'Cancelado'  => ['tag'=>'t-canceled', 'icon'=>'bi-x-circle',     'label'=>'Cancelado'],
      'Rejeitado'  => ['tag'=>'t-canceled', 'icon'=>'bi-x-circle',     'label'=>'Rejeitado'],
    ];
    $dSt         = $statusMap[$pedido->status] ?? $statusMap['Pendente'];
    $isExpress   = in_array($pedido->metodo_pagamento, ['express','Multicaixa Express']);
    $comprovativo = $pedido->comprovativo_express;
    $prescricao = $pedido->prescricao_path
  @endphp

  <div class="drawer" id="drawer-{{ $pedido->id }}">

    <div class="drawer-head">
      <div class="drawer-head-left">
        <h2>Pedido #{{ str_pad($pedido->id, 4, '0', STR_PAD_LEFT) }}</h2>
        <span>
          <span class="tag {{ $dSt['tag'] }}" style="font-size:.65rem">
            <i class="bi {{ $dSt['icon'] }}"></i>{{ $dSt['label'] }}
          </span>
          &nbsp;·&nbsp;
          <span style="font-size:.72rem;color:var(--text-4)">
            {{ $pedido->data_pedido->format('d/m/Y H:i') }}
          </span>
        </span>
      </div>
      <button class="drawer-close" onclick="closeDrawer()">
        <i class="bi bi-x-lg"></i>
      </button>
    </div>

    <div class="drawer-body">

      {{-- ─── Detalhes gerais ─── --}}
      <div class="d-section">
        <div class="d-section-title"><i class="bi bi-info-circle"></i> Detalhes do pedido</div>

        <div class="d-row">
          <span class="d-lbl">Cliente</span>
          <span class="d-val">{{ $dCliente->name ?? '—' }}</span>
        </div>
        <div class="d-row">
          <span class="d-lbl">Contacto</span>
          <span class="d-val">{{ $dCliente->phone ?? '—' }}</span>
        </div>
        <div class="d-row">
          <span class="d-lbl">Endereço</span>
          <span class="d-val">{{ $pedido->endereco ?? '—' }}</span>
        </div>
        <div class="d-row">
          <span class="d-lbl">Data</span>
          <span class="d-val">{{ $pedido->data_pedido->format('d/m/Y \à\s H:i') }}</span>
        </div>
        <div class="d-row">
          <span class="d-lbl">Pagamento</span>
          <span class="d-val">{{ $pedido->metodo_pagamento ?? '—' }}</span>
        </div>
        <div class="d-row">
          <span class="d-lbl">Total</span>
          <span class="d-val">
            <strong style="font-family:'Sora',sans-serif;color:var(--accent-2)">
              {{ number_format($dTotal, 0, ',', '.') }} Kz
            </strong>
          </span>
        </div>

        @if($dEntregador)
          <div class="d-row">
            <span class="d-lbl">Entregador</span>
            <span class="d-val">{{ $dEntregador->name }}</span>
          </div>
        @endif

        @if($dEntrega)
          @if($dEntrega->taxa_entrega)
            <div class="d-row">
              <span class="d-lbl">Taxa de entrega</span>
              <span class="d-val">{{ number_format($dEntrega->taxa_entrega, 0, ',', '.') }} Kz</span>
            </div>
          @endif
          @if($dEntrega->distancia_km)
            <div class="d-row">
              <span class="d-lbl">Distância</span>
              <span class="d-val">{{ number_format($dEntrega->distancia_km, 1, ',', '.') }} km</span>
            </div>
          @endif
        @endif
      </div>

      {{-- ─── Comprovativo (só express) ─── --}}
      @if($prescricao)
        <div class="d-section">
          <div class="d-section-title"><i class="bi bi-receipt"></i> Prescrição Médica</div>
          <div class="d-row">
            <span class="d-val">
              <a href="{{ asset('storage/'.$prescricao) }}"
                 target="_blank"
                 class="doc-link">
                <i class="bi bi-file-earmark-text"></i> Abrir Prescrição
              </a>
            </span>
          </div>
        </div>
      @endif
      
      @if($comprovativo)
        <div class="d-section">
          <div class="d-section-title"><i class="bi bi-receipt"></i> Comprovativo de pagamento</div>
          <div class="d-row">
            <span class="d-lbl">Multicaixa Express</span>
            <span class="d-val">
              <a href="{{ asset('storage/'.$comprovativo) }}"
                 target="_blank"
                 class="doc-link">
                <i class="bi bi-file-earmark-text"></i> Abrir comprovativo
              </a>
            </span>
          </div>
        </div>
      @endif

      {{-- ─── Itens ─── --}}
      <div class="d-section">
        <div class="d-section-title">
          <i class="bi bi-capsule-pill"></i>
          Itens do pedido
          <span style="margin-left:auto;font-size:.68rem;font-weight:400;color:var(--text-4)">
            {{ $dItems->count() }} {{ $dItems->count() === 1 ? 'item' : 'itens' }}
          </span>
        </div>

        @forelse($dItems as $item)
          @php
            $med   = $item->stockItem?->medicamento;
            $nome  = $med?->name ?? '—';
            $preco = $item->preco_unitario ?? $item->stockItem?->preco ?? 0;
            $sub   = $item->subtotal ?? ($preco * $item->quantidade);
            $forma = $med?->forma_farmaceutica;
            $cat   = $med?->categoria?->name;
          @endphp
          <div class="di-row">
            <div class="di-ico"><i class="bi bi-capsule"></i></div>
            <div style="flex:1;min-width:0">
              <div class="di-name">{{ $nome }}</div>
              <div class="di-meta">
                {{ $item->quantidade }} un.
                @if($forma) · {{ $forma }} @endif
                @if($cat)   · {{ $cat }}   @endif
              </div>
              <div class="di-meta">
                {{ number_format($preco, 0, ',', '.') }} Kz / un.
              </div>
              @if($item->prescricao_path)
                <a href="{{ asset('storage/'.$item->prescricao_path) }}"
                   target="_blank"
                   class="doc-link">
                  <i class="bi bi-file-earmark-medical"></i> Ver receita
                </a>
              @endif
            </div>
            <div class="di-price">{{ number_format($sub, 0, ',', '.') }} Kz</div>
          </div>
        @empty
          <p style="font-size:.78rem;color:var(--text-4);padding:8px 0">Sem itens registados.</p>
        @endforelse

        {{-- Total --}}
        <div style="display:flex;justify-content:space-between;padding:10px 10px 2px;font-size:.8rem;border-top:1px solid var(--border);margin-top:4px">
          <span style="color:var(--text-3)">Total</span>
          <span style="font-family:'Sora',sans-serif;font-weight:700;color:var(--text)">
            {{ number_format($dTotal, 0, ',', '.') }} Kz
          </span>
        </div>
      </div>

    </div>{{-- /drawer-body --}}
  </div>{{-- /drawer --}}

@endforeach

{{-- ══ MODAL CANCELAR ════════════════════════════ --}}
<div class="modal-overlay" id="cancelModal">
  <div class="modal-box">
    <div class="modal-ico warning"><i class="bi bi-exclamation-triangle"></i></div>
    <h3>Cancelar pedido?</h3>
    <p id="cancelText">O cliente será notificado. Esta acção não pode ser revertida.</p>
    <div class="modal-foot">
      <button class="btn btn-outline"
              onclick="document.getElementById('cancelModal').classList.remove('open')">
        Voltar
      </button>
      <button class="btn btn-danger-solid" onclick="confirmCancel()">
        <i class="bi bi-x-circle"></i> Cancelar pedido
      </button>
    </div>
  </div>
</div>

<script>
/* ── DATA ─────────────────────────────────────────── */
const DIAS  = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];
const MESES = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
const _d = new Date();
document.getElementById('topbar-date').textContent =
  `${DIAS[_d.getDay()]}, ${_d.getDate()} de ${MESES[_d.getMonth()]} de ${_d.getFullYear()}`;

/* ── DRAWER — JS só abre/fecha ──────────────────── */
let _active = null;

function openDrawer(id, e) {
  /* Ignora cliques em checkboxes, botões, forms, links */
  if (e && e.target.closest('.col-chk,.row-chk,.workflow-actions,.workflow-btn,button,form,a')) return;

  if (_active) _active.classList.remove('open');
  const el = document.getElementById('drawer-' + id);
  if (!el) return;
  el.classList.add('open');
  document.getElementById('drawerOverlay').classList.add('open');
  _active = el;
}

function closeDrawer() {
  if (_active) { _active.classList.remove('open'); _active = null; }
  document.getElementById('drawerOverlay').classList.remove('open');
}

/* ── FILTROS POR TAB (DOM puro) ─────────────────── */
let currentTab = 'all';
const TAB_STATUS = {
  new:      ['Pendente'],
  prep:     ['Aprovado','pago'],
  route:    ['Em Entrega'],
  done:     ['Concluído'],
  canceled: ['Cancelado','Rejeitado'],
};

function setTab(el, tab) {
  document.querySelectorAll('.st-tab').forEach(t => t.classList.remove('active'));
  el.classList.add('active');
  currentTab = tab;
  applyFilters();
}

function applyFilters() {
  const q = document.getElementById('searchInput').value.trim().toLowerCase();
  let vis = 0;
  document.querySelectorAll('tbody tr[data-id]').forEach(row => {
    const matchTab = currentTab === 'all'
      || (TAB_STATUS[currentTab] || []).includes(row.dataset.status);
    const matchQ   = !q || row.textContent.toLowerCase().includes(q);
    const show     = matchTab && matchQ;
    row.style.display = show ? '' : 'none';
    if (show) vis++;
  });
  document.getElementById('emptyState').style.display   = vis === 0 ? 'flex' : 'none';
  document.querySelector('.table-scroll').style.display = vis === 0 ? 'none' : '';
}

/* ── CHECKBOXES / BULK ──────────────────────────── */
const selected = new Set();

function toggleRow(id, cb) {
  if (cb.checked) selected.add(id); else selected.delete(id);
  cb.closest('tr').classList.toggle('selected', cb.checked);
  updateBulkBar();
}

function toggleAll(cb) {
  document.querySelectorAll('tbody tr[data-id]:not([style*="display: none"]) .row-chk').forEach(chk => {
    chk.checked = cb.checked;
    const id = parseInt(chk.closest('tr').dataset.id);
    if (cb.checked) selected.add(id); else selected.delete(id);
    chk.closest('tr').classList.toggle('selected', cb.checked);
  });
  updateBulkBar();
}

function clearSel() {
  selected.clear();
  document.querySelectorAll('.row-chk').forEach(c => c.checked = false);
  document.querySelectorAll('tbody tr').forEach(r => r.classList.remove('selected'));
  document.getElementById('selAll').checked = false;
  updateBulkBar();
}

function updateBulkBar() {
  document.getElementById('bulkBar').classList.toggle('show', selected.size > 0);
  document.getElementById('bulkCount').textContent = selected.size;
}

/* ── CANCELAR (bulk) ────────────────────────────── */
function bulkCancelOpen() {
  if (!selected.size) return;
  document.getElementById('cancelText').textContent =
    `Vai cancelar ${selected.size} pedido(s). Esta acção não pode ser revertida.`;
  document.getElementById('cancelModal').classList.add('open');
}

function confirmCancel() {
  document.getElementById('cancelModal').classList.remove('open');
  Array.from(selected).forEach(id => {
    fetch(`/farmacias/pedidos/${id}/status`, {
      method: 'PUT',
      headers: {
        'Content-Type':  'application/json',
        'X-CSRF-TOKEN':  '{{ csrf_token() }}',
      },
      body: JSON.stringify({ status: 'Cancelado' }),
    }).then(() => location.reload());
  });
}

document.getElementById('cancelModal').addEventListener('click', function(e) {
  if (e.target === this) this.classList.remove('open');
});

/* ── SIDEBAR ─────────────────────────────────────── */
function toggleSub(id) { document.getElementById(id).classList.toggle('open'); }
</script>

</body>
</html>